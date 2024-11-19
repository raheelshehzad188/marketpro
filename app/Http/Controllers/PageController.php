<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Models\Shop;
use App\PageTranslation;


class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.website_settings.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page;
        $page->title = $request->title;

        $page->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $page->type             = "custom_page";
        $page->banner          = $request->banner;
        $page->content          = $request->content;
        $page->meta_title       = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->keywords         = $request->keywords;
        $page->meta_image       = $request->meta_image;
        $page->save();

        // Handling product visibility
        if ($request->has('visibility') && !empty($request->input('visibility'))) {
            $page->visibility()->sync($request->input('visibility'));
        } else {
            // Set visibility to all shops if visibility is not provided or is empty
            $allShopIds = Shop::pluck('id')->all();
            $page->visibility()->sync($allShopIds);
        }

        flash(translate('New page has been created successfully'))->success();
        return redirect()->route('website.pages');
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
        $lang = $request->lang;
        $page_name = $request->page;
        $page = Page::where('id', $id)->first();

         // Fetching visibility shop_ids
         $visibilityShopIds = $page->visibility()->pluck('id')->toArray();
        if ($page != null) {
            if ($page_name == 'home') {
                return view('backend.website_settings.pages.home_page_edit', compact('page', 'lang'));
            } elseif ($page->type  == 'home_mxe') {
                return view('backend.website_settings.pages.home_page_mxe_edit', compact('page', 'lang'));
            } else {
                return view('backend.website_settings.pages.edit', compact('page', 'lang','visibilityShopIds'));
            }
        }
        abort(404);
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
        $page = Page::findOrFail($id);
        if ($page->type == 'custom_page') {
            $page->slug           = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        if ($request->lang == env("DEFAULT_LANGUAGE")) {
            $page->title          = $request->title;
            $page->content        = $request->content;
        }
        $page->banner          = $request->banner;
        $page->meta_title       = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->keywords         = $request->keywords;
        $page->meta_image       = $request->meta_image;
        $page->save();



        // Handling product visibility
        if ($request->has('visibility') && !empty($request->input('visibility'))) {
            $page->visibility()->sync($request->input('visibility'));
        } else {
            // Set visibility to all shops if visibility is not provided or is empty
            $allShopIds = Shop::pluck('id')->all();
            $page->visibility()->sync($allShopIds);
        }


        flash(translate('Page has been updated successfully'))->success();
        return redirect()->route('website.pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        foreach ($page->page_translations as $key => $page_translation) {
            $page_translation->delete();
        }
        if (Page::destroy($id)) {
            flash(translate('Page has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }

    public function show_custom_page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page != null) {
            return view('frontend.custom_page', compact('page'));
        }
        abort(404);
    }
    public function mobile_custom_page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page != null) {
            return view('frontend.m_custom_page', compact('page'));
        }
        abort(404);
    }
}
