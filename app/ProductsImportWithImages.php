<?php

namespace App;

use App\Product;
use App\Category;
use App\Models\Brand;
use App\Upload;
use App\User;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Log;

class ProductsImportWithImages implements ToCollection, WithHeadingRow, WithValidation, WithChunkReading
{
    private $rows = 0;
    private $errors = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            try {
                // Convert row to array if it's a collection
                if ($row instanceof Collection) {
                    $row = $row->toArray();
                }
                
                // Normalize column names to lowercase and trim values
                $normalizedRow = [];
                foreach ($row as $key => $value) {
                    $normalizedKey = strtolower(trim(str_replace([' ', '-', '_'], '_', $key)));
                    $normalizedRow[$normalizedKey] = is_string($value) ? trim($value) : $value;
                }
                $row = $normalizedRow;

                // Log first row for debugging
                if ($index === 0) {
                    Log::info('First row data: ' . json_encode($row));
                }

                // Skip empty rows
                if (empty($row['name']) && empty($row['product_name'])) {
                    Log::info('Skipping empty row at index: ' . $index);
                    continue;
                }

                $productName = trim($row['name'] ?? $row['product_name'] ?? '');
                $sku = !empty($row['sku']) ? trim($row['sku']) : (!empty($row['article_number']) ? trim($row['article_number']) : null);
                $price = !empty($row['price']) ? floatval($row['price']) : (!empty($row['unit_price']) ? floatval($row['unit_price']) : 0);
                $imageUrl = !empty($row['image_url']) ? trim($row['image_url']) : (!empty($row['image']) ? trim($row['image']) : null);
                $categoryName = !empty($row['category']) ? trim($row['category']) : null;
                $brandName = !empty($row['brand']) ? trim($row['brand']) : null;
                $description = !empty($row['description']) ? trim($row['description']) : '';
                
                Log::info("Processing product: {$productName}, Image URL: {$imageUrl}");

                // Get or create category
                $categoryId = null;
                if (!empty($categoryName)) {
                    $category = Category::where('name', $categoryName)->first();
                    if (!$category) {
                        // Create new category
                        $category = new Category();
                        $category->name = $categoryName;
                        $category->slug = Str::slug($categoryName) . '-' . Str::random(5);
                        $category->order_level = 0;
                        $category->digital = 0;
                        $category->published = 1;
                        $category->parent_id = 0;
                        $category->level = 0;
                        $category->save();
                    }
                    $categoryId = $category->id;
                }

                // Get or create brand
                $brandId = null;
                if (!empty($brandName)) {
                    $brand = Brand::where('name', $brandName)->first();
                    
                    if (!$brand) {
                        // Create new brand
                        $brand = new Brand();
                        $brand->name = $brandName;
                        $brand->save();
                    }
                    $brandId = $brand->id;
                }

                // Download image if URL provided
                $thumbnailImg = null;
                if (!empty($imageUrl)) {
                    // Clean the URL (remove whitespace)
                    $imageUrl = trim($imageUrl);
                    
                    // Validate URL
                    if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                        Log::info('Downloading image from URL: ' . $imageUrl);
                        $thumbnailImg = $this->downloadThumbnail($imageUrl);
                        if ($thumbnailImg) {
                            Log::info('Image downloaded successfully, upload ID: ' . $thumbnailImg);
                        } else {
                            Log::warning('Failed to download image from URL: ' . $imageUrl);
                        }
                    } else {
                        Log::warning('Invalid image URL: ' . $imageUrl);
                    }
                } else {
                    Log::info('No image URL provided for product: ' . $productName);
                }

                // Check if product exists by SKU or name
                $product = null;
                if (!empty($sku)) {
                    $product = Product::where('sku', $sku)->first();
                }
                
                if (!$product && !empty($productName)) {
                    $product = Product::where('name', $productName)->first();
                }

