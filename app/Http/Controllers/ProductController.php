<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductTranslation;
use App\ProductStock;
use App\Category;
use App\AttributeValue;
use App\Cart;
use App\Models\Shop;
use Auth;
use Carbon\Carbon;
use Combinations;
use Illuminate\Support\Str;
use App\ProductAddon;
use Artisan;
use Cache;
use Illuminate\Support\Facades\Validator;
use Excel;
use Illuminate\Support\Facades\Log;
use App\Imports\KnobbyProductsImport;

class ProductController extends Controller
{


    public function linkAndCleanUpSkus()
    {
        // Fetch all products with a non-null and non-empty SKU
        $products = Product::whereNotNull('sku')->where('sku', '<>', '')->get();


        foreach ($products as $product) {
            // Find a ProductAddon with the same SKU
            $addon = ProductAddon::where('sku', $product->sku)->first();


            if ($addon) {

                //Check if a relation already exists in product_addon_pivot
                $exists = \DB::table('product_addon_pivot')
                    ->where('product_id', $product->id)
                    ->where('product_addon_id', $addon->id)
                    ->exists();

                if ($exists) {
                    // If relation exists, only clear the SKU
                    $product->sku = null;
                    $product->unit_price     = 0;
                    $product->fake_price     = 0;
                    $product->current_stock = 0;

                    $product->save();
                } else {
                    // If relation does not exist, link the product and addon and clear the SKU
                    \DB::table('product_addon_pivot')->insert([
                        'product_id' => $product->id,
                        'product_addon_id' => $addon->id,
                        'sort_order' => 0 // This should be set as per your requirement
                    ]);

                    // Clear the SKU after linking
                    $product->sku = null;
                    $product->unit_price     = 0;
                    $product->fake_price     = 0;
                    $product->current_stock = 0;
                    $product->save();
                }
            }
        }
    }



