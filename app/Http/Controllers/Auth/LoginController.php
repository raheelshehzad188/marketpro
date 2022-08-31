<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\Customer;
use App\Garden;
use App\Plant;
use App\Result;
use App\UserResult;
use App\Cart;
use Session;
use Illuminate\Http\Request;
use CoreComponentRepository;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /*protected $redirectTo = '/';*/


    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            if ($provider == 'twitter') {
                $user = Socialite::driver('twitter')->user();
            } else {
                $user = Socialite::driver($provider)->stateless()->user();
            }
        } catch (\Exception $e) {
            flash("Something Went wrong. Please try again.")->error();
            return redirect()->route('user.login');
        }

        // check if they're an existing user
        $existingUser = User::where('provider_id', $user->id)->first();

        if ($existingUser) {
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->email_verified_at = date('Y-m-d H:m:s');
            $newUser->provider_id     = $user->id;
            $newUser->save();

            $customer = new Customer;
            $customer->user_id = $newUser->id;
            $customer->save();

            auth()->login($newUser, true);
        }
        if (session('link') != null) {
            return redirect(session('link'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return $request->only($this->username(), 'password');
        }
        return ['phone' => $request->get('email'), 'password' => $request->get('password')];
    }

    /**
     * Check user's role and redirect user based on their role
     * @return
     */
    public function authenticated()
    {
        if (session('temp_user_id') != null) {
            Cart::where('temp_user_id', session('temp_user_id'))
                ->update(
                    [
                        'user_id' => auth()->user()->id,
                        'temp_user_id' => null
                    ]
                );

            Session::forget('temp_user_id');
        }

        if (session('quiz_step') != null) {
            $cart = Cart::where('user_id', auth()->user()->id)->first();
            if (!empty($cart)) {
                $results = \DB::table('results')->whereRaw('(type1 = ' . $cart->garden1 . ' || type1 = ' . $cart->garden1 . ' || type1 = ' . $cart->garden1 . ') AND (type2 = ' . $cart->garden2 . ' || type2 = ' . $cart->garden2 . ' ||type2 = ' . $cart->garden2 . ') AND (type3 = ' . $cart->garden3 . ' || type3 = ' . $cart->garden3 . ' || type3 = ' . $cart->garden3 . ')')->first();
                $user_result = UserResult::create([
                    'results_id' => $results->id,
                    'users_id' => auth()->user()->id,
                    'type1' => $cart->garden1,
                    'type2' =>  $cart->garden2,
                    'type3' =>  $cart->garden3,
                    'type1_plants' => $cart->garden1_plants,
                    'type2_plants' => $cart->garden2_plants,
                    'type3_plants' => $cart->garden3_plants,
                ]);
            }
            return response()->json(['redirect' => route('results_style_quiz', $user_result->id), 'source' => 'unknown'], 201);
        } elseif (session('confirm_order') != null) {
            return response()->json(['redirect' => route('confirm_order'), 'source' => 'unknown'], 201);
        } elseif (auth()->user()->user_type == 'admin') {
            return response()->json(['redirect' => route('admin.dashboard'), 'source' => 'unknown'], 201);
            //return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->user_type == 'customer') {
            return response()->json(['redirect' => route('poin-of-sales.index'), 'source' => 'unknown'], 201);
        } else {
            if (session('link') != null) {
                return response()->json(['redirect' => session('link'), 'source' => 'unknown'], 201);
                // return redirect(session('link'));
            } else {
                return response()->json(['redirect' => route('dashboard'), 'source' => 'unknown'], 201);
                //return redirect()->route('trips');
            }
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json(['errors' => ['c' => ['Invalid email or password']]], 422);
        //flash(translate('Invalid email or password'))->error();
        //return back();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $redirect_route = 'login';
        //User's Cart Delete
        if (auth()->user()) {
            Cart::where('user_id', auth()->user()->id)->delete();
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route($redirect_route);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
