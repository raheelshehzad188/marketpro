<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

use Illuminate\Support\Facades\Session;
use Cookie;
use Illuminate\Support\Str;
use App\Mail\SecondEmailVerifyMailManager;
use Mail;
use Illuminate\Auth\Events\PasswordReset;
use Cache;


class FrontController extends Controller
{
    /**
     * Show the application frontend home.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $domainConfig = app('domainConfig'); // Retrieve the matched domain configuration

        // Access the domain-specific home view
        $homeView = $domainConfig['views']['home'];

        // Render the domain-specific home view
        return view($homeView);
    }


    public function treeView()
    {
        return view('frontend.pages.tree_view');
    }
}