                // Create or update product
                if ($product) {
                    // Update existing product
                    Log::info("Updating existing product: {$product->id} - {$productName}");
                    $product->name = $productName;
                    $product->unit_price = $price;
                    $product->description = $description;
                    if ($thumbnailImg) {
                        $product->thumbnail_img = $thumbnailImg;
                        Log::info("Setting thumbnail_img to upload ID: {$thumbnailImg}");
                    } else {
                        Log::warning("No thumbnail image for product: {$productName}");
                    }
                    if ($categoryId) {
                        $product->category_id = $categoryId;
                        // Also attach to categories pivot table
                        if (!$product->categories->contains($categoryId)) {
                            $product->categories()->attach($categoryId);
                        }
                    }
                    if ($brandId) {
                        $product->brand_id = $brandId;
                    }
                    if ($sku) {
                        $product->sku = $sku;
                    }
                    $product->save();
                    Log::info("Product updated. thumbnail_img value: " . ($product->thumbnail_img ?? 'NULL'));
                } else {
                    // Create new product
                    Log::info("Creating new product: {$productName}");
                    $productData = [
                        'name' => $productName,
                        'added_by' => 'admin',
                        'user_id' => Auth::check() ? Auth::user()->id : 1,
                        'unit_price' => $price,
                        'description' => $description,
                        'slug' => Str::slug($productName) . '-' . Str::random(5),
                        'current_stock' => 0,
                        'qty' => 0,
                    ];

                    if ($thumbnailImg) {
                        $productData['thumbnail_img'] = $thumbnailImg;
                        Log::info("Adding thumbnail_img to product data: {$thumbnailImg}");
                    } else {
                        Log::warning("No thumbnail image for new product: {$productName}");
                    }
                    if ($categoryId) {
                        $productData['category_id'] = $categoryId;
                    }
                    if ($brandId) {
                        $productData['brand_id'] = $brandId;
                    }
                    if ($sku) {
                        $productData['sku'] = $sku;
                    }

                    $product = Product::create($productData);
                    Log::info("Product created with ID: {$product->id}, thumbnail_img: " . ($product->thumbnail_img ?? 'NULL'));

                    // Attach to category pivot table
                    if ($categoryId) {
                        $product->categories()->attach($categoryId);
                    }
                }

                $this->rows++;
                Log::info("Successfully processed product: {$productName}. Total rows processed: {$this->rows}");
            } catch (\Exception $e) {
                Log::error('Product import error: ' . $e->getMessage());
                $this->errors[] = 'Row ' . ($this->rows + 1) . ': ' . $e->getMessage();
            }
        }
    }

    public function downloadThumbnail($url)
    {
        try {
            Log::info('Starting image download from: ' . $url);
            
            // Get file extension from URL
            $parsedUrl = parse_url($url);
            $path = $parsedUrl['path'] ?? '';
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            
            // If no extension in path, try to get from query or default to png/jpg
            if (empty($extension)) {
                // Check if URL contains image format hints
                if (strpos($url, '.png') !== false || strpos($url, 'png') !== false) {
                    $extension = 'png';
                } elseif (strpos($url, '.jpg') !== false || strpos($url, 'jpg') !== false || strpos($url, '.jpeg') !== false) {
                    $extension = 'jpg';
                } else {
                    $extension = 'png'; // Default to png for placeholder images
                }
            }
            
            // Remove query parameters from extension
            $extension = explode('?', $extension)[0];
            $extension = strtolower(trim($extension));
            
            Log::info('Detected file extension: ' . $extension);
            
            // Generate unique filename
            $filename = 'uploads/all/' . Str::random(10) . '_' . time() . '.' . $extension;
            $fullpath = public_path($filename);
            
            // Create directory if it doesn't exist
            $dir = dirname($fullpath);
            if (!file_exists($dir)) {
                @mkdir($dir, 0777, true);
            }
            
            // Ensure directory is writable
            if (!is_writable($dir)) {
                @chmod($dir, 0777);
            }
            
            if (!is_writable($dir)) {
                Log::error('Directory is not writable: ' . $dir);
                return null;
            }
            
            // Download file with timeout and user agent
            $context = stream_context_create([
                'http' => [
                    'timeout' => 30,
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    'follow_location' => true,
                    'max_redirects' => 5
                ]
            ]);
            
            Log::info('Attempting to download file to: ' . $fullpath);
            
            $fileContent = @file_get_contents($url, false, $context);
            
            if ($fileContent === false) {
                $error = error_get_last();
                Log::error('Failed to download image from URL: ' . $url . ' - Error: ' . ($error['message'] ?? 'Unknown error'));
                return null;
            }
            
            if (empty($fileContent)) {
                Log::warning('Downloaded file content is empty for URL: ' . $url);
                return null;
            }
            
            Log::info('File downloaded, size: ' . strlen($fileContent) . ' bytes');
            
            // Save file
            $saved = @file_put_contents($fullpath, $fileContent);
            
            if ($saved === false) {
                Log::error('Failed to save file to: ' . $fullpath);
                return null;
            }
            
            // Verify file was saved
            if (!file_exists($fullpath)) {
                Log::warning('File was not saved to: ' . $fullpath);
                return null;
            }
            
            $fileSize = filesize($fullpath);
            Log::info('File saved successfully, size: ' . $fileSize . ' bytes');
            
            // Create upload record
            $upload = new Upload();
            $upload->extension = strtolower($extension);
            $upload->file_original_name = basename($filename);
            $upload->file_name = $filename;
            $upload->user_id = Auth::check() ? Auth::user()->id : 1;
            $upload->type = "image";
            $upload->file_size = filesize($fullpath);
            $upload->save();

            return $upload->id;
        } catch (\Exception $e) {
            Log::error('Image download error for URL ' . $url . ': ' . $e->getMessage());
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    public function chunkSize(): int
    {
        return 50; // Smaller chunks for image downloads
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
