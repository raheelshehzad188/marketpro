<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Garden;
use Illuminate\Support\Str;

class GardenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $gardens = Garden::orderBy('name', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $gardens = $gardens->where('name', 'like', '%'.$sort_search.'%');
        }
        $gardens = $gardens->paginate(15);
        return view('backend.quiz.gardens.index', compact('gardens', 'sort_search'));
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
        $garden = new Garden;
        $garden->name = $request->name;
        $garden->included = !empty($request->included) ? json_encode($request->included) : json_encode(array());

        $garden->logo = $request->logo;
        $garden->save();

        flash(translate('Garden has been inserted successfully'))->success();
        return redirect()->route('gardens.index');

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
        $garden  = Garden::findOrFail($id);
        return view('backend.quiz.gardens.edit', compact('garden'));
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
        $garden = Garden::findOrFail($id);
        $garden->name = $request->name;
        $garden->included = !empty($request->included) ? json_encode($request->included) : json_encode(array());
        $garden->logo = $request->logo;
        $garden->save();

        flash(translate('Garden has been updated successfully'))->success();
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
        Garden::destroy($id);

        flash(translate('Garden has been deleted successfully'))->success();
        return redirect()->route('gardens.index');

    }
}
