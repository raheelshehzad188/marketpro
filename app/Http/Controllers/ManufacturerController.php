<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    public function index(Request $request)
    {
        $manufacturers = Manufacturer::orderBy('name', 'ASC')->paginate(15);

        return view('backend.manufacturers.index', compact('manufacturers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:manufacturers,name',
        ]);

        Manufacturer::create(['name' => $request->name]);

        flash('Manufacturer has been created successfully')->success();
        return redirect()->route('manufacturers.index');
    }

    public function edit($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        return view('backend.manufacturers.edit', compact('manufacturer'));
    }

    public function update(Request $request, $id)
    {
        $manufacturer = Manufacturer::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:manufacturers,name,' . $manufacturer->id,
        ]);

        $manufacturer->update(['name' => $request->name]);

        flash('Manufacturer has been updated successfully')->success();
        return redirect()->route('manufacturers.index');
    }

    public function destroy($id)
    {
        Manufacturer::destroy($id);
        flash('Manufacturer has been deleted successfully')->success();
        return redirect()->route('manufacturers.index');
    }
}
