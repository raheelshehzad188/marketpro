<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipping;

use Illuminate\Support\Str;
use Cache;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $shippings = Shipping::orderBy('id', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $shippings = $shippings->where('name', 'like', '%' . $sort_search . '%');
        }
        $shippings = $shippings->paginate(15);
        return view('backend.shippings.index', compact('shippings', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shippings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shipping = new Shipping;
        $shipping->name = $request->name;
        $shipping->cost = $request->cost;

        $shipping->save();


        flash(translate('Shipping has been inserted successfully'))->success();
        return redirect()->route('shippings.index');
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
        $shipping = Shipping::findOrFail($id);
        return view('backend.shippings.edit', compact('shipping'));
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
        $shipping = Shipping::findOrFail($id);

        $shipping->name = $request->name;
        $shipping->cost = $request->cost;
        $shipping->save();


        flash(translate('Shipping has been updated successfully'))->success();
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
        Shipping::destroy($id);
        flash(translate('Shipping has been deleted successfully'))->success();
        return redirect()->route('shippings.index');
    }
}
