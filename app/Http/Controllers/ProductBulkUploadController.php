<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\Brand;
use App\User;
use App\ProductTranslation;
use App\ProductStock;
use App\Cart;
use Auth;
use App\ProductsImport;
use App\ProductsImportWithImages;
use App\ProductsLink;
use App\ProductsExport;
use App\ProductsSampleExport;
use PDF;
use Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Artisan;
use Cache;

class ProductBulkUploadController extends Controller
{
    public function index()
    {
        return view('backend.product.bulk_upload.index');
    }


    public function knobby_category()
    {
        return view('backend.product.bulk_upload.knobby_category');
    }

    public function knobby_bike_fitment()
    {
        return view('backend.product.bulk_upload.knobby_bike_fitment');
    }

    public function knobby_product()
    {
        return view('backend.product.bulk_upload.knobby_product');
    }



    public function product_link()
    {
        // $products = Product::with(['categories'])->orderBy('created_at', 'desc')->get();

        $topLevelNodes = Category::where('parent_id', 0)->where('published', 1)->get();
        return view('backend.product.bulk_upload.link', compact('topLevelNodes'));
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    // public function pdf_download_category()
    // {
    //     $categories = Category::all();

    //     return PDF::loadView('backend.downloads.category', [
    //         'categories' => $categories,
    //     ], [], [])->download('category.pdf');
    // }

    // public function pdf_download_brand()
    // {
    //     $brands = Brand::all();

    //     return PDF::loadView('backend.downloads.brand', [
    //         'brands' => $brands,
    //     ], [], [])->download('brands.pdf');
    // }

    // public function pdf_download_seller()
    // {
    //     $users = User::where('user_type', 'seller')->get();

    //     return PDF::loadView('backend.downloads.user', [
    //         'users' => $users,
    //     ], [], [])->download('user.pdf');
    // }

    public function bulk_upload(Request $request)
    {
        if ($request->hasFile('bulk_file')) {
            $import = new ProductsImport;

            Excel::import($import, request()->file('bulk_file'));
        }
        return back();
    }


    public function bulk_link(Request $request)
    {
        $productIds = explode(',', $request->input('selectedCategories_product_id'));
        if ($request->hasFile('bulk_file')) {
            $import = new ProductsLink($productIds);

            Excel::import($import, request()->file('bulk_file'));
        }
        return back();
    }

    /**
     * Enhanced bulk upload with image download and category/brand creation
     */
    public function bulk_upload_with_images(Request $request)
    {
        $request->validate([
            'bulk_file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Ensure temp directory exists and is writable
        $tempPath = storage_path('framework/cache/laravel-excel');
        if (!file_exists($tempPath)) {
            @mkdir($tempPath, 0777, true);
        }
        if (!is_writable($tempPath)) {
            @chmod($tempPath, 0777);
        }
        
        // Use alternative path if default is not writable
        if (!is_writable($tempPath)) {
            $altTempPath = public_path('temp');
            if (!file_exists($altTempPath)) {
                @mkdir($altTempPath, 0777, true);
            }
            config(['excel.temporary_files.local_path' => $altTempPath]);
        }

        if ($request->hasFile('bulk_file')) {
            try {
                $import = new ProductsImportWithImages;
                Excel::import($import, request()->file('bulk_file'));
                
                $rowCount = $import->getRowCount();
                $errors = $import->getErrors();
                
                if (!empty($errors)) {
                    flash(translate('Products imported with some errors. ' . $rowCount . ' products imported successfully.'))->warning();
                    foreach ($errors as $error) {
                        flash($error)->warning();
                    }
                } else {
                    flash(translate($rowCount . ' products imported successfully with images, categories and brands.'))->success();
                }
            } catch (\Exception $e) {
                // Try alternative temp path if default fails
                if (strpos($e->getMessage(), 'Permission denied') !== false || strpos($e->getMessage(), 'Unable to create file') !== false) {
                    $altTempPath = public_path('temp');
                    if (!file_exists($altTempPath)) {
                        @mkdir($altTempPath, 0777, true);
                    }
                    config(['excel.temporary_files.local_path' => $altTempPath]);
                    
                    try {
                        $import = new ProductsImportWithImages;
                        Excel::import($import, request()->file('bulk_file'));
                        
                        $rowCount = $import->getRowCount();
                        flash(translate($rowCount . ' products imported successfully with images, categories and brands.'))->success();
                    } catch (\Exception $e2) {
                        flash(translate('Error importing products: ' . $e2->getMessage()))->error();
                    }
                } else {
                    flash(translate('Error importing products: ' . $e->getMessage()))->error();
                }
            }
        }
        
        return back();
    }

    /**
     * Download sample Excel file for product bulk upload
     */
    public function download_sample()
    {
        // Ensure the temporary directory exists and is writable
        $tempPath = storage_path('framework/cache/laravel-excel');
        if (!file_exists($tempPath)) {
            @mkdir($tempPath, 0777, true);
        }
        if (!is_writable($tempPath)) {
            @chmod($tempPath, 0777);
        }
        
        // Try alternative path if default is not writable
        if (!is_writable($tempPath)) {
            $altTempPath = public_path('temp');
            if (!file_exists($altTempPath)) {
                @mkdir($altTempPath, 0777, true);
            }
            config(['excel.temporary_files.local_path' => $altTempPath]);
            $tempPath = $altTempPath;
        }
        
        // Try to generate Excel file
        try {
            return Excel::download(new ProductsSampleExport, 'product_bulk_upload_sample.xlsx');
        } catch (\Exception $e) {
            // If Excel generation fails, fall through to CSV fallback
        }
        
        // Fallback: Serve pre-generated CSV or create on-the-fly
        $csvPath = public_path('download/product_bulk_upload_sample.csv');
        
        // Create CSV file if it doesn't exist
        if (!file_exists($csvPath)) {
            $data = [
                ['name', 'sku', 'price', 'image_url', 'category', 'brand', 'description'],
                ['Sample Product 1', 'SKU001', '150.00', 'https://example.com/images/product1.jpg', 'Electronics', 'Brand A', 'This is a sample product description.'],
                ['Sample Product 2', 'SKU002', '250.00', 'https://example.com/images/product2.jpg', 'Clothing', 'Brand B', 'Another sample product with different category and brand.'],
                ['Sample Product 3', 'SKU003', '99.99', 'https://example.com/images/product3.jpg', 'Home & Garden', 'Brand C', 'Sample product description for home and garden category.'],
            ];
            
            $dir = dirname($csvPath);
            if (!file_exists($dir)) {
                @mkdir($dir, 0777, true);
            }
            
            $file = fopen($csvPath, 'w');
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        }
        
        // Serve the CSV file
        if (file_exists($csvPath)) {
            return response()->download($csvPath, 'product_bulk_upload_sample.csv', [
                'Content-Type' => 'text/csv',
            ]);
        }
        
        // Last resort: Generate CSV on-the-fly
        $filename = 'product_bulk_upload_sample.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $data = [
            ['name', 'sku', 'price', 'image_url', 'category', 'brand', 'description'],
            ['Sample Product 1', 'SKU001', '150.00', 'https://example.com/images/product1.jpg', 'Electronics', 'Brand A', 'This is a sample product description.'],
            ['Sample Product 2', 'SKU002', '250.00', 'https://example.com/images/product2.jpg', 'Clothing', 'Brand B', 'Another sample product with different category and brand.'],
            ['Sample Product 3', 'SKU003', '99.99', 'https://example.com/images/product3.jpg', 'Home & Garden', 'Brand C', 'Sample product description for home and garden category.'],
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Delete old products
     * Can delete all products or products before a specific date
     */
    public function delete_old_products(Request $request)
    {
        try {
            $deleteOption = $request->input('delete_option', '30_days');
            $date = $request->input('date');
            
            // Build query based on option
            if ($deleteOption === 'all') {
                // Delete all products
                $productIds = Product::pluck('id')->toArray();
            } elseif ($deleteOption === 'before_date' && $date) {
                // Delete products created before the specified date
                $productIds = Product::where('created_at', '<', Carbon::parse($date))->pluck('id')->toArray();
            } else {
                // Default: Delete products older than 30 days
                $productIds = Product::where('created_at', '<', Carbon::now()->subDays(30))->pluck('id')->toArray();
            }
            
            if (empty($productIds)) {
                flash(translate('No products found to delete.'))->info();
                return back();
            }
            
            $count = count($productIds);
            
            // Delete in chunks to avoid memory issues
            $chunks = array_chunk($productIds, 100);
            $deleted = 0;
            
            foreach ($chunks as $chunk) {
                // Delete related data first
                DB::table('product_translations')->whereIn('product_id', $chunk)->delete();
                DB::table('product_stocks')->whereIn('product_id', $chunk)->delete();
                
                // Delete from cart_items table (not cart table)
                DB::table('cart_items')->whereIn('product_id', $chunk)->delete();
                
                // Also try to delete from cart table if it has product_id column (for older data)
                try {
                    DB::table('cart')->whereIn('product_id', $chunk)->delete();
                } catch (\Exception $e) {
                    // cart table doesn't have product_id, skip it
                }
                
                DB::table('product_category_pivot')->whereIn('product_id', $chunk)->delete();
                DB::table('product_relevant_product')->whereIn('product_id', $chunk)->orWhereIn('relevant_product_id', $chunk)->delete();
                DB::table('product_related_addons')->whereIn('product_id', $chunk)->delete();
                DB::table('product_taxes')->whereIn('product_id', $chunk)->delete();
                
                // Delete products directly from database
                $deleted += DB::table('products')->whereIn('id', $chunk)->delete();
            }
            
            // Clear all caches
            try {
                Cache::flush();
                Artisan::call('cache:clear');
                Artisan::call('view:clear');
            } catch (\Exception $cacheError) {
                // Cache clearing failed but deletion succeeded
            }
            
            flash(translate($deleted . ' products deleted successfully. Cache cleared.'))->success();
            
        } catch (\Exception $e) {
            flash(translate('Error deleting products: ' . $e->getMessage()))->error();
            \Log::error('Delete products error: ' . $e->getMessage());
        }
        
        return back();
    }
}
