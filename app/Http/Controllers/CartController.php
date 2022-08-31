<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\SubSubCategory;
use App\Category;
use App\Plant;
use App\Garden;
use App\Cart;
use App\UserResult;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Color;
use Cookie;

class CartController extends Controller
{
    public function index(Request $request)
    {
        //dd($cart->all());
        $categories = Category::all();
        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            if ($request->session()->get('temp_user_id')) {
                Cart::where('temp_user_id', $request->session()->get('temp_user_id'))
                    ->update(
                        [
                            'user_id' => $user_id,
                            'temp_user_id' => null
                        ]
                    );

                Session::forget('temp_user_id');
            }
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            // $carts = Cart::where('temp_user_id', $temp_user_id)->get();
            $carts = ($temp_user_id != null) ? Cart::where('temp_user_id', $temp_user_id)->get() : [];
        }

        return view('frontend.view_cart', compact('categories', 'carts'));
    }

    public function showCartModal(Request $request)
    {
        $product = Product::find($request->id);
        return view('frontend.partials.addToCart', compact('product'));
    }

    public function showCartModalAuction(Request $request)
    {
        $product = Product::find($request->id);
        return view('auction.frontend.addToCartAuction', compact('product'));
    }


    public function startProjectCart(Request $request)
    {
        $cart = array();
        $data = array();

        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            $data['user_id'] = $user_id;
            $cart = Cart::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
            if (empty($cart)) {
                $cart =  Cart::create($data);
            } else {
                Cart::where('id', '!=', $cart->id)->where('user_id', $user_id)->delete();
            }
        } else {
            if ($request->session()->get('temp_user_id')) {
                $temp_user_id = $request->session()->get('temp_user_id');
            } else {
                $temp_user_id = bin2hex(random_bytes(10));
                $request->session()->put('temp_user_id', $temp_user_id);
            }
            $data['temp_user_id'] = $temp_user_id;
            $cart = Cart::where('temp_user_id', $temp_user_id)->orderBy('created_at', 'desc')->first();
            if (empty($cart)) {
                $cart = Cart::create($data);
            }
        }



        if ($request->action == 1) {
            $request->validate(
                [
                    'email' => 'email:rfc,dns',
                ],
            );
            $data['cart_type'] = 2;
            $data['email'] = $request->email;
            $data['heared_about_us'] = $request->heared_about_us;

            if (!Auth::check()) {
                $rules = array('email' => 'unique:users,email');
                $validator = Validator::make($data, $rules);
                if ($validator->fails()) {
                    if (empty($request->password)) {
                        echo 'need_password';
                        exit();
                    } else {
                        $credentials = $request->only('email', 'password');
                        if (Auth::attempt($credentials)) {
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
                        } else {
                            return response()->json(['errors' => ['c' => ['Your password is incorrect']]], 422);
                        }
                    }
                }
            }
        }

        if ($request->action == 2) {
            $request->validate(
                [
                    'address' => 'required',
                ],
                [
                    'address' => 'Please enter a valid address.',
                ]
            );

            $data['cart_type'] = 2;
            $data['email'] = $cart->email;
            $data['heared_about_us'] = $cart->heared_about_us;
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
        }

        if ($request->action == 3) {

            if (empty($request->about_project)) {
                return response()->json(['errors' => ['c' => ['Where are you planning to build your garden?']]], 422);
            }

            if (empty($request->include)) {
                return response()->json(['errors' => ['c' => ['What elements would you like to include?']]], 422);
            }
            $data['cart_step'] = 1;
            $data['cart_type'] = 2;
            $data['email'] = $cart->email;
            $data['heared_about_us'] = $cart->heared_about_us;
            $data['phone'] = $cart->phone;
            $data['address'] = $cart->address;
            $data['include'] = json_encode($request->include);
            $data['comments'] = $request->comments;
            $data['about_project'] = $request->about_project;
        }



        Cart::where('id', $cart->id)->update($data);

        if ($request->action == 3) {
            if (empty($cart->product_id)) {
                echo 'package';
            } else {
                echo 'order';
            }
        }
    }

    public function quizCart(Request $request)
    {
        $cart = array();
        $data = array();

        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            $data['user_id'] = $user_id;
            $cart = Cart::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
            if (empty($cart)) {
                $cart =  Cart::create($data);
            } else {
                Cart::where('id', '!=', $cart->id)->where('user_id', $user_id)->delete();
            }
        } else {
            if ($request->session()->get('temp_user_id')) {
                $temp_user_id = $request->session()->get('temp_user_id');
            } else {
                $temp_user_id = bin2hex(random_bytes(10));
                $request->session()->put('temp_user_id', $temp_user_id);
            }
            $data['temp_user_id'] = $temp_user_id;
            $cart = Cart::where('temp_user_id', $temp_user_id)->orderBy('created_at', 'desc')->first();
            if (empty($cart)) {
                $cart = Cart::create($data);
            }
        }


        if ($request->action == 1) {
            if (empty($request->gardens) || count($request->gardens) < 3 || count($request->gardens) > 3) {
                return response()->json(['errors' => ['c' => ['Please select maximum 3 Gardens']]], 422);
            }

            $data['garden1'] = $request->gardens[0];
            $data['garden2'] = $request->gardens[1];
            $data['garden3'] = $request->gardens[2];
            $data['cart_type'] = 3;

            Cart::where('id', $cart->id)->update($data);

            echo $this->plants_tab($request->gardens[0], 1);
            //
        }

        if ($request->action == 2) {

            if (empty($request->plants)) {
                return response()->json(['errors' => ['c' => ['Please select some plants']]], 422);
            }

            $data['garden1'] = $cart->garden1;
            $data['garden2'] = $cart->garden2;
            $data['garden3'] = $cart->garden3;
            $data['cart_type'] = $cart->cart_type;
            $data['garden1_plants'] = json_encode($request->plants);


            Cart::where('id', $cart->id)->update($data);

            echo $this->plants_tab($cart->garden2, 2);
        }

        if ($request->action == 3) {

            if (empty($request->plants)) {
                return response()->json(['errors' => ['c' => ['Please select some plants']]], 422);
            }

            $data['garden1'] = $cart->garden1;
            $data['garden2'] = $cart->garden2;
            $data['garden3'] = $cart->garden3;
            $data['cart_type'] = $cart->cart_type;
            $data['garden1_plants'] = $cart->garden1_plants;
            $data['garden2_plants'] = json_encode($request->plants);

            Cart::where('id', $cart->id)->update($data);

            echo $this->plants_tab($cart->garden3, 3);
        }

        if ($request->action == 4) {
            if (empty($request->plants)) {
                return response()->json(['errors' => ['c' => ['Please select some plants']]], 422);
            }

            $data['garden1'] = $cart->garden1;
            $data['garden2'] = $cart->garden2;
            $data['garden3'] = $cart->garden3;
            $data['cart_type'] = $cart->cart_type;
            $data['garden1_plants'] = $cart->garden1_plants;
            $data['garden2_plants'] = $cart->garden2_plants;
            $data['garden3_plants'] = json_encode($request->plants);

            Cart::where('id', $cart->id)->update($data);

            if (auth()->user() != null) {
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

                    $data['user_results_id'] = $user_result->id;
                    Cart::where('id', $cart->id)->update($data);
                }

                echo route('results_style_quiz', $user_result->id);
                exit();
            } else {
                $request->session()->put('quiz_step', 'default');
                echo 'authenticate';
                exit();
            }
        }

        if ($request->action == 5) {

            $request->validate(['email' => 'email:rfc,dns'],);
            $data['email'] = $request->email;
            $data['heared_about_us'] = $request->heared_about_us;

            if (!Auth::check()) {
                $rules = array('email' => 'unique:users,email');
                $validator = Validator::make($data, $rules);
                if ($validator->fails()) {
                    if (empty($request->password)) {
                        echo 'need_password';
                        exit();
                    } else {
                        $credentials = $request->only('email', 'password');
                        if (Auth::attempt($credentials)) {
                            if (session('temp_user_id') != null) {
                                Cart::where('temp_user_id', session('temp_user_id'))
                                    ->update(
                                        [
                                            'user_id' => auth()->user()->id,
                                            'temp_user_id' => null
                                        ]
                                    );

                                Session::forget('temp_user_id');

                                $cart = Cart::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first();
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
                                    $data['user_results_id'] = $user_result->id;
                                    Cart::where('id', $cart->id)->update($data);
                                }
                                echo route('results_style_quiz', $user_result->id);
                            }
                        } else {
                            return response()->json(['errors' => ['c' => ['Your password is incorrect']]], 422);
                        }
                    }
                } else {
                    $data['email'] = $request->email;
                    $cart = Cart::where('temp_user_id', $temp_user_id)->orderBy('created_at', 'desc')->first();
                    if (!empty($cart)) {
                        $results = \DB::table('results')->whereRaw('(type1 = ' . $cart->garden1 . ' || type1 = ' . $cart->garden1 . ' || type1 = ' . $cart->garden1 . ') AND (type2 = ' . $cart->garden2 . ' || type2 = ' . $cart->garden2 . ' ||type2 = ' . $cart->garden2 . ') AND (type3 = ' . $cart->garden3 . ' || type3 = ' . $cart->garden3 . ' || type3 = ' . $cart->garden3 . ')')->first();
                        $user_result = UserResult::create([
                            'results_id' => $results->id,
                            'email' =>  $request->email,
                            'users_id' => 0,
                            'type1' => $cart->garden1,
                            'type2' =>  $cart->garden2,
                            'type3' =>  $cart->garden3,
                            'type1_plants' => $cart->garden1_plants,
                            'type2_plants' => $cart->garden2_plants,
                            'type3_plants' => $cart->garden3_plants,
                        ]);
                        $data['user_results_id'] = $user_result->id;
                        Cart::where('id', $cart->id)->update($data);
                        echo route('results_style_quiz', $user_result->id);
                    }

                    exit();
                }
            }
        }
    }

    public function plants_tab($garden_id, $action = "")
    {
        $garden  = Garden::with('plants')->findOrFail($garden_id);
        return  view('frontend.partials.plants_tab', compact('garden', 'action'))->render();
    }


    public function addToCartPackage(Request $request)
    {
        $cart_step = 0;
        $product = Product::find($request->id);
        $addons = $request->addon;

        $carts = array();
        $data = array();

        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            $data['user_id'] = $user_id;
            $cart = Cart::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
            if ($cart) {
                Cart::where('id', '!=', $cart->id)->where('user_id', $user_id)->delete();
            }
        } else {
            if ($request->session()->get('temp_user_id')) {
                $temp_user_id = $request->session()->get('temp_user_id');
            } else {
                $temp_user_id = bin2hex(random_bytes(10));
                $request->session()->put('temp_user_id', $temp_user_id);
            }
            $data['temp_user_id'] = $temp_user_id;
            $cart = Cart::where('temp_user_id', $temp_user_id)->orderBy('created_at', 'desc')->first();
        }


        $data['product_id'] = $product->id;
        $data['owner_id'] = $product->user_id;

        $str = '';
        $tax = 0;





        //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
        foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
            if ($str != null) {
                $str .= '-' . str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
            } else {
                $str .= str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
            }
        }

        $data['variation'] = $str;

        if ($str != null && $product->variant_product) {
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price = $product_stock->price;
            $quantity = $product_stock->qty;
        } else {
            $price = $product->unit_price;
        }

        //discount calculation
        $discount_applicable = false;

        if ($product->discount_start_date == null) {
            $discount_applicable = true;
        } elseif (
            strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date
        ) {
            $discount_applicable = true;
        }

        if ($discount_applicable) {
            if ($product->discount_type == 'percent') {
                $price -= ($price * $product->discount) / 100;
            } elseif ($product->discount_type == 'amount') {
                $price -= $product->discount;
            }
        }

        //calculation of taxes
        foreach ($product->taxes as $product_tax) {
            if ($product_tax->tax_type == 'percent') {
                $tax += ($price * $product_tax->tax) / 100;
            } elseif ($product_tax->tax_type == 'amount') {
                $tax += $product_tax->tax;
            }
        }

        if (!empty($addons)) {
            $data['addons'] = json_encode($addons);
        }

        $data['quantity'] = $request['quantity'];
        $data['price'] = $price;
        $data['tax'] = $tax;
        //$data['shipping'] = 0;
        $data['shipping_cost'] = 0;
        $data['product_referral_code'] = null;


        if ($request['quantity'] == null) {
            $data['quantity'] = 1;
        }

        if (Cookie::has('referred_product_id') && Cookie::get('referred_product_id') == $product->id) {
            $data['product_referral_code'] = Cookie::get('product_referral_code');
        }


        //previous data
        if (!empty($cart) && isset($cart->cart_type) && $cart->cart_type == 2) {
            $data['email'] = $cart->email;
            $data['heared_about_us'] = $cart->heared_about_us;
            $data['phone'] = $cart->phone;
            $data['address'] = $cart->address;
            $data['include'] = $cart->include;
            $data['comments'] = $cart->comments;
            $data['about_project'] = $cart->about_project;
        }


        if (empty($cart)) {
            Cart::create($data);
        } else {
            $cart_step = $cart->cart_step;
            Cart::where('id', $cart->id)->update($data);
        }

        return array(
            'cart_step' => $cart_step,
            'status' => 1,
            'cart_count' => count($carts),
        );
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $carts = array();
        $data = array();

        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            $data['user_id'] = $user_id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            if ($request->session()->get('temp_user_id')) {
                $temp_user_id = $request->session()->get('temp_user_id');
            } else {
                $temp_user_id = bin2hex(random_bytes(10));
                $request->session()->put('temp_user_id', $temp_user_id);
            }
            $data['temp_user_id'] = $temp_user_id;
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }

        $data['product_id'] = $product->id;
        $data['owner_id'] = $product->user_id;

        $str = '';
        $tax = 0;
        if ($product->auction_product == 0) {
            if ($product->digital != 1 && $request->quantity < $product->min_qty) {
                return array(
                    'status' => 0,
                    'cart_count' => count($carts),
                    'modal_view' => view('frontend.partials.minQtyNotSatisfied', ['min_qty' => $product->min_qty])->render(),
                    'nav_cart_view' => view('frontend.partials.cart')->render(),
                );
            }

            //check the color enabled or disabled for the product
            if ($request->has('color')) {
                $str = $request['color'];
            }

            if ($product->digital != 1) {
                //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
                foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
                    if ($str != null) {
                        $str .= '-' . str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                    } else {
                        $str .= str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                    }
                }
            }

            $data['variation'] = $str;

            if ($str != null && $product->variant_product) {
                $product_stock = $product->stocks->where('variant', $str)->first();
                $price = $product_stock->price;
                $quantity = $product_stock->qty;

                if ($quantity < $request['quantity']) {
                    return array(
                        'status' => 0,
                        'cart_count' => count($carts),
                        'modal_view' => view('frontend.partials.outOfStockCart')->render(),
                        'nav_cart_view' => view('frontend.partials.cart')->render(),
                    );
                }
            } else {
                $price = $product->unit_price;
            }

            //discount calculation
            $discount_applicable = false;

            if ($product->discount_start_date == null) {
                $discount_applicable = true;
            } elseif (
                strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date
            ) {
                $discount_applicable = true;
            }

            if ($discount_applicable) {
                if ($product->discount_type == 'percent') {
                    $price -= ($price * $product->discount) / 100;
                } elseif ($product->discount_type == 'amount') {
                    $price -= $product->discount;
                }
            }

            //calculation of taxes
            foreach ($product->taxes as $product_tax) {
                if ($product_tax->tax_type == 'percent') {
                    $tax += ($price * $product_tax->tax) / 100;
                } elseif ($product_tax->tax_type == 'amount') {
                    $tax += $product_tax->tax;
                }
            }

            $data['quantity'] = $request['quantity'];
            $data['price'] = $price;
            $data['tax'] = $tax;
            //$data['shipping'] = 0;
            $data['shipping_cost'] = 0;
            $data['product_referral_code'] = null;

            $data['digital'] = $product->digital;

            if ($request['quantity'] == null) {
                $data['quantity'] = 1;
            }

            if (Cookie::has('referred_product_id') && Cookie::get('referred_product_id') == $product->id) {
                $data['product_referral_code'] = Cookie::get('product_referral_code');
            }

            if ($carts && count($carts) > 0) {
                $foundInCart = false;

                foreach ($carts as $key => $cartItem) {
                    $cart_product = Product::where('id', $cartItem['product_id'])->first();
                    if ($cart_product->auction_product == 1) {
                        return array(
                            'status' => 0,
                            'cart_count' => count($carts),
                            'modal_view' => view('frontend.partials.auctionProductAlredayAddedCart')->render(),
                            'nav_cart_view' => view('frontend.partials.cart')->render(),
                        );
                    }

                    if ($cartItem['product_id'] == $request->id) {
                        $product_stock = $product->stocks->where('variant', $str)->first();
                        $quantity = $product_stock->qty;
                        if ($quantity < $cartItem['quantity'] + $request['quantity']) {
                            return array(
                                'status' => 0,
                                'cart_count' => count($carts),
                                'modal_view' => view('frontend.partials.outOfStockCart')->render(),
                                'nav_cart_view' => view('frontend.partials.cart')->render(),
                            );
                        }
                        if (($str != null && $cartItem['variation'] == $str) || $str == null) {
                            $foundInCart = true;

                            $cartItem['quantity'] += $request['quantity'];
                            $cartItem->save();
                        }
                    }
                }
                if (!$foundInCart) {
                    Cart::create($data);
                }
            } else {
                Cart::create($data);
            }

            if (auth()->user() != null) {
                $user_id = Auth::user()->id;
                $carts = Cart::where('user_id', $user_id)->get();
            } else {
                $temp_user_id = $request->session()->get('temp_user_id');
                $carts = Cart::where('temp_user_id', $temp_user_id)->get();
            }
            return array(
                'status' => 1,
                'cart_count' => count($carts),
                'modal_view' => view('frontend.partials.addedToCart', compact('product', 'data'))->render(),
                'nav_cart_view' => view('frontend.partials.cart')->render(),
            );
        } else {

            $price = $product->bids->max('amount');

            foreach ($product->taxes as $product_tax) {
                if ($product_tax->tax_type == 'percent') {
                    $tax += ($price * $product_tax->tax) / 100;
                } elseif ($product_tax->tax_type == 'amount') {
                    $tax += $product_tax->tax;
                }
            }

            $data['quantity'] = 1;
            $data['price'] = $price;
            $data['tax'] = $tax;
            $data['shipping_cost'] = 0;
            $data['product_referral_code'] = null;
            $data['cash_on_delivery'] = $product->cash_on_delivery;
            $data['digital'] = $product->digital;

            if (count($carts) == 0) {
                Cart::create($data);
            }
            if (auth()->user() != null) {
                $user_id = Auth::user()->id;
                $carts = Cart::where('user_id', $user_id)->get();
            } else {
                $temp_user_id = $request->session()->get('temp_user_id');
                $carts = Cart::where('temp_user_id', $temp_user_id)->get();
            }
            return array(
                'status' => 1,
                'cart_count' => count($carts),
                'modal_view' => view('frontend.partials.addedToCart', compact('product', 'data'))->render(),
                'nav_cart_view' => view('frontend.partials.cart')->render(),
            );
        }
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
        Cart::destroy($request->id);
        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }

        return array(
            'cart_count' => count($carts),
            'cart_view' => view('frontend.partials.cart_details', compact('carts'))->render(),
            'nav_cart_view' => view('frontend.partials.cart')->render(),
        );
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $object = Cart::findOrFail($request->id);

        if ($object['id'] == $request->id) {
            $product = \App\Product::find($object['product_id']);
            $product_stock = $product->stocks->where('variant', $object['variation'])->first();
            $quantity = $product_stock->qty;

            if ($quantity >= $request->quantity) {
                if ($request->quantity >= $product->min_qty) {
                    $object['quantity'] = $request->quantity;
                }
            }

            $object->save();
        }

        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            $carts = Cart::where('user_id', $user_id)->get();
        } else {
            $temp_user_id = $request->session()->get('temp_user_id');
            $carts = Cart::where('temp_user_id', $temp_user_id)->get();
        }

        return array(
            'cart_count' => count($carts),
            'cart_view' => view('frontend.partials.cart_details', compact('carts'))->render(),
            'nav_cart_view' => view('frontend.partials.cart')->render(),
        );
    }
}
