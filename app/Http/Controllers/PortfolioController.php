<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PortfolioCategory;
use App\Portfolio;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $portfolios = Portfolio::orderBy('id', 'desc');

        if ($request->search != null){
            $portfolios = $portfolios->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $portfolios = $portfolios->paginate(15);

        return view('backend.portfolio_system.portfolio.index', compact('portfolios','sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $portfolio_categories = PortfolioCategory::all();
        return view('backend.portfolio_system.portfolio.create', compact('portfolio_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
        ]);

        $portfolio = new Portfolio;

        $portfolio->category_id = $request->category_id;
        $portfolio->title = $request->title;
        $portfolio->banner = $request->banner;
        $portfolio->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $portfolio->short_description = $request->short_description;
        $portfolio->description = $request->description;

        $portfolio->feature_image = $request->feature_image;
        $portfolio->example = !empty($request->example) ? json_encode($request->example) : json_encode(array());
        $portfolio->more_images = !empty($request->more_images) ? json_encode($request->more_images) : json_encode(array());


        $portfolio->meta_title = $request->meta_title;
        $portfolio->meta_img = $request->meta_img;
        $portfolio->meta_description = $request->meta_description;
        $portfolio->meta_keywords = $request->meta_keywords;

        $portfolio->save();

        flash(translate('Portfolio post has been created successfully'))->success();
        return redirect()->route('portfolio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio_categories = PortfolioCategory::all();

        return view('backend.portfolio_system.portfolio.edit', compact('portfolio','portfolio_categories'));
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
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|max:255',
        ]);

        $portfolio = Portfolio::find($id);

        $portfolio->category_id = $request->category_id;
        $portfolio->title = $request->title;
        $portfolio->banner = $request->banner;
        $portfolio->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        $portfolio->short_description = $request->short_description;
        $portfolio->description = $request->description;

        $portfolio->feature_image = $request->feature_image;
        $portfolio->example = !empty($request->example) ? json_encode($request->example) : json_encode(array());
        $portfolio->more_images = !empty($request->more_images) ? json_encode($request->more_images) : json_encode(array());

        $portfolio->meta_title = $request->meta_title;
        $portfolio->meta_img = $request->meta_img;
        $portfolio->meta_description = $request->meta_description;
        $portfolio->meta_keywords = $request->meta_keywords;

        $portfolio->save();

        flash(translate('Portfolio post has been updated successfully'))->success();
        return redirect()->route('portfolio.index');
    }

    public function change_status(Request $request) {
        $portfolio = Portfolio::find($request->id);
        $portfolio->status = $request->status;

        $portfolio->save();
        return 1;
    }

    public function change_feature(Request $request) {
        $portfolio = Portfolio::find($request->id);
        $portfolio->feature_status = $request->status;

        $portfolio->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Portfolio::find($id)->delete();
        return redirect()->route('portfolio.index');
    }


    public function all_portfolio() {
        $portfolios = Portfolio::where('status', 1)->orderBy('created_at', 'desc')->paginate(12);
        return view("frontend.portfolio.listing", compact('portfolios'));
    }

    public function portfolio_details($slug) {
        $portfolio = Portfolio::where('slug', $slug)->first();
        return view("frontend.portfolio.details", compact('portfolio'));
    }
}
