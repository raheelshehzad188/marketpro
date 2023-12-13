<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\CategoryTranslation;
use App\Utility\CategoryUtility;
use Illuminate\Support\Str;
use Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $categories = Category::orderBy('id', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%' . $sort_search . '%');
        }
        $categories = $categories->paginate(15);
        return view('backend.product.categories.index', compact('categories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->get();

        return view('backend.product.categories.create', compact('categories'));
    }

    public function updatePublished(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->published = $request->status;

        $category->save();
        return 1;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->order_level = 0;
        if ($request->order_level != null) {
            $category->order_level = $request->order_level;
        }
        $category->digital = 0;
        $category->banner = $request->banner;
        $category->icon = $request->icon;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;

        if ($request->parent_id != "0") {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);
            $category->level = $parent->level + 1;
        }

        if ($request->slug != null) {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        } else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . Str::random(5);
        }
        if ($request->commision_rate != null) {
            $category->commision_rate = $request->commision_rate;
        }

        $category->save();

      
        flash(translate('Category has been inserted successfully'))->success();
        return redirect()->route('categories.index');
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
        $lang = $request->lang;
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->whereNotIn('id', CategoryUtility::children_ids($category->id, true))->where('id', '!=', $category->id)
            ->orderBy('name', 'asc')
            ->get();

        return view('backend.product.categories.edit', compact('category', 'categories', 'lang'));
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
        $category = Category::findOrFail($id);
        if ($request->lang == env("DEFAULT_LANGUAGE")) {
            $category->name = $request->name;
        }
        if ($request->order_level != null) {
            $category->order_level = $request->order_level;
        }
        $category->digital = $request->digital;
        $category->banner = $request->banner;
        $category->icon = $request->icon;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;

        $previous_level = $category->level;

        if ($request->parent_id != "0") {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);
            $category->level = $parent->level + 1;
        } else {
            $category->parent_id = 0;
            $category->level = 0;
        }

        if ($category->level > $previous_level) {
            CategoryUtility::move_level_down($category->id);
        } elseif ($category->level < $previous_level) {
            CategoryUtility::move_level_up($category->id);
        }

        if ($request->slug != null) {
            $category->slug = strtolower($request->slug);
        } else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)) . '-' . Str::random(5);
        }


        if ($request->commision_rate != null) {
            $category->commision_rate = $request->commision_rate;
        }
        $category->created_at = date('Y-m-d h:i', strtotime($request->created_at));

        $category->save();

      
        
        Cache::forget('featured_categories');
        flash(translate('Category has been updated successfully'))->success();
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
        $category = Category::findOrFail($id);
        $category->attributes()->detach();

        // Category Translations Delete
        foreach ($category->category_translations as $key => $category_translation) {
            $category_translation->delete();
        }

        foreach (Product::where('category_id', $category->id)->get() as $product) {
            $product->category_id = null;
            $product->save();
        }

        CategoryUtility::delete_category($id);
        Cache::forget('featured_categories');

        flash(translate('Category has been deleted successfully'))->success();
        return redirect()->route('categories.index');
    }

    public function updateFeatured(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->featured = $request->status;
        $category->save();
        Cache::forget('featured_categories');
        return 1;
    }


    public function get_products(Request $request)
    {
        $category_id = $request->id;
        $target = $request->target;
        $search = null;
        $products = Product::where('published', '1');
        if ($request->has('id') && $request->id != null) {
            $products->whereHas('categories', function ($q) use ($category_id) {
                $q->where('category_id', $category_id); // '=' is optional
            });
        }
        $products = $products->get();

        echo  view('backend.product.categories.product_select', compact('products', 'target'))->render();
    }

    public function copy_products(Request $request)
    {
        $source_product_id = $request->source_products;
        $target_product_id = $request->target_products;


        $detailedProduct  = \DB::table('product_addon_pivot')->where('product_id', $source_product_id)->get();

        if (!$detailedProduct->isEmpty()) {
            \DB::table('product_addon_pivot')->where('product_id', $target_product_id)->delete();
            foreach ($detailedProduct as $key => $product_addon) {
                \DB::table('product_addon_pivot')->insert([
                    'product_id' =>  $target_product_id,
                    'product_addon_id' => $product_addon->product_addon_id,
                    'sort_order' => $product_addon->sort_order
                ]);
            }
        }

        flash(translate('Product parts has been copied successfully'))->success();
        return back();
    }


    public function category_store($name, $order_level, $banner, $icon, $parent_id, $cID = 0, $with_product = 'without_product')
    {
        $category = new Category;
        $category->name = $name;
        $category->order_level = $order_level;
        $category->banner = $banner;
        $category->icon = $icon;
        if ($parent_id != "0") {
            $category->parent_id = $parent_id;

            $parent = Category::find($parent_id);
            $category->level = $parent->level + 1;
        }
        $category->save();

        //fetch relevant products
        $category_id = $cID;
        $q_products = Product::where('published', '1');
        $q_products->whereHas('categories', function ($q) use ($category_id) {
            $q->where('category_id', $category_id); // '=' is optional
        });

        $q_products = $q_products->get();
        if (!empty($q_products)) {
            foreach ($q_products as $product) {
                if ($with_product == 'without_product') {
                    $category->products()->attach($product->id);
                } else {
                    $this->product_store($product->id, $category->id);
                }
            }
        }

        return $category->id;
    }

    public function category_store_p($source_category_id, $target_category_id, $with_product = 'without_product')
    {
        $target_category = Category::find($target_category_id);


        $category_id = $source_category_id;
        $q_products = Product::where('published', '1');
        $q_products->whereHas('categories', function ($q) use ($category_id) {
            $q->where('category_id', $category_id); // '=' is optional
        });

        $q_products = $q_products->get();
        if (!empty($q_products)) {
            foreach ($q_products as $product) {
                if ($with_product == 'without_product') {
                    $target_category->products()->attach($product->id);
                } else {
                    $this->product_store($product->id, $target_category->id);
                }
            }
        }

        return $target_category->id;
    }

    public function product_store($product_id, $category_id)
    {
        $source_product = Product::find($product_id);

        $target_product = new Product;
        $target_product->name = $source_product->name;

        $target_product->short_name = $source_product->short_name;
        $target_product->other_name = $source_product->other_name;
        $target_product->article_group = $source_product->article_group;


        $target_product->thumbnail_img  = $source_product->thumbnail_img;
        $target_product->unit_price     = $source_product->unit_price;
        $target_product->fake_price     = $source_product->fake_price;
        $target_product->description = $source_product->description;

        $target_product->current_stock = $source_product->current_stock;
        $target_product->sku = $source_product->sku;

        $target_product->save();

        //fetch addons
        if (\DB::table('product_addon_pivot')->where('product_id', $source_product->id)->exists()) {
            $addons = \DB::table('product_addon_pivot')->where('product_id', $source_product->id)->select('*')->get();

            foreach ($addons as  $addon) {
                \DB::table('product_addon_pivot')->insert([
                    'product_id' => $target_product->id,
                    'product_addon_id' => $addon->product_addon_id,
                    'sort_order' => $addon->sort_order
                ]);
            }
        }

        $target_product->categories()->attach($category_id);
    }


    public function child_cat_recuring($child_category, $parent_cat)
    {
        $re_parent_id =  $this->category_store($child_category->name, 0, $child_category->banner, $child_category->icon, $parent_cat, $child_category->id);
        if ($child_category->categories) {
            foreach ($child_category->categories as $childCategory) {
                $this->child_cat_recuring($childCategory, $re_parent_id);
            }
        }
    }

    public function child_cat_delete_recuring($child_category)
    {
        Category::destroy($child_category->id);

        if ($child_category->categories) {
            foreach ($child_category->categories as $childCategory) {
                $this->child_cat_delete_recuring($childCategory);
            }
        }
    }

    public function copy_categories(Request $request)
    {
        $source_category_id = $request->source_category;
        $target_category_id = $request->target_category;


        $parentcategories = Category::where('parent_id', $source_category_id)
            ->with('childrenCategories')
            ->get();

        $delete_categories = Category::where('parent_id', $target_category_id)
            ->with('childrenCategories')
            ->get();

        foreach ($delete_categories as $category) {
            Category::destroy($category->id);
            foreach ($category->childrenCategories as $childCategory) {
                $this->child_cat_delete_recuring($childCategory);
            }
        }

        foreach ($parentcategories as $category) {
            $re_parent_id =  $this->category_store($category->name, 0, $category->banner, $category->icon, $target_category_id, $category->id);
            foreach ($category->childrenCategories as $childCategory) {
                $this->child_cat_recuring($childCategory, $re_parent_id);
            }
        }

        $this->category_store_p($source_category_id, $target_category_id);
        flash(translate('Categories has been copied successfully'))->success();
        return back();
    }



    public function copy_categories_products(Request $request)
    {
        $source_category_id = $request->source_category;
        $target_category_id = $request->target_category;




        $parentcategories = Category::where('parent_id', $source_category_id)
            ->with('childrenCategories')
            ->get();



        $delete_categories = Category::where('parent_id', $target_category_id)
            ->with('childrenCategories')
            ->get();

        foreach ($delete_categories as $category) {
            Category::destroy($category->id);
            foreach ($category->childrenCategories as $childCategory) {
                $this->child_cat_delete_recuring($childCategory);
            }
        }

        foreach ($parentcategories as $category) {
            $re_parent_id =  $this->category_store($category->name, 0, $category->banner, $category->icon, $target_category_id, $category->id, 'with_product');
            foreach ($category->childrenCategories as $childCategory) {
                $this->child_cat_recuring($childCategory, $re_parent_id);
            }
        }

        $this->category_store_p($source_category_id, $target_category_id, 'with_product');
        flash(translate('Categories has been copied successfully'))->success();
        return back();
    }
}
