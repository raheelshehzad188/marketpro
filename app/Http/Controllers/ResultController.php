<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;
use Illuminate\Support\Str;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $results = Result::with(['ttype1', 'ttype2', 'ttype3'])->orderBy('name', 'asc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $results = $results->where('name', 'like', '%' . $sort_search . '%');
        }
        $results = $results->paginate(15);

        return view('backend.quiz.result.index', compact('results', 'sort_search'));
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
        $result = new Result;


        $result->type1 = $request->garden1;
        $result->type2 = $request->garden2;
        $result->type3 = $request->garden3;
        $result->logo = $request->logo;
        $result->more_images = $request->more_images;
        $result->description = $request->description;

        $result->save();

        flash(translate('Result has been inserted successfully'))->success();
        return redirect()->route('results.index');
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
        $result  = Result::findOrFail($id);
        return view('backend.quiz.result.edit', compact('result'));
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
        $result = Result::findOrFail($id);
        $result->type1 = $request->garden1;
        $result->type2 = $request->garden2;
        $result->type3 = $request->garden3;
        $result->logo = $request->logo;
        $result->more_images = $request->more_images;
        $result->description = $request->description;

        $result->save();

        flash(translate('Result has been updated successfully'))->success();
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
        Result::destroy($id);

        flash(translate('Result has been deleted successfully'))->success();
        return redirect()->route('results.index');
    }
}
