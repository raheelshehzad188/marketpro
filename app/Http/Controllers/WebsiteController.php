<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
	public function header(Request $request)
	{
		$primaryNavigation = json_decode(get_setting('primary_navigation'), true);
		$secondaryNavigation = json_decode(get_setting('secondary_navigation'), true);

		return view('backend.website_settings.header',compact('primaryNavigation', 'secondaryNavigation'));
	}
	public function footer(Request $request)
	{
		$lang = $request->lang;
		return view('backend.website_settings.footer', compact('lang'));
	}
	public function pages(Request $request)
	{
		return view('backend.website_settings.pages.index');
	}
	public function appearance(Request $request)
	{
		return view('backend.website_settings.appearance');
	}
}