    public function all_products(Request $request)
    {
        $sort_search = null;
        $topLevelNodes = Category::where('parent_id', 0)->where('published', 1)->get();

        $productsQuery = Product::where('auction_product', 0)
            ->orderBy('created_at', 'desc');

        if ($request->search != null) {
            $productsQuery = $productsQuery->where('name', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }

        if ($request->has('featured') && $request->featured == '1') {
            $productsQuery = $productsQuery->where('featured', 1);
        }

        $categoryIds = array_filter(explode(',', $request->selectedCategories_treeview1));
        if (!empty($categoryIds)) {
            $productsQuery = $productsQuery->join('product_category_pivot', 'products.id', '=', 'product_category_pivot.product_id')
                ->whereIn('product_category_pivot.category_id', $categoryIds)
                ->select('products.*')
                ->distinct();

            $selectedCategoryNames = Category::whereIn('id', $categoryIds)->get();
        } else {
            $selectedCategoryNames = collect();
        }

        $products = $productsQuery->paginate(15);

        foreach ($products as $product) {
            $product->visibilityShops = $product->visibility()->pluck('name')->toArray();
        }

        return view('backend.product.products.index', compact('products', 'sort_search', 'topLevelNodes', 'categoryIds', 'selectedCategoryNames'));
    }





    // public function all_products(Request $request)
    // {
    //     $sort_search = null;
    //     $topLevelNodes = Category::where('parent_id', 0)->where('published', 1)->get();

    //     $productsQuery = Product::where('auction_product', 0)->orderBy('created_at', 'desc');

    //     if ($request->search != null) {
    //         $productsQuery = $productsQuery->where('name', 'like', '%' . $request->search . '%');
    //         $sort_search = $request->search;
    //     }

    //     $categoryIds = array_filter(explode(',', $request->selectedCategories_treeview1));
    //     if (!empty($categoryIds)) {
    //         // Fetch all descendant category IDs
    //         $allCategoryIds = $this->getAllCategoryIds($categoryIds);

    //         $productsQuery = $productsQuery->join('product_category_pivot', 'products.id', '=', 'product_category_pivot.product_id')
    //             ->whereIn('product_category_pivot.category_id', $allCategoryIds)
    //             ->select('products.*')
    //             ->distinct();

    //         $selectedCategoryNames = Category::whereIn('id', $categoryIds)->get();
    //     } else {
    //         $selectedCategoryNames = collect();
    //     }

    //     $products = $productsQuery->paginate(15);

    //     return view('backend.product.products.index', compact('products', 'sort_search', 'topLevelNodes', 'categoryIds', 'selectedCategoryNames'));
    // }

    // // Utility function to fetch all nested child category IDs
    // private function getAllCategoryIds($categoryIds)
    // {
    //     $allIds = $categoryIds;
    //     $childIds = Category::whereIn('parent_id', $categoryIds)->pluck('id')->toArray();

    //     while (!empty($childIds)) {
    //         $allIds = array_merge($allIds, $childIds);
    //         $childIds = Category::whereIn('parent_id', $childIds)->pluck('id')->toArray();
    //     }

    //     return array_unique($allIds);
    // }



    public function loadNodes(Request $request)
    {
        $parentId = $request->parentId;
        $type = $request->type;

        if ($type === 'category') {
            // Fetch categories as before
            $categories = Category::withCount('childrenCategories as children_count')
                ->where('parent_id', $parentId)
                ->where('published', 1)
                ->orderBy('created_at', 'desc')
                ->get();

            $nodes = $categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'has_children' => $category->childrenCategories->count() > 0,
                    'isProduct' => false,
                    'type' => 'category',
                ];
            });
        } elseif ($type === 'product' && $request->has('productId')) {
            // Load addons for a product
            $product = Product::find($request->productId);
            $addons = $product->product_addons()->get(); // Assuming products() returns related addons

            $nodes = $addons->map(function ($addon) {
                return [
                    'id' => $addon->id,
                    'name' => $addon->sku,
                    'isProduct' => false, // You can adjust this based on your needs
                    'has_children' => false, // Assuming addons do not have further children
                    'type' => 'addon',
                ];
            });
        } elseif ($type === 'product') {
            // Check if there are subcategories. If not, load products.
            $hasSubcategories = Category::where('parent_id', $parentId)->exists();

            if (!$hasSubcategories) {
                // Load products because there are no subcategories
                $products = Product::where('published', 1)
                    ->whereHas('categories', function ($query) use ($parentId) {
                        $query->where('category_id', $parentId);
                    })
                    ->orderBy('name', 'asc')
                    ->get();

                $nodes = $products->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'isProduct' => true,
                        'has_children' => false,
                        'type' => 'product',
                    ];
                });
            } else {
                // If there are subcategories, indicate they have children
                $categories = Category::where('parent_id', $parentId)
                    ->where('published', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();

                $nodes = $categories->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'has_children' => true,  // Assume children since it's the product type context
                        'isProduct' => false,
                        'type' => 'category'
                    ];
                });
            }
        } elseif ($type === 'addon') {
            $hasSubcategories = Category::where('parent_id', $parentId)->exists();

            if (!$hasSubcategories) {
                // Load products because there are no subcategories
                $products = Product::where('published', 1)
                    ->whereHas('categories', function ($query) use ($parentId) {
                        $query->where('category_id', $parentId);
                    })
                    ->orderBy('name', 'asc')
                    ->get();

                $nodes = $products->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'isProduct' => true,
                        'has_children' => $product->product_addons()->exists(), // Check if product has addons
                        'type' => 'product',
                    ];
                });
            } else {
                // Load categories as before
                $categories = Category::where('parent_id', $parentId)
                    ->where('published', 1)
                    ->orderBy('created_at', 'desc')
                    ->get();

                $nodes = $categories->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'has_children' => true,  // Assume children since it's the addon type context
                        'isProduct' => false,
                        'type' => 'category',
                    ];
                });
            }
        }


        return response()->json($nodes);
    }


    public function searchNodes(Request $request)
    {
        $searchTerm = $request->input('term');
        $treeviewId = $request->input('treeviewId'); // You might use this if the logic differs per treeview
        $searchType = $request->input('searchType');

        if ($searchType == 'category') {
            $nodes = Category::where('name', 'LIKE', "%{$searchTerm}%")
                ->take(100)
                ->get()
                ->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        // Add other attributes you need for the frontend
                    ];
                });
        } elseif ($searchType == 'product') {
            $nodes = Product::where('published', 1)->where('name', 'LIKE', "%{$searchTerm}%")
                ->take(100)
                ->get()->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                    ];
                });
        } elseif ($searchType == 'addon') {
            $nodes = ProductAddon::where('sku', 'LIKE', "{$searchTerm}%")  // Look for SKUs starting with the searchTerm
                ->take(100)
                ->get()
                ->map(function ($addon) use ($searchTerm) {
                    return [
                        'id' => $addon->id,
                        'name' => $addon->sku,
                        'startsWithSearchTerm' => strpos(strtolower($addon->sku), strtolower($searchTerm)) === 0, // Check if SKU starts with the searchTerm
                    ];
                })
                ->sortByDesc('startsWithSearchTerm') // Sort by the startsWithSearchTerm flag
                ->values()
                ->map(function ($addon) {
                    // Remove the startsWithSearchTerm key as it's no longer needed
                    unset($addon['startsWithSearchTerm']);
                    return $addon;
                });
            // $nodes now contains up to 100 results with those starting with searchTerm at the top

        }

        return response()->json(['nodes' => $nodes]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)
            ->where('published', 1)
            ->with(['childrenCategories.categories'])
            ->get();

        return view('backend.product.products.create', compact('categories'));
    }

    public function add_more_choice_option(Request $request)
    {
        $all_attribute_values = AttributeValue::with('attribute')->where('attribute_id', $request->attribute_id)->get();

        $html = '';

        foreach ($all_attribute_values as $row) {
            $html .= '<option value="' . $row->value . '">' . $row->value . '</option>';
        }

        echo json_encode($html);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'thumbnail_img' => 'nullable|string|max:255',
            'unit_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'current_stock' => 'nullable|integer',
            'sku' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'slug' => 'nullable|string|max:255',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            $errorMessages = implode(' ', $validator->errors()->all());
            flash(translate($errorMessages))->error();
            return redirect()->back()->withInput();
        }

        $product = new Product;
        $product->name = $request->name;
        $product->thumbnail_img = $request->thumbnail_img;
        $product->unit_price = $request->unit_price;
        $product->description = $request->description;
        $product->current_stock = $request->current_stock ?? 0;
        $product->sku = $request->sku;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        
        // SEO Fields
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        
        // Generate slug if not provided
        if (empty($request->slug)) {
            $product->slug = \Str::slug($request->name) . '-' . \Str::random(5);
        } else {
            $product->slug = \Str::slug($request->slug);
        }
        
        $product->save();

        flash(translate('Product has been inserted successfully'))->success();

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return redirect()->route('products.admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_product_edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $lang = $request->lang;
        $tags = json_decode($product->tags);

        $categories = Category::where('parent_id', 0)
            ->where('published', 1)
            ->with(['childrenCategories.categories'])
            ->get();

        return view('backend.product.products.edit', compact(
            'product',
            'categories',
            'lang'
        ));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product  = Product::findOrFail($id);

        $product->name = $request->name;
        $product->thumbnail_img = $request->thumbnail_img;
        $product->unit_price = $request->unit_price;
        $product->description = $request->description;
        $product->current_stock = $request->current_stock ?? 0;
        $product->sku = $request->sku;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        
        // SEO Fields
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        
        // Update slug if provided
        if (!empty($request->slug)) {
            $product->slug = \Str::slug($request->slug);
        } elseif (empty($product->slug)) {
            $product->slug = \Str::slug($request->name) . '-' . \Str::random(5);
        }

        $product->save();

        flash(translate('Product has been updated successfully'))->success();

        Artisan::call('view:clear');
        Artisan::call('cache:clear');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->product_translations as $key => $product_translations) {
            $product_translations->delete();
        }

        foreach ($product->stocks as $key => $stock) {
            $stock->delete();
        }

        if (Product::destroy($id)) {
            Cart::where('product_id', $id)->delete();

            flash(translate('Product has been deleted successfully'))->success();

            Artisan::call('view:clear');
            Artisan::call('cache:clear');

            return back();
        } else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function bulk_product_delete(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $product_id) {
                $this->destroy($product_id);
            }
        }
        return 1;
    }

    /**
     * Duplicates the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function duplicate(Request $request, $id)
    // {
    //     $product = Product::find($id);
    //     $product_new = $product->replicate();
    //     $product_new->slug = $product_new->slug . '-' . Str::random(5);

    //     if ($product_new->save()) {
    //         foreach ($product->stocks as $key => $stock) {
    //             $product_stock              = new ProductStock;
    //             $product_stock->product_id  = $product_new->id;
    //             $product_stock->variant     = $stock->variant;
    //             $product_stock->price       = $stock->price;
    //             $product_stock->sku         = $stock->sku;
    //             $product_stock->qty         = $stock->qty;
    //             $product_stock->save();
    //         }

    //         flash(translate('Product has been duplicated successfully'))->success();
    //         return redirect()->route('products.admin');
    //     } else {
    //         flash(translate('Something went wrong'))->error();
    //         return back();
    //     }
    // }

    public function duplicate(Request $request, $id)
    {
        $originalProduct = Product::find($id);
        if (!$originalProduct) {
            flash(translate('Product not found'))->error();
            return back();
        }

        $newProduct = $originalProduct->replicate();
        $newProduct->slug = $newProduct->slug . '-' . Str::random(5);

        // Save the new product before associating relationships
        if (!$newProduct->save()) {
            flash(translate('Something went wrong'))->error();
            return back();
        }

        // Replicate stocks
        foreach ($originalProduct->stocks as $stock) {
            $newStock = new ProductStock([
                'product_id' => $newProduct->id,
                'variant' => $stock->variant,
                'price' => $stock->price,
                'sku' => $stock->sku . '-' . Str::random(5), // Ensure unique SKU
                'qty' => $stock->qty,
            ]);
            $newStock->save();
        }

        // Replicate category associations
        $categoryIds = $originalProduct->categories->pluck('id');
        $newProduct->categories()->attach($categoryIds);

        // Replicate related products associations
        $relatedProductIds = $originalProduct->relevantProducts->pluck('id');
        $newProduct->relevantProducts()->sync($relatedProductIds);

        // Replicate related add-ons associations
        $relatedAddonIds = $originalProduct->relatedAddons->pluck('id');
        $newProduct->relatedAddons()->sync($relatedAddonIds);

        // Handle custom pivot table for product_addon_pivot if needed
        foreach ($originalProduct->productAddonPivot as $pivot) {
            \DB::table('product_addon_pivot')->insert([
                'product_id' => $newProduct->id,
                'product_addon_id' => $pivot->product_addon_id,
                'sort_order' => $pivot->sort_order
            ]);
        }

        flash(translate('Product has been duplicated successfully'))->success();
        return redirect()->route('products.admin');
    }


    public function get_products_by_brand(Request $request)
    {
        $products = Product::where('brand_id', $request->brand_id)->get();
        return view('partials.product_select', compact('products'));
    }

    public function updateTodaysDeal(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->todays_deal = $request->status;
        $product->save();
        Cache::forget('todays_deal_products');
        return 1;
    }

    public function updatePublished(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->published = $request->status;

        $product->save();
        return 1;
    }

    public function updateProductApproval(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->approved = $request->approved;

        $product->save();
        return 1;
    }

    public function updateFeatured(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->featured = $request->status;
        if ($product->save()) {
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            return 1;
        }
        return 0;
    }

    public function updateSellerFeatured(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->seller_featured = $request->status;
        if ($product->save()) {
            return 1;
        }
        return 0;
    }

    public function sku_combination(Request $request)
    {
        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->name;

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                // foreach (json_decode($request[$name][0]) as $key => $item) {
                foreach ($request[$name] as $key => $item) {
                    // array_push($data, $item->value);
                    array_push($data, $item);
                }
                array_push($options, $data);
            }
        }

        $combinations = Combinations::makeCombinations($options);
        return view('backend.product.products.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
    }

    public function sku_combination_edit(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $product_name = $request->name;
        $unit_price = $request->unit_price;

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $data = array();
                // foreach (json_decode($request[$name][0]) as $key => $item) {
                foreach ($request[$name] as $key => $item) {
                    // array_push($data, $item->value);
                    array_push($data, $item);
                }
                array_push($options, $data);
            }
        }

        $combinations = Combinations::makeCombinations($options);
        return view('backend.product.products.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
    }



    public function uploadKnobbyData(Request $request)
    {
        // Validate the uploaded file and the import ID
        $request->validate([
            'bulk_file' => 'required|mimes:xlsx,xls',  // Ensure the correct file type
            'import_id' => 'required|string',          // Validate the presence of the import ID
        ]);

        $importId = $request->input('import_id');  // Get the unique import ID from the request

        // Create a unique file name based on the current time and original file name
        $fileName = time() . '_' . $request->file('bulk_file')->getClientOriginalName();
        $filePath = storage_path('app/tmp/' . $fileName);

        // Ensure the temporary upload directory exists, if not, create it
        if (!file_exists(storage_path('app/tmp'))) {
            mkdir(storage_path('app/tmp'), 0777, true);
        }

        // Move the uploaded file to the specified directory
        $request->file('bulk_file')->move(storage_path('app/tmp'), $fileName);

        try {
            // Start the import
            Excel::queueImport(new KnobbyProductsImport($importId), $filePath);

            // Return a JSON response indicating success
            return response()->json(['success' => true, 'message' => 'Upload started successfully.']);
        } catch (\Exception $e) {
            // Log and return an error response
            Log::channel('product_import')->error('Error during Excel import: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'File import failed.'], 500);
        }
    }
}
