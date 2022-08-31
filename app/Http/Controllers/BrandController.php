<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Auth;
use App\Upload;
use App\Category;
use App\BrandTranslation;
use App\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function import_file($url)
    {

        $info = pathinfo(strtolower($url));

        $str = substr($info['dirname'], strpos($info['dirname'], 'uploads') + 8);
        $str = str_replace("/", "_", $str);

        $file_name = $str . '_' . $info['filename'];



        $type = array(
            "jpg" => "image",
            "jpeg" => "image",
            "png" => "image",
            "svg" => "image",
            "webp" => "image",
            "gif" => "image",
            "mp4" => "video",
            "mpg" => "video",
            "mpeg" => "video",
            "webm" => "video",
            "ogg" => "video",
            "avi" => "video",
            "mov" => "video",
            "flv" => "video",
            "swf" => "video",
            "mkv" => "video",
            "wmv" => "video",
            "wma" => "audio",
            "aac" => "audio",
            "wav" => "audio",
            "mp3" => "audio",
            "zip" => "archive",
            "rar" => "archive",
            "7z" => "archive",
            "doc" => "document",
            "txt" => "document",
            "docx" => "document",
            "pdf" => "document",
            "csv" => "document",
            "xml" => "document",
            "ods" => "document",
            "xlr" => "document",
            "xls" => "document",
            "xlsx" => "document"
        );
        $upload = new Upload;

        $upload->extension = $info['extension'];
        if (isset($type[$upload->extension])) {
            $contents = file_get_contents($url);
            $name = substr($url, strrpos($url, '/') + 1);
            Storage::put('uploads/all/' . Str::slug($file_name) . '.' . $info['extension'], $contents);
            $upload->file_original_name = $info['filename'];
            $upload->file_name = 'uploads/all/' . Str::slug($file_name) . '.' . $info['extension'];
            $upload->user_id = Auth::user()->id;
            $upload->type = $type[$upload->extension];
            $upload->file_size = 99;
            $upload->save();
            return $upload->id;
        }
    }


    public function index(Request $request)
    {

        //////************Forth step**********///////////////////


        // DB::table('wp_xy57group_link_products')->orderBy('ID', 'desc')
        //     ->chunk(300, function ($products) {
        //         foreach ($products as $product) {
        //             DB::table('product_addon_pivot')->where('product_id', $product->group_id)->where('product_addon_id', $product->product_id)->update(['sort_order' => $product->number]);
        //         }
        //     });

        // exit();


        //////************Fifth step**********///////////////////

        // DB::table('categories')->orderBy('id', 'desc')
        //     ->chunk(300, function ($categories) {
        //         foreach ($categories as $cat) {

        //             $category = Category::findOrFail($cat->id);


        //             if ($cat->parent_id != "0") {
        //                 $category->parent_id = $cat->parent_id;

        //                 $parent = Category::find($cat->parent_id);
        //                 $category->level = $parent->level + 1;
        //             } else {
        //                 $category->parent_id = 0;
        //                 $category->level = 0;
        //             }

        //             $category->save();
        //         }
        //     });

        // exit();



        //////************Third step**********///////////////////

        // DB::table('wp_xy57term_relationships')
        //     ->join('categories', 'categories.id', '=', 'wp_xy57term_relationships.term_taxonomy_id')
        //     ->select('wp_xy57term_relationships.*')
        //    ->orderBy('categories.id', 'ASC')
        //     ->chunk(100, function ($files) {
        //         foreach ($files as $file) {
        //             DB::table('product_category_pivot')->insert([
        //                 ['product_id' => $file->object_id, 'category_id' => $file->term_taxonomy_id],
        //             ]);
        //         }
        //     });


        //////************First step**********///////////////////

        // DB::table('wp_xy57posts')
        //     ->join('wp_xy57postmeta', 'wp_xy57posts.ID', '=', 'wp_xy57postmeta.post_id')
        //     ->select('wp_xy57posts.*', 'wp_xy57postmeta.meta_key')
        //     ->where('wp_xy57posts.post_type', 'product')->where('wp_xy57postmeta.meta_key', '_thumbnail_id')
        //     ->orderBy('wp_xy57posts.ID', 'ASC')
        //     ->chunk(10, function ($posts) {
        //         foreach ($posts as $post) {
        //             $product_main = DB::table('products')->where('id', $post->ID)->first();
        //             if (!$product_main) {
        //                 $regular_price = DB::table('wp_xy57postmeta')->where('post_id', $post->ID)->where('meta_key', '_regular_price')->first();
        //                 if ($regular_price) {
        //                     $regular_price = $regular_price->meta_value;
        //                 } else {
        //                     $regular_price = '';
        //                 }
        //                 $fake_price = DB::table('wp_xy57postmeta')->where('post_id', $post->ID)->where('meta_key', 'fake_price')->first();
        //                 if ($fake_price) {
        //                     $fake_price = $fake_price->meta_value;
        //                 } else {
        //                     $fake_price = '';
        //                 }
        //                 $thumbnail_id = DB::table('wp_xy57postmeta')->where('post_id', $post->ID)->where('meta_key', '_thumbnail_id')->first();
        //                 if ($thumbnail_id) {
        //                     $thumbnail_id = $thumbnail_id->meta_value;
        //                 } else {
        //                     $thumbnail_id = false;
        //                 }
        //                 if ($thumbnail_id) {
        //                     $image_url = DB::table('wp_xy57posts')->where('ID', $thumbnail_id)->first()->guid;
        //                     $upload_id = $this->import_file($image_url);
        //                 }
        //                 $stock = DB::table('wp_xy57postmeta')->where('post_id', $post->ID)->where('meta_key', '_stock')->first();
        //                 if ($stock) {
        //                     $stock = $stock->meta_value;
        //                 } else {
        //                     $stock = 0;
        //                 }
        //                 $sku = DB::table('wp_xy57postmeta')->where('post_id', $post->ID)->where('meta_key', '_sku')->first();
        //                 if ($sku) {
        //                     $sku = $sku->meta_value;
        //                 } else {
        //                     $sku = '';
        //                 }

        //                 DB::table('products')->insert([
        //                     ['id' => $post->ID, 'parent_id' => 0, 'name' => $post->post_title, 'unit_price' => $regular_price, 'fake_price' => $fake_price, 'qty' => $stock, 'thumbnail_img' => $upload_id, 'sku' => $sku],
        //                 ]); //children
        //                 $product_children = DB::table('wp_xy57postmeta')->where('post_id', $post->ID)->where('meta_key', '_children')->first();
        //                 if ($product_children) {
        //                     $childrens = unserialize($product_children->meta_value);
        //                     foreach ($childrens as $child_post) {
        //                         $child_post_data = DB::table('wp_xy57posts')->where('ID', $child_post)->first();
        //                         //if product addon exists
        //                         $product_addon = DB::table('product_addons')->where('id', $child_post_data->ID)->first();
        //                         if (!$product_addon) {
        //                             $regular_price = DB::table('wp_xy57postmeta')->where('post_id', $child_post_data->ID)->where('meta_key', '_regular_price')->first();
        //                             if ($regular_price) {
        //                                 $regular_price = $regular_price->meta_value;
        //                             } else {
        //                                 $regular_price = '';
        //                             }
        //                             $fake_price = DB::table('wp_xy57postmeta')->where('post_id', $child_post_data->ID)->where('meta_key', 'fake_price')->first();
        //                             if ($fake_price) {
        //                                 $fake_price = $fake_price->meta_value;
        //                             } else {
        //                                 $fake_price = '';
        //                             }
        //                             $stock = DB::table('wp_xy57postmeta')->where('post_id', $child_post_data->ID)->where('meta_key', '_stock')->first();
        //                             if ($stock) {
        //                                 $stock = $stock->meta_value;
        //                             } else {
        //                                 $stock = 0;
        //                             }
        //                             $sku = DB::table('wp_xy57postmeta')->where('post_id', $child_post_data->ID)->where('meta_key', '_sku')->first();
        //                             if ($sku) {
        //                                 $sku = $sku->meta_value;
        //                             } else {
        //                                 $sku = '';
        //                             }


        //                             DB::table('product_addons')->insert([
        //                                 ['id' => $child_post_data->ID, 'name' => $child_post_data->post_title, 'unit_price' => $regular_price, 'fake_price' => $fake_price, 'qty' => $stock, 'sku' => $sku],
        //                             ]);
        //                         }
        //                         DB::table('product_addon_pivot')->insert([
        //                             ['product_id' => $post->ID, 'product_addon_id' =>  $child_post_data->ID],
        //                         ]);
        //                     }
        //                 }
        //             }
        //         }
        //     });



        //////************Second step**********///////////////////

        // DB::table('wp_xy57terms')
        //     ->join('wp_xy57term_taxonomy', 'wp_xy57terms.term_id', '=', 'wp_xy57term_taxonomy.term_id')
        //     ->select('wp_xy57terms.term_id', 'wp_xy57terms.name', 'wp_xy57terms.slug', 'wp_xy57term_taxonomy.parent')
        //     ->where('wp_xy57term_taxonomy.taxonomy', 'product_cat')->orderBy('wp_xy57terms.term_id', 'ASC')
        //     ->chunk(100, function ($files) {
        //         foreach ($files as $file) {
        //             $thumbnail_id = DB::table('wp_xy57termmeta')->where('term_id', $file->term_id)->where('meta_key', 'thumbnail_id')->first();
        //             if ($thumbnail_id) {
        //                 $thumbnail_id = $thumbnail_id->meta_value;
        //             } else {
        //                 $thumbnail_id = false;
        //             }
        //             if ($thumbnail_id) {
        //                 $image_url = DB::table('wp_xy57posts')->where('ID', $thumbnail_id)->first()->guid;
        //                 $upload_id = $this->import_file($image_url);
        //             }else{
        //                 $upload_id = null;
        //             }


        //             DB::table('categories')->insert([
        //                 ['id' => $file->term_id, 'parent_id' => $file->parent, 'name' => $file->name, 'slug' => $file->slug, 'icon' => $upload_id],
        //             ]);
        //         }
        //     });
        // exit();


        $sort_search = null;
        $brands = Brand::orderBy('name', 'asc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $brands = $brands->where('name', 'like', '%' . $sort_search . '%');
        }
        $brands = $brands->paginate(15);
        return view('backend.product.brands.index', compact('brands', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        if ($request->slug != null) {
            $brand->slug = str_replace(' ', '-', $request->slug);
        } else {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . Str::random(5);
        }

        $brand->logo = $request->logo;
        $brand->save();

        $brand_translation = BrandTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'brand_id' => $brand->id]);
        $brand_translation->name = $request->name;
        $brand_translation->save();

        flash(translate('Brand has been inserted successfully'))->success();
        return redirect()->route('brands.index');
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
    public function edit(Request $request, $id)
    {
        $lang   = $request->lang;
        $brand  = Brand::findOrFail($id);
        return view('backend.product.brands.edit', compact('brand', 'lang'));
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
        $brand = Brand::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE")) {
            $brand->name = $request->name;
        }
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        if ($request->slug != null) {
            $brand->slug = strtolower($request->slug);
        } else {
            $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . Str::random(5);
        }
        $brand->logo = $request->logo;
        $brand->save();

        $brand_translation = BrandTranslation::firstOrNew(['lang' => $request->lang, 'brand_id' => $brand->id]);
        $brand_translation->name = $request->name;
        $brand_translation->save();

        flash(translate('Brand has been updated successfully'))->success();
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
        $brand = Brand::findOrFail($id);
        Product::where('brand_id', $brand->id)->delete();
        foreach ($brand->brand_translations as $key => $brand_translation) {
            $brand_translation->delete();
        }
        Brand::destroy($id);

        flash(translate('Brand has been deleted successfully'))->success();
        return redirect()->route('brands.index');
    }
}
