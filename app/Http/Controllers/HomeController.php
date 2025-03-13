<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Category;
use App\FlashDeal;
use App\Brand;
use App\Product;
use App\Portfolio;
use App\PickupPoint;
use App\CustomerPackage;
use App\Testimonial;
use App\User;
use App\Seller;
use App\Shop;
use App\Cart;
use App\Order;
use App\Page;
use Illuminate\Support\Facades\Session;
use App\Garden;
use App\Plant;
use App\Result;
use App\UserResult;
use App\BusinessSetting;
use App\ProductAddon;
use App\Coupon;
use Cookie;
use Illuminate\Support\Str;
use App\Mail\SecondEmailVerifyMailManager;
use Mail;
use Illuminate\Auth\Events\PasswordReset;
use Cache;


class HomeController extends Controller
{
    /**
     * Show the application frontend home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $currentDomain = app('currentDomain'); // Access the bound domain
        $domainConfig = app('domainConfig');
        echo $domainConfig['view'];
        exit();
        $featured_categories = array();

        $featured_portfolio = Portfolio::where('feature_status', 1)->limit(4)->get();
        $featured_testimonial = Testimonial::where('featured', 1)->get();

        $todays_deal_products = array();

        return view('frontend.index', compact('featured_portfolio', 'featured_testimonial'));
    }

    public function start_project(Request $request)
    {
        $email = '';
        $step = $request->step;
        if (auth()->user() != null) {
            $email = auth()->user()->email;
        } else {
            if ($request->session()->get('temp_user_id')) {
                $temp_user_id = $request->session()->get('temp_user_id');
            } else {
                $temp_user_id = bin2hex(random_bytes(10));
                $request->session()->put('temp_user_id', $temp_user_id);
            }
            $data['temp_user_id'] = $temp_user_id;
            $cart = Cart::where('temp_user_id', $temp_user_id)->first();
            if (!empty($cart)) {
                $email = $cart->email;
            }
        }
        return view('frontend.project.step_form', compact('email', 'step'));
    }

    public function results_style_quiz($id)
    {


        Session::forget('quiz_step');

        $user_result = UserResult::findOrFail($id);
        if (!empty($user_result)) {
            $gardens_ids =  array($user_result->type1, $user_result->type2, $user_result->type3);
            $garden1_plants =  json_decode($user_result->type1_plants, true);
            $garden2_plants =  json_decode($user_result->type2_plants, true);
            $garden3_plants =  json_decode($user_result->type3_plants, true);

            $first_merge = array_merge($garden1_plants, $garden2_plants);
            $all_plant_ids = array_merge($first_merge, $garden3_plants);
            $results = Result::findOrFail($user_result->results_id);
            $gardens = Garden::whereIn('id', $gardens_ids)->get();
            $plants = Plant::whereIn('id', $all_plant_ids)->get();
            return view('frontend.quiz.results', compact('results', 'gardens', 'plants'));
        } else {
            return redirect()->route('start_style_quiz');
        }
    }

    public function start_style_quiz()
    {
        $gardens = Garden::all();

        return view('frontend.quiz.step_form', compact('gardens'));
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('frontend.login');
    }

    public function registration(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        if ($request->session()->get('temp_user_id')) {
            $temp_user_id = $request->session()->get('temp_user_id');
        } else {
            $temp_user_id = bin2hex(random_bytes(10));
            $request->session()->put('temp_user_id', $temp_user_id);
        }
        $data['temp_user_id'] = $temp_user_id;
        $cart = Cart::where('temp_user_id', $temp_user_id)->first();
        if (empty($cart)) {
            $cart = Cart::create($data);
        }
        return view('frontend.registration', compact('cart'));
    }

    public function confirm_order(Request $request)
    {
        if (auth()->user() != null) {
            $user_id = Auth::user()->id;
            $data['user_id'] = $user_id;
            $carts = Cart::where('user_id', $user_id)->limit(1)->get();
        } else {
            if ($request->session()->get('temp_user_id')) {
                $temp_user_id = $request->session()->get('temp_user_id');
            } else {
                $temp_user_id = bin2hex(random_bytes(10));
                $request->session()->put('temp_user_id', $temp_user_id);
            }
            $data['temp_user_id'] = $temp_user_id;
            $carts = Cart::where('temp_user_id', $temp_user_id)->limit(1)->get();
        }

        if ($carts->isEmpty()) {
            return redirect()->route('home');
        }

        if (!Auth::check()) {
            Session::put('confirm_order', 'default');
            return redirect()->route('user.registration');
        }

        return view('frontend.payment.confirm_order', compact('carts'));
    }

    public function thank_you()
    {
        return view('frontend.payment.thank_you');
    }

    public function package_detail($slug)
    {

        $package  = Product::where('slug', $slug)->where('approved', 1)->first();
        if ($package != null && $package->published) {
            return view('frontend.packages.package_detail', compact('package'));
        } else {
            abort(404);
        }
    }

    public function how_it_works()
    {
        return view('frontend.packages.how_it_works');
    }

    public function rebates()
    {
        return view('frontend.rebates');
    }

    public function take_quiz()
    {
        $page = Page::where('slug', 'style-quiz')->first();
        return view('frontend.quiz.landing', compact('page'));
    }

    public function blogs()
    {
        return view('frontend.blog.listing_new');
    }


    public function packages()
    {
        $packages  = Product::where('product_type', 2)->orderBy('id', 'ASC')->get();
        return view('frontend.packages.packages', compact('packages'));
    }

    public function water_savings()
    {
        return view('frontend.water_savings');
    }

    public function loadMorePortolioData(Request $request)
    {
        $cat =  $request->cat;
        if ($request->id > 0) {
            //info($request->id);
            $data = Portfolio::with('category')
                ->where('id', '<', $request->id);
        } else {
            $data = Portfolio::with('category');
        }

        if ($request->cat != 'all') {

            $data->whereHas('category', function ($q) use ($cat) {
                $q->where('id', '=', $cat);
            });
        }

        $data = $data->limit(4)->orderBy('id', 'DESC')->get();

        $output = '';
        $last_id = '';

        if (!$data->isEmpty()) {
            foreach ($data as $row) {
                $output .= '<div class="col-sm-6 mb-4 mb-md-5">
                                <a href="' . route('portfolio_detail', $row['slug']) . '" class="d-block shadow bg-no-repeat  bg-cover bg-center lazyload" style="background-image: url(' . static_asset('assets/img/placeholder.jpg') . ');" data-bg="' . uploaded_asset($row->feature_image) . '">
                                    <img src="' . static_asset('assets/img/placeholder.jpg') . '" data-src="' .  static_asset('assets/img/portfolio1.jpg') . '" class="img-fluid invisible lazyload">
                                </a>
                                <a href="' . route('portfolio_detail', $row['slug']) . '" class="ff-bold text-dark fs-18 lh-1-2 mt-2 d-block"> ' . $row->title . '</a>
                            </div>';
                $last_id = $row->id;
            }
            $output .= '<div id="load_more">
                                <button type="button" name="load_more_button" class="btn form-control w-300px ms-auto me-auto d-block fs-17 text-white bg-dark lh-1-2 pb-4 fw-800" data-id="' . $last_id . '" id="load_more_button">Load More</button>
                         </div>';
        } else {
            $output .= '<div id="load_more">
                                <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
                        </div>';
        }
        return $output;
    }
    public function portfolio()
    {
        return view('frontend.portfolio.list');
    }

    public function portfolio_detail($slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->first();
        if ($portfolio != null)
            return view('frontend.portfolio.detail', compact('portfolio'));
        else {
            abort(404);
        }
    }

    public function contact_us()
    {
        return view('frontend.contact_us');
    }

    public function reviews()
    {
        return view('frontend.reviews');
    }



    public function cart_login(Request $request)
    {
        $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->orWhere('phone', $request->email)->first();
        if ($user != null) {
            if (Hash::check($request->password, $user->password)) {
                if ($request->has('remember')) {
                    auth()->login($user, true);
                } else {
                    auth()->login($user, false);
                }
            } else {
                flash(translate('Invalid email or password!'))->warning();
            }
        }
        return back();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the customer/seller dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (Auth::user()->user_type == 'customer') {
            return view('frontend.user.customer.dashboard');
        } else {
            abort(404);
        }
    }

    public function profile(Request $request)
    {
        if (Auth::user()->user_type == 'customer') {
            return view('frontend.user.customer.profile');
        }
    }

    public function customer_update_profile(Request $request)
    {
        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->phone      = $request->phone;
        $user->address      = $request->address;
        $user->company      = $request->company;

        if ($request->new_password != null && ($request->new_password == $request->confirm_password)) {
            $user->password = Hash::make($request->new_password);
        }


        if ($user->save()) {
            flash(translate('Your Profile has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }



    public function product(Request $request, $slug)
    {
        $detailedProduct  = Product::with('reviews', 'brand', 'stocks', 'user', 'user.shop')->where('slug', $slug)->where('approved', 1)->first();

        if ($detailedProduct != null && $detailedProduct->published) {
            if (
                $request->has('product_referral_code') &&
                \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated
            ) {

                $affiliate_validation_time = \App\AffiliateConfig::where('type', 'validation_time')->first();
                $cookie_minute = 30 * 24;
                if ($affiliate_validation_time) {
                    $cookie_minute = $affiliate_validation_time->value * 60;
                }
                Cookie::queue('product_referral_code', $request->product_referral_code, $cookie_minute);
                Cookie::queue('referred_product_id', $detailedProduct->id, $cookie_minute);

                $referred_by_user = User::where('referral_code', $request->product_referral_code)->first();

                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliateStats($referred_by_user->id, 1, 0, 0, 0);
            }
            if ($detailedProduct->digital == 1) {
                return view('frontend.digital_product_details', compact('detailedProduct'));
            } else {
                return view('frontend.product_details', compact('detailedProduct'));
            }
        }
        abort(404);
    }

    public function shop($slug)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if ($shop != null) {
            $seller = Seller::where('user_id', $shop->user_id)->first();
            if ($seller->verification_status != 0) {
                return view('frontend.seller_shop', compact('shop'));
            } else {
                return view('frontend.seller_shop_without_verification', compact('shop', 'seller'));
            }
        }
        abort(404);
    }

    public function filter_shop($slug, $type)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if ($shop != null && $type != null) {
            return view('frontend.seller_shop', compact('shop', 'type'));
        }
        abort(404);
    }

    public function all_categories(Request $request)
    {
        //        $categories = Category::where('level', 0)->orderBy('name', 'asc')->get();
        $categories = Category::where('level', 0)->orderBy('order_level', 'desc')->get();
        return view('frontend.all_category', compact('categories'));
    }
    public function all_brands(Request $request)
    {
        $categories = Category::all();
        return view('frontend.all_brand', compact('categories'));
    }

    public function show_product_upload_form(Request $request)
    {
        if (addon_is_activated('seller_subscription')) {
            if (Auth::user()->seller->remaining_uploads > 0) {
                $categories = Category::where('parent_id', 0)
                    ->where('digital', 0)
                    ->with('childrenCategories')
                    ->get();
                return view('frontend.user.seller.product_upload', compact('categories'));
            } else {
                flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
                return back();
            }
        }
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('frontend.user.seller.product_upload', compact('categories'));
    }

    public function show_product_edit_form(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $lang = $request->lang;
        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('frontend.user.seller.product_edit', compact('product', 'categories', 'tags', 'lang'));
    }

    public function seller_product_list(Request $request)
    {
        $search = null;
        $products = Product::where('user_id', Auth::user()->id)->where('digital', 0)->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $search = $request->search;
            $products = $products->where('name', 'like', '%' . $search . '%');
        }
        $products = $products->paginate(10);
        return view('frontend.user.seller.products', compact('products', 'search'));
    }

    public function home_settings(Request $request)
    {
        return view('home_settings.index');
    }

    public function top_10_settings(Request $request)
    {
        foreach (Category::all() as $key => $category) {
            if (is_array($request->top_categories) && in_array($category->id, $request->top_categories)) {
                $category->top = 1;
                $category->save();
            } else {
                $category->top = 0;
                $category->save();
            }
        }

        foreach (Brand::all() as $key => $brand) {
            if (is_array($request->top_brands) && in_array($brand->id, $request->top_brands)) {
                $brand->top = 1;
                $brand->save();
            } else {
                $brand->top = 0;
                $brand->save();
            }
        }

        flash(translate('Top 10 categories and brands have been updated successfully'))->success();
        return redirect()->route('home_settings.index');
    }

    public function package_total(Request $request)
    {
        $product = Product::find($request->id);
        $str = '';
        $quantity = 0;
        $tax = 0;
        $max_limit = 0;
        $unit_price = 0;
        $total = 0;
        $show_contact = false;


        if (json_decode($product->choice_options) != null) {
            foreach (json_decode($product->choice_options) as $key => $choice) {
                if ($str != null) {
                    $str .= '-' . str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                } else {
                    $str .= str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                }
            }
        }

        $product_stock = $product->stocks->where('variant', $str)->first();
        if ($product_stock) {
            $unit_price = $product_stock->price;
            if ($product_stock->sku == 'contact') {
                $show_contact = true;
            }
        } else {
            $unit_price = $product->unit_price;
        }

        $total = $unit_price;
        if ($request->has('addon')) {
            $product_addons = ProductAddon::whereIn('id', $request->addon)->orderBy('name', 'asc')->get();
            if ($product_addons) {
                foreach ($product_addons as $p_addon) {
                    $total = $total + $p_addon['unit_price'];
                }
            }
        }


        if ($show_contact) {
            echo '
                <div class="row mt-1">
                    <div class="col">
                        <div class="fs-16 ff-bold">Total</div>
                    </div>
                    <div class="col text-end">
                        <div class="fs-16 ff-bold">$' . $total . '+</div>
                    </div>
                </div>
                <div class="row mt-4">
                        <div class="col">
                            <a href="' . route('contact-us') . '" class="btn btn-primary ff-bold btn-rounded fs-20 px-5"
                                     >Get an Estimate </a>

                        </div>
                    </div>
                ';
        } else {
            echo '<div class="row">
            <div class="col-auto">
                <div class="fs-16">Subtotal
                </div>
            </div>
            <div class="col text-end">
                <div class="fs-16">' . single_price($unit_price) . '</div>
            </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="fs-16 ff-bold">Total</div>
                </div>
                <div class="col text-end">
                    <div class="fs-16 ff-bold">' . single_price($total) . '</div>
                </div>
            </div>
            <div class="row mt-4">
                    <div class="col">
                        <a type="button" class="btn btn-primary ff-bold btn-rounded fs-20 px-5"
                            onclick="buyNow($(this))">PURCHASE <i class="las la-spinner la-spin la-1x actBtn-loader"
                                style="display: none"></i></a>

                    </div>
                </div>
            ';
        }
        exit();
    }

    public function variant_price(Request $request)
    {
        $product = Product::find($request->id);
        $str = '';
        $quantity = 0;
        $tax = 0;
        $max_limit = 0;

        if ($request->has('color')) {
            $str = $request['color'];
        }

        if (json_decode($product->choice_options) != null) {
            foreach (json_decode($product->choice_options) as $key => $choice) {
                if ($str != null) {
                    $str .= '-' . str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                } else {
                    $str .= str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                }
            }
        }

        $product_stock = $product->stocks->where('variant', $str)->first();
        $price = $product_stock->price;
        $quantity = $product_stock->qty;
        $max_limit = $product_stock->qty;
        //        if($str != null && $product->variant_product){
        //        }
        //        else{
        //            $price = $product->unit_price;
        //            $quantity = $product->current_stock;
        //        }

        if ($quantity >= 1 && $product->min_qty <= $quantity) {
            $in_stock = 1;
        } else {
            $in_stock = 0;
        }

        //Product Stock Visibility
        if ($product->stock_visibility_state == 'text') {
            if ($quantity >= 1 && $product->min_qty < $quantity) {
                $quantity = translate('In Stock');
            } else {
                $quantity = translate('Out Of Stock');
            }
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

        // taxes
        foreach ($product->taxes as $product_tax) {
            if ($product_tax->tax_type == 'percent') {
                $tax += ($price * $product_tax->tax) / 100;
            } elseif ($product_tax->tax_type == 'amount') {
                $tax += $product_tax->tax;
            }
        }

        $price += $tax;

        return array(
            'price' => single_price($price * $request->quantity),
            'quantity' => $quantity,
            'digital' => $product->digital,
            'variation' => $str,
            'max_limit' => $max_limit,
            'in_stock' => $in_stock
        );
    }

    public function sellerpolicy()
    {
        return view("frontend.policies.sellerpolicy");
    }

    public function returnpolicy()
    {
        return view("frontend.policies.returnpolicy");
    }

    public function supportpolicy()
    {
        return view("frontend.policies.supportpolicy");
    }

    public function terms()
    {
        return view("frontend.policies.terms");
    }

    public function privacypolicy()
    {
        return view("frontend.policies.privacypolicy");
    }

    public function get_pick_up_points(Request $request)
    {
        $pick_up_points = PickupPoint::all();
        return view('frontend.partials.pick_up_points', compact('pick_up_points'));
    }

    public function get_category_items(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return view('frontend.partials.category_elements', compact('category'));
    }

    public function premium_package_index()
    {
        $customer_packages = CustomerPackage::all();
        return view('frontend.user.customer_packages_lists', compact('customer_packages'));
    }

    public function seller_digital_product_list(Request $request)
    {
        $products = Product::where('user_id', Auth::user()->id)->where('digital', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.user.seller.digitalproducts.products', compact('products'));
    }
    public function show_digital_product_upload_form(Request $request)
    {
        if (addon_is_activated('seller_subscription')) {
            if (Auth::user()->seller->remaining_digital_uploads > 0) {
                $business_settings = BusinessSetting::where('type', 'digital_product_upload')->first();
                $categories = Category::where('digital', 1)->get();
                return view('frontend.user.seller.digitalproducts.product_upload', compact('categories'));
            } else {
                flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
                return back();
            }
        }

        $business_settings = BusinessSetting::where('type', 'digital_product_upload')->first();
        $categories = Category::where('digital', 1)->get();
        return view('frontend.user.seller.digitalproducts.product_upload', compact('categories'));
    }

    public function show_digital_product_edit_form(Request $request, $id)
    {
        $categories = Category::where('digital', 1)->get();
        $lang = $request->lang;
        $product = Product::find($id);
        return view('frontend.user.seller.digitalproducts.product_edit', compact('categories', 'product', 'lang'));
    }

    // Ajax call
    public function new_verify(Request $request)
    {
        $email = $request->email;
        if (isUnique($email) == '0') {
            $response['status'] = 2;
            $response['message'] = 'Email already exists!';
            return json_encode($response);
        }

        $response = $this->send_email_change_verification_mail($request, $email);
        return json_encode($response);
    }


    // Form request
    public function update_email(Request $request)
    {



        $email = $request->email;
        if (isUnique($email)) {
            $user = Auth::user();
            $user->email = $request->email;


            if ($user->save()) {
                flash(translate('Your email has been updated successfully!'))->success();
                return back();
            }

            //$this->send_email_change_verification_mail($request, $email);
            // flash(translate('A verification mail has been sent to the mail you provided us with.'))->success();
            //return back();
        }

        flash(translate('Email already exists!'))->warning();
        return back();
    }

    public function send_email_change_verification_mail($request, $email)
    {
        $response['status'] = 0;
        $response['message'] = 'Unknown';

        $verification_code = Str::random(32);

        $array['subject'] = 'Email Verification';
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = 'Verify your account';
        $array['link'] = route('email_change.callback') . '?new_email_verificiation_code=' . $verification_code . '&email=' . $email;
        $array['sender'] = Auth::user()->name;
        $array['details'] = "Email Second";

        $user = Auth::user();
        $user->new_email_verificiation_code = $verification_code;
        $user->save();

        try {
            Mail::to($email)->queue(new SecondEmailVerifyMailManager($array));

            $response['status'] = 1;
            $response['message'] = translate("Your verification mail has been Sent to your email.");
        } catch (\Exception $e) {
            // return $e->getMessage();
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function email_change_callback(Request $request)
    {
        if ($request->has('new_email_verificiation_code') && $request->has('email')) {
            $verification_code_of_url_param =  $request->input('new_email_verificiation_code');
            $user = User::where('new_email_verificiation_code', $verification_code_of_url_param)->first();

            if ($user != null) {

                $user->email = $request->input('email');
                $user->new_email_verificiation_code = null;
                $user->save();

                auth()->login($user, true);

                flash(translate('Email Changed successfully'))->success();
                return redirect()->route('dashboard');
            }
        }

        flash(translate('Email was not verified. Please resend your mail!'))->error();
        return redirect()->route('dashboard');
    }

    public function reset_password_with_code(Request $request)
    {
        if (($user = User::where('email', $request->email)->where('verification_code', $request->code)->first()) != null) {
            if ($request->password == $request->password_confirmation) {
                $user->password = Hash::make($request->password);
                $user->email_verified_at = date('Y-m-d h:m:s');
                $user->save();
                event(new PasswordReset($user));
                auth()->login($user, true);

                flash(translate('Password updated successfully'))->success();

                if (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff') {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('home');
            } else {
                flash("Password and confirm password didn't match")->warning();
                return redirect()->route('password.request');
            }
        } else {
            flash("Verification code mismatch")->error();
            return redirect()->route('password.request');
        }
    }


    public function all_flash_deals()
    {
        $today = strtotime(date('Y-m-d H:i:s'));

        $data['all_flash_deals'] = FlashDeal::where('status', 1)
            ->where('start_date', "<=", $today)
            ->where('end_date', ">", $today)
            ->orderBy('created_at', 'desc')
            ->get();

        return view("frontend.flash_deal.all_flash_deal_list", $data);
    }

    public function all_seller(Request $request)
    {
        $shops = Shop::whereIn('user_id', verified_sellers_id())
            ->paginate(15);

        return view('frontend.shop_listing', compact('shops'));
    }

    public function all_coupons(Request $request)
    {
        $coupons = Coupon::where('start_date', '<=', strtotime(date('d-m-Y')))->where('end_date', '>=', strtotime(date('d-m-Y')))->paginate(15);
        return view('frontend.coupons', compact('coupons'));
    }

    public function inhouse_products(Request $request)
    {
        $products = filter_products(Product::where('added_by', 'admin'))->with('taxes')->paginate(12)->appends(request()->query());
        return view('frontend.inhouse_products', compact('products'));
    }
}
