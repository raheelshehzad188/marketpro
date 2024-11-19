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

        $currentDomain = app('currentDomain'); // Access the bound domain
        $domainConfig = app('domainConfig');
        return view('frontend.pages.home');
    }

    public function treeView()
    {
        return view('frontend.pages.home');
    }
}
