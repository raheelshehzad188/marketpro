<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\Cart;
use App\BusinessSetting;
use App\Garden;
use App\Plant;
use App\Result;
use App\UserResult;
use App\OtpConfiguration;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPVerificationController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cookie;
use Session;
use Nexmo;
use Twilio\Rest\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        $customer = new Customer;
        $customer->user_id = $user->id;
        $customer->save();

        if (session('temp_user_id') != null) {
            Cart::where('temp_user_id', session('temp_user_id'))
                ->update([
                    'user_id' => $user->id,
                    'temp_user_id' => null
                ]);
            $cart = Cart::where('user_id', $user->id)->first();
            User::where('id', $user->id)->update(['heared_about_us' => $cart->heared_about_us, 'phone' =>  $cart->phone, 'address' => $cart->address]);
            Session::forget('temp_user_id');
        }

        if (Cookie::has('referral_code')) {
            $referral_code = Cookie::get('referral_code');
            $referred_by_user = User::where('referral_code', $referral_code)->first();
            if ($referred_by_user != null) {
                $user->referred_by = $referred_by_user->id;
                $user->save();
            }
        }

        return $user;
    }

    public function register(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if (User::where('email', $request->email)->first() != null) {
                return response()->json(['errors' => ['c' => ['Email already exists.']]], 422);
                //flash(translate('This Email already exists.Please login!'));
                //return redirect()->route('user.login');
            }
        }

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        if ($user->email != null) {
            if (BusinessSetting::where('type', 'email_verification')->first()->value != 1) {
                $user->email_verified_at = date('Y-m-d H:m:s');
                $user->save();
                // flash(translate('Registration successfull.'))->success();
            } else {
                event(new Registered($user));
                //flash(translate('Registration successfull. Please verify your email.'))->success();
            }
        }

        return $this->registered($request, $user) ?: response()->json(['redirect' => $this->redirectPath(), 'source' => 'unknown'], 201); //redirect();
    }

    protected function registered(Request $request, $user)
    {
        if (session('quiz_step') != null) {

            $cart = Cart::where('user_id', $user->id)->first();
            if (!empty($cart)) {
                $results = \DB::table('results')->whereRaw('(type1 = ' . $cart->garden1 . ' || type1 = ' . $cart->garden1 . ' || type1 = ' . $cart->garden1 . ') AND (type2 = ' . $cart->garden2 . ' || type2 = ' . $cart->garden2 . ' ||type2 = ' . $cart->garden2 . ') AND (type3 = ' . $cart->garden3 . ' || type3 = ' . $cart->garden3 . ' || type3 = ' . $cart->garden3 . ')')->first();
                $user_result = UserResult::create([
                    'results_id' => $results->id,
                    'users_id' => $user->id,
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
        } else if ($user->email == null) {
            return response()->json(['redirect' => route('verification'), 'source' => 'unknown'], 201);
            //return redirect()->route('verification'); session('confirm_order')
        } elseif (session('link') != null) {
            return response()->json(['redirect' => session('link'), 'source' => 'unknown'], 201);
        } else {
            return response()->json(['redirect' => route('home'), 'source' => 'unknown'], 201);
            //return redirect()->route('dashboard');
        }
    }
}
