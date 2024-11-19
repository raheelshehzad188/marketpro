<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year;

class YearController extends Controller
{
    public function index(Request $request)
    {
        $years = Year::orderBy('name', 'ASC')->paginate(15);

        return view('backend.year.index', compact('years'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:years,name',
        ]);

        Year::create(['name' => $request->name]);

        flash('Year has been created successfully')->success();
        return redirect()->route('years.index');
    }

    public function edit($id)
    {
        $year = Year::findOrFail($id);
        return view('backend.year.edit', compact('year'));
    }

    public function update(Request $request, $id)
    {
        $year = Year::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:years,name,' . $year->id,
        ]);

        $year->update(['name' => $request->name]);

        flash('Year has been updated successfully')->success();
        return redirect()->route('years.index');
    }

    public function destroy($id)
    {
        Year::destroy($id);
        flash('Year has been deleted successfully')->success();
        return redirect()->route('years.index');
    }
}
