<?php

namespace App\Imports;

use App\Category;
use App\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading; // Add this

class CategoriesImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    protected $visibility;

    // Accept visibility data in the constructor
    public function __construct(array $visibility)
    {
        $this->visibility = $visibility;
    }

    /**
     * Method to process each row from the XLSX file and match the SKU with the product.
     * Sync all categories in the hierarchy to the product using syncWithoutDetaching.
     *
     * @param array $row
     * @return void
     */
    public function model(array $row)
    {
        try {
            // Check if both SKU and category exist in the row
            if (!empty($row['sku']) && !empty($row['category'])) {
                // Find the product by SKU
                $product = Product::where('sku', $row['sku'])->first();

                if ($product) {
                    // Split the category string by the pipe sign to identify hierarchy levels
                    $categories = array_map('trim', explode('|', $row['category']));
                    $parent_id = 0;
                    $category_ids = []; // To store all category IDs for syncing

                    // Iterate through each level of the category hierarchy
                    foreach ($categories as $level => $category_name) {
                        // Normalize the category name
                        $normalized_name = strtolower($category_name); // Normalize name to lowercase

                        // Create a slug, converting special characters to their ASCII equivalents
                        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower(iconv('UTF-8', 'ASCII//TRANSLIT', $normalized_name))));

                        // Check if the category already exists in the database at this level using slug
                        $existingCategory = Category::where('slug', $slug)
                            ->where('parent_id', $parent_id)
                            ->first();

                        if ($existingCategory) {
                            // Update the visibility of the existing category
                            $this->updateCategoryVisibility($existingCategory);
                            $parent_id = $existingCategory->id;
                            $category_ids[] = $existingCategory->id; // Add to list of category IDs
                        } else {
                            // Create a new category and set it as the parent for the next level
                            $newCategory = Category::create([
                                'name' => $category_name,
                                'slug' => $slug,
                                'order_level' => 0,  // Default value for order level
                                'parent_id' => $parent_id,
                                'level' => $level,  // Set the level based on hierarchy depth
                                'source' => 'knobby',  // Add the source information for tracking
                            ]);

                            // Set visibility for the new category
                            $this->updateCategoryVisibility($newCategory);

                            $parent_id = $newCategory->id;
                            $category_ids[] = $newCategory->id; // Add to list of category IDs
                        }
                    }

                    // Sync all categories (not just the last) to the product
                    if (!empty($category_ids)) {
                        $product->categories()->syncWithoutDetaching($category_ids);
                    }
                } else {
                    // Log if the product with the SKU does not exist
                    Log::channel('category_import')->warning('Product not found for SKU: ' . $row['sku']);
                }
            } else {
                // Log if SKU or category is missing
                Log::channel('category_import')->warning('Missing SKU or Category in row: ', $row);
            }
        } catch (\Exception $e) {
            // Log the error with complete details
            Log::channel('category_import')->error('Error processing row: ' . json_encode($row) . ' Error: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
        }
    }

    /**
     * Update the visibility of the given category based on the visibility array.
     *
     * @param Category $category
     * @return void
     */
    private function updateCategoryVisibility(Category $category)
    {
        try {
            if (!empty($this->visibility)) {
                // Update the visibility with the selected shop IDs from the form
                $category->visibility()->sync($this->visibility);
            } else {
                // Set visibility to all shops if visibility is not provided or is empty
                $allShopIds = Shop::pluck('id')->all();
                $category->visibility()->sync($allShopIds);
            }
        } catch (\Exception $e) {
            // Log any error that occurs while updating visibility
            Log::channel('category_import')->error('Error updating visibility for category: ' . $category->id . ' Error: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
        }
    }

    /**
     * Specify the chunk size to be processed at a time.
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 500;  // Specify the number of rows to process per chunk
    }
}
