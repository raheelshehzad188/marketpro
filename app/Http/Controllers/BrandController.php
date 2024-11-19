<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::orderBy('name', 'ASC')->paginate(15);

        return view('backend.brand.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name',
        ]);

        Brand::create(['name' => $request->name]);

        flash('Brand has been created successfully')->success();
        return redirect()->route('brands.index');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:brands,name,' . $brand->id,
        ]);

        $brand->update(['name' => $request->name]);

        flash('Brand has been updated successfully')->success();
        return redirect()->route('brands.index');
    }

    public function destroy($id)
    {
        Brand::destroy($id);
        flash('Brand has been deleted successfully')->success();
        return redirect()->route('brands.index');
    }
}
