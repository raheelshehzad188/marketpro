<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipping;
use App\Models\Country;
use App\Models\Shop;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    public function index(Request $request)
    {
        $sort_search = null;
        $shippings = Shipping::with(['country', 'visibility'])->orderBy('id', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $shippings = $shippings->where('name', 'like', '%' . $sort_search . '%');
        }
        $shippings = $shippings->paginate(15);

        // Fetch visibility information for each shipping method
        foreach ($shippings as $shipping) {
            $shipping->visibilityShops = $shipping->visibility()->pluck('name', 'id')->toArray();
        }

        return view('backend.shippings.index', compact('shippings', 'sort_search'));
    }


    public function create()
    {
        $countries = Country::all();
        return view('backend.shippings.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'country_id' => 'nullable|exists:countries,id',
            'visibility' => 'sometimes|array',
            'visibility.*' => 'exists:shops,id',
        ]);

        if ($validator->fails()) {
            $errorMessages = implode(' ', $validator->errors()->all());
            flash(translate($errorMessages))->error();
            return redirect()->back()->withInput();
        }

        $shipping = new Shipping;
        $shipping->name = $request->name;
        $shipping->cost = $request->cost;
        $shipping->country_id = $request->country_id;
        $shipping->save();

        // Handling visibility
        if ($request->has('visibility') && !empty($request->input('visibility'))) {
            $shipping->visibility()->sync($request->input('visibility'));
        } else {
            // Set visibility to all shops if visibility is not provided or is empty
            $allShopIds = Shop::pluck('id')->all();
            $shipping->visibility()->sync($allShopIds);
        }

        flash(translate('Shipping has been inserted successfully'))->success();
        return redirect()->route('shippings.index');
    }

    public function edit(Request $request, $id)
    {
        // Fetch the shipping method by ID
        $shipping = Shipping::find($id);

        // Check if the shipping method exists
        if (!$shipping) {
            abort(404, 'Shipping method not found.');
        }

        $countries = Country::all();

        // Fetch visibility information
        $visibilityShopIds = $shipping->visibility()->pluck('shops.id')->toArray();

        

        return view('backend.shippings.edit', compact('shipping', 'countries', 'visibilityShopIds'));
    }



    public function update(Request $request, Shipping $shipping)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'country_id' => 'nullable|exists:countries,id',
            'visibility' => 'sometimes|array',
            'visibility.*' => 'exists:shops,id',
        ]);

        if ($validator->fails()) {
            $errorMessages = implode(' ', $validator->errors()->all());
            flash(translate($errorMessages))->error();
            return redirect()->back()->withInput();
        }

        $shipping->name = $request->name;
        $shipping->cost = $request->cost;
        $shipping->country_id = $request->country_id;
        $shipping->save();

        // Handling visibility
        if ($request->has('visibility') && !empty($request->input('visibility'))) {
            $shipping->visibility()->sync($request->input('visibility'));
        } else {
            // Set visibility to all shops if visibility is not provided or is empty
            $allShopIds = Shop::pluck('id')->all();
            $shipping->visibility()->sync($allShopIds);
        }

        flash(translate('Shipping has been updated successfully'))->success();
        return back();
    }


    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        flash(translate('Shipping has been deleted successfully'))->success();
        return redirect()->route('shippings.index');
    }
}
