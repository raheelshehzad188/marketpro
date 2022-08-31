<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductAddon;
use App\Product;
use Illuminate\Support\Str;

class ProductAddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $product_addons = ProductAddon::orderBy('id', 'DESC');

        if ($request->has('search')) {
            $sort_search = $request->search;
            $product_addons = $product_addons->where('name', 'like', '%' . $sort_search . '%');
        }
        $product_addons = $product_addons->paginate(15);
        return view('backend.product.addons.index', compact('product_addons', 'sort_search'));
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
        $product_addon = new ProductAddon;
        $product_addon->name = $request->product_name;

        $product_addon->other_name = $request->other_name;
        $product_addon->short_name = $request->short_name;
        $product_addon->article_group = $request->article_group;
        $product_addon->fake_price = $request->fake_price;
        $product_addon->qty = $request->current_stock;
        $product_addon->sku = $request->sku;
        $product_addon->unit_price = $request->unit_price;

        $product_addon->save();

        flash(translate('Addon has been inserted successfully'))->success();
        return redirect()->route('product-addons.index');
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
        $product_addon  = ProductAddon::findOrFail($id);
        return view('backend.product.addons.edit', compact('product_addon'));
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
        $product_addon = ProductAddon::findOrFail($id);

        $product_addon->name = $request->product_name;
        $product_addon->other_name = $request->other_name;
        $product_addon->short_name = $request->short_name;
        $product_addon->article_group = $request->article_group;
        $product_addon->fake_price = $request->fake_price;
        $product_addon->qty = $request->current_stock;
        $product_addon->sku = $request->sku;
        $product_addon->unit_price = $request->unit_price;

        $product_addon->save();

        flash(translate('Product Addon has been updated successfully'))->success();
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
        ProductAddon::destroy($id);
        flash(translate('Product Addon has been deleted successfully'))->success();
        return redirect()->route('product-addons.index');
    }
}
