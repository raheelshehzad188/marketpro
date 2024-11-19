<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MegaNav;
use App\Category;
use App\Models\Shop;
use Cache;

class MegaNavController extends Controller
{
    /**
     * Display a listing of the mega nav items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = MegaNav::query();

        $sort_search = null;

        // Apply nav_type filter
        if ($request->filled('nav_type')) {
            $query->where('nav_type', $request->nav_type);
        }

        // Apply shop filter (visibility)
        if ($request->filled('shop_id')) {
            $shopId = $request->shop_id;
            $query->whereHas('visibility', function ($q) use ($shopId) {
                $q->where('shop_id', $shopId);
            });
        }

        // Apply parent category filter
        if ($request->filled('parent_id')) {
            $query->where('parent_id', $request->parent_id);
        }

        // Apply search filter
        if ($request->filled('search')) {
            $sort_search = $request->search;
            $query->whereHas('category', function ($q) use ($sort_search) {
                $q->where('name', 'like', '%' . $sort_search . '%');
            });
        }

        $megaNavItems = $query->paginate(15);

        return view('backend.mega_nav.index', compact('megaNavItems', 'sort_search'));
    }


    /**
     * Show the form for creating a new mega nav item.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topLevelNodes = Category::where('parent_id', 0)->where('published', 1)->get();
        $allShops = Shop::all();

        return view('backend.mega_nav.create', compact('topLevelNodes', 'allShops'));
    }

    /**
     * Store a newly created mega nav item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $megaNav = new MegaNav();
        $megaNav->category_id = $request->selectedCategories_category_id;
        $megaNav->nav_type = $request->nav_type; // e.g., 'cross_gear' or 'cross_parts'
        $megaNav->is_parent = $request->is_parent; // true if it's a top-level item
        $megaNav->parent_id = $request->selectedCategories_parent_id; // Set parent if this is a child item
        $megaNav->visibility = $request->input('visibility', []); // Array of shop IDs for visibility

        $megaNav->save();

        // Handling visibility
        if ($request->has('visibility') && !empty($request->input('visibility'))) {
            $megaNav->visibility()->sync($request->input('visibility'));
        } else {
            // Set visibility to all shops if visibility is not provided or is empty
            $allShopIds = Shop::pluck('id')->all();
            $megaNav->visibility()->sync($allShopIds);
        }

       

        flash(translate('Mega Nav item has been inserted successfully'))->success();
        return redirect()->route('mega_nav.index');
    }

    /**
     * Show the form for editing the specified mega nav item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $megaNav = MegaNav::findOrFail($id);
        $topLevelNodes = Category::where('parent_id', 0)->where('published', 1)->get();

        // Fetch the selected category and parent details as objects
        $selectCategoryId = [$megaNav->category_id];
        $selectCategoryName = Category::where('id', $megaNav->category_id)->get();

        $selectParentCategoryId = [$megaNav->parent_id];
        $selectParentCategoryName = Category::where('id', $megaNav->parent_id)->get();

        // Fetch visibility information
        $visibilityShopIds = $megaNav->visibility ?? [];

        return view('backend.mega_nav.edit', compact(
            'megaNav',
            'topLevelNodes',
            'selectCategoryId',
            'selectCategoryName',
            'selectParentCategoryId',
            'selectParentCategoryName',
            'visibilityShopIds'
        ));
    }




    /**
     * Update the specified mega nav item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $megaNav = MegaNav::findOrFail($id);
        $megaNav->category_id = $request->selectedCategories_category_id;
        $megaNav->nav_type = $request->nav_type;
        $megaNav->is_parent = $request->is_parent;
        if ($request->is_parent == 1) {
            $megaNav->parent_id = null;
        } else {
            $megaNav->parent_id = $request->selectedCategories_parent_id;
        }

        $megaNav->visibility = $request->input('visibility', []); // Array of shop IDs

        $megaNav->save();

        // Handling visibility
        if ($request->has('visibility') && !empty($request->input('visibility'))) {
            $megaNav->visibility()->sync($request->input('visibility'));
        } else {
            // Set visibility to all shops if visibility is not provided or is empty
            $allShopIds = Shop::pluck('id')->all();
            $megaNav->visibility()->sync($allShopIds);
        }

      

        flash(translate('Mega Nav item has been updated successfully'))->success();
        return redirect()->route('mega_nav.index');
    }

    /**
     * Remove the specified mega nav item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $megaNav = MegaNav::findOrFail($id);
        $megaNav->delete();

        flash(translate('Mega Nav item has been deleted successfully'))->success();
        return redirect()->route('mega_nav.index');
    }

    /**
     * Update the visibility of a mega nav item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateVisibility(Request $request)
    {
        $megaNav = MegaNav::findOrFail($request->id);
        $megaNav->visibility = $request->input('visibility', []);

        $megaNav->save();
        return response()->json(['success' => true]);
    }
}
