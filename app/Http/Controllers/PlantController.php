<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plant;
use Illuminate\Support\Str;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $plants = Plant::orderBy('name', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $plants = $plants->where('name', 'like', '%'.$sort_search.'%');
        }
        $plants = $plants->paginate(15);
        return view('backend.quiz.plants.index', compact('plants', 'sort_search'));
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
        $plant = new Plant;
        $plant->name = $request->name;

        $plant->type = $request->type;
        $plant->coverage = $request->coverage;

        $plant->logo = $request->logo;
        $plant->save();

        $plant->gardens()->attach($request->gardens);

        flash(translate('Plant has been inserted successfully'))->success();
        return redirect()->route('plants.index');

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
        $plant  = Plant::findOrFail($id);
        $selected_gardens = $plant->gardens()->pluck('garden_id')->toArray();
        return view('backend.quiz.plants.edit', compact('plant','selected_gardens'));
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
        $plant = Plant::findOrFail($id);
        $plant->name = $request->name;

        $plant->type = $request->type;
        $plant->coverage = $request->coverage;
        $plant->logo = $request->logo;
        $plant->save();

        $plant->gardens()->sync($request->gardens);

        flash(translate('Plant has been updated successfully'))->success();
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
        Plant::destroy($id);

        flash(translate('Plant has been deleted successfully'))->success();
        return redirect()->route('plants.index');

    }
}
