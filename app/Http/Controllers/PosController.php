<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OTPVerificationController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\AffiliateController;
use App\OtpConfiguration;
use App\Category;
use App\BusinessSetting;
use App\OrderDetail;
use App\ProductStock;
use App\Product;
use App\ProductAddon;
use App\Order;
use App\Color;
use App\User;
use App\Address;
use Session;
use Auth;
use DB;
use App\Shipping;
use PDF;
use Mail;
use App\Mail\InvoiceEmailManager;
use App\Http\Resources\PosProductCollection;

class PosController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'customer') {
            return view('pos.index');
        }
    }


    public function cart()
    {
        $shippings = Shipping::all();
        return view('pos.cart',compact('shippings'));
    }


    public function get_tree(Request $request)
    {
        $parent = $request->parent;
        $data = array();

        if ($parent == "#") {
            $categories = Category::with('childrenCategories')->where('parent_id', 0)->where('id', '!=', 120)->orderBy('id', 'desc')->get();
            foreach ($categories as $cat) {
                $data[] = array(
                    "id" => "cat_" . $cat->id,
                    "text" => $cat->name,
                    "icon" => "fa fa-folder icon-lg",
                    "children" => (count($cat->childrenCategories)) ? true : false,
                    "a_attr" => array('type' => (count($cat->childrenCategories)) ? 'category' : 'product', 'id' => $cat->id),
                    "type" => "root"
                );
            }
        } else {
            $parent  = explode('_', $parent);

            if ($parent[1] == 15) {
                $categories = Category::with(['childrenCategories', 'products'])->where('parent_id',  $parent[1])->orderBy('name', 'desc')->get();
            } else {
                $categories = Category::with(['childrenCategories', 'products'])->where('parent_id',  $parent[1])->orderBy('id', 'desc')->get();
            }


            if (!$categories->isEmpty()) {

                foreach ($categories as $cat) {
                    if (count($cat->childrenCategories) > 0) {
                        $data[] = array(
                            "id" => "cat_" . $cat->id,
                            "text" => $cat->name,
                            "icon" => "fa fa-folder icon-lg",
                            "children" => (count($cat->childrenCategories)) ? true : false,
                            "a_attr" => array('type' => (count($cat->childrenCategories)) ? 'category' : 'product', 'id' => $cat->id),
                            "type" => "root"
                        );
                    } else {
                        $data[] = array(
                            "id" => "cat_" . $cat->id,
                            "text" => $cat->name,
                            "icon" => "fa fa-folder icon-lg",
                            "children" => (count($cat->products)) ? true : false,
                            "a_attr" => array('type' => (count($cat->products)) ? 'product' : 'category', 'id' => $cat->id),
                            "type" => "root"
                        );
                    }
                }
            } else {
                $cat_id = $parent[1];
                $products = Product::where('published', '1');
                $products->whereHas('categories', function ($q) use ($cat_id) {
                    $q->where('category_id', $cat_id); // '=' is optional
                });
                $products = $products->get();


                foreach ($products as $product) {
                    $data[] = array(
                        "id" => "pro_" . $product->id,
                        "text" => $product->name,
                        "icon" => "fa fa-folder icon-lg",
                        "children" =>  false,
                        "a_attr" => array('type' => 'single_product', 'id' => $product->id),
                        "type" => "root"
                    );
                }
            }


            // for ($i = 1; $i < rand(2, 4); $i++) {
            //     $data[] = array(
            //         "id" => "node_" . time() . rand(1, 100000),
            //         "icon" => (rand(0, 3) == 2 ? "fa fa-file icon-lg" : "fa fa-folder icon-lg"),
            //         "text" => "Node " . time(),
            //         "children" => (rand(0, 3) == 2 ? false : true),
            //         'second' => 2
            //     );
            // }
        }
        return response()->json($data);
    }

    public function search(Request $request)
    {

        // if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
        //     $products = Product::where('added_by', 'admin')->where('published', '1');
        // } else {
        //     $products = Product::where('user_id', Auth::user()->id)->where('published', '1');
        // }

        // if($request->category != null){
        //     $arr = explode('-', $request->category);
        //     if($arr[0] == 'category'){
        //         $products = $products->where('category_id', $arr[1]);
        //     }
        //     elseif($arr[0] == 'subcategory'){
        //         $products = $products->where('subcategory_id', $arr[1]);
        //     }
        //     elseif($arr[0] == 'subsubcategory'){
        //         $products = $products->where('subsubcategory_id', $arr[1]);
        //     }
        // }

        // if($request->brand != null){
        //     $products = $products->where('brand_id', $request->brand);
        // }


        $keywords = $request->keyword;

       
        $products = Product::where('published', '1')->where('sku', 'LIKE', '%'.$keywords.'%');
        $products->orWhereHas('product_addons', function ($q) use ($keywords) {
            $q->where('sku', 'LIKE', '%'.$keywords.'%'); // '=' is optional
        })->limit(100);
        $products = $products->get();

    
        echo  view('pos.product_listing', compact('products'))->render();
    }


    public function get_products(Request $request)
    {
        $category_id = $request->id;
        $search = null;
        $products = Product::where('published', '1');
        if ($request->has('id') && $request->id != null) {
            $products->whereHas('categories', function ($q) use ($category_id) {
                $q->where('category_id', $category_id); // '=' is optional
            });
        }
        $products = $products->get();

       
        echo  view('pos.product_listing', compact('products'))->render();
    }

    public function get_product(Request $request)
    {
        $detailedProduct  = Product::with('product_addons')->where('id', $request->id)->where('approved', 1)->first();

        // echo '<pre>';
        //   print_r($detailedProduct);
        // echo '</pre>';
        // exit();
        echo  view('pos.product_detail', compact('detailedProduct'))->render();
    }

    public function get_categories(Request $request)
    {
        $categories = Category::with('childrenCategories')->where('parent_id', $request->id)->where('id', '!=', 120)->orderBy('id', 'desc')->get();

        echo  view('pos.category_listing', compact('categories'))->render();
    }

    public function addon_combination_edit(Request $request)
    {
        $pId = $request->id;

        if ($request->has('addons')) {
            $addons = \DB::table('product_addons')->select(DB::raw('product_addons.id,product_addons.name,product_addon_pivot.sort_order'))
                ->leftJoin('product_addon_pivot', function ($join) use ($pId) {
                    $join->on('product_addons.id', '=', 'product_addon_pivot.product_addon_id')
                        ->where('product_addon_pivot.product_id', $pId);
                })
                ->whereIn('product_addons.id', $request->addons)->get();
            return view('backend.product.products.addon_combinations_edit', compact('addons'));
        }
    }

    public function getVarinats(Request $request)
    {
        $stocks = Product::find($request->id)->stocks;
        if (count($stocks) > 0) {
            return view('pos.variants', compact('stocks'));
        } else {
            return 0;
        }
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);

        if ($request->type == 'addon') {
            $productAddon = ProductAddon::find($request->addon);
        }

        $data = array();
        $productUniqueId =  $product->id . '' . $request->addon;
        $data['id'] = $productUniqueId;
        $tax = 0;
        $data['addon'] = $request->addon;
        if ($request->type == 'simple') {
            $data['item_id'] = $product->id;
        } else {
            $data['item_id'] = $productAddon->id;
        }


        $data['type'] = $request->type;

        if ($request->type == 'addon') {
            $quantity = $productAddon->qty;
            if ($request['quantity'] > $quantity) {
                //return response()->json(['errors' => ['c' => ['Quantity exceed!']]], 422);
            }
            if (Session::get('fake_price') == 'yes') {
                $price = $productAddon->fake_price;
            } else {
                $price = $productAddon->unit_price;
            }
        } else {
            $quantity = $product->qty;
            if ($request['quantity'] > $quantity) {
                //return response()->json(['errors' => ['c' => ['Quantity exceed!']]], 422);
            }
            if (Session::get('fake_price') == 'yes') {
                $price = $product->fake_price;
            } else {
                $price = $product->unit_price;
            }
        }

        //discount calculation based on flash deal and regular discount
        //calculation of taxes


        if ($product->tax_type == 'percent') {
            $tax = ($price * $product->tax) / 100;
        } elseif ($product->tax_type == 'amount') {
            $tax = $product->tax;
        }

        $data['quantity'] = $request->quantity;
        $data['price'] = $price;
        $data['tax'] = $tax;
        $data['shipping'] = 0;

        if ($request->session()->has('posCart')) {
            $foundInCart = false;
            $cart = collect();

            foreach ($request->session()->get('posCart') as $key => $cartItem) {
                if ($cartItem['id'] == $productUniqueId) {
                    $total_qty =  $cartItem['quantity'] + $request->quantity;
                    $cartItem['quantity'] += $request->quantity;
                    // if ($total_qty < $quantity) {
                    //     $cartItem['quantity'] += $request->quantity;
                    // } else {
                    //     return response()->json(['errors' => ['c' => ['Quantity exceed! Already in the cart']]], 422);
                    //     $cartItem['quantity']  =   $cartItem['quantity'];
                    // }
                    $foundInCart  = true;
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {
                $cart->push($data);
            }
            $request->session()->put('posCart', $cart);
        } else {
            $cart = collect([$data]);
            $request->session()->put('posCart', $cart);
        }

        return;
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $cart = $request->session()->get('posCart', collect([]));
        $cart = $cart->map(function ($object, $key) use ($request) {
            if ($key == $request->key) {

                if ($object['type'] == 'simple') {
                    $product = Product::find($object['item_id']);
                } else {
                    $product = ProductAddon::find($object['item_id']);
                }
                $total_qty = $object['quantity'] + $request->quantity;

                $object['quantity'] = $request->quantity;
                if ($product->qty >  $total_qty) {
                 
                } else {
                    //$object['quantity'] =  $object['quantity'];
                }
            }
            return $object;
        });
        $request->session()->put('posCart', $cart);

        return view('pos.cart');
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
        if (Session::has('posCart')) {
            $cart = Session::get('posCart', collect([]));
            $cart->forget($request->key);
            Session::put('posCart', $cart);
        }

        return 1;
    }

    //Shipping Address for admin
    public function getShippingAddress(Request $request)
    {
        $user_id = $request->id;
        if ($user_id == '') {
            return view('pos.guest_shipping_address');
        } else {
            return view('pos.shipping_address', compact('user_id'));
        }
    }

    //Shipping Address for seller
    public function getShippingAddressForSeller(Request $request)
    {
        $user_id = $request->id;
        if ($user_id == '') {
            return view('pos.frontend.seller.pos.guest_shipping_address');
        } else {
            return view('pos.frontend.seller.pos.shipping_address', compact('user_id'));
        }
    }

    //set Discount
    public function setDiscount(Request $request)
    {
        if ($request->discount >= 0) {
            Session::put('pos_discount', $request->discount);
        }
        return view('pos.cart');
    }

    //set Shipping Cost
    public function setShipping(Request $request)
    {
        $shipping = Shipping::findOrFail($request->shipping);


        Session::put('shipping', $shipping->cost);
        Session::put('shipping_method',$shipping->name);
        Session::put('shipping_id', $shipping->id);
       
    }

    //order place
    public function order_store(Request $request)
    {
        if (Session::has('posCart') && count(Session::get('posCart')) > 0) {
            $order = new Order;
            $name = '';
            $email = '';
            $address = '';
            $country = '';
            $city = '';
            $postal_code = '';
            $phone = '';


            $order->user_id = Auth::user()->id;
            $user           = User::findOrFail(Auth::user()->id);
            $name   = $user->name;
            $email  = $user->email;
            $phone  = $user->phone;




            $data['name']           = $name;
            $data['email']          = $email;
            $data['address']        = $address;
            $data['country']        = $country;
            $data['city']           = $city;
            $data['postal_code']    = $postal_code;
            $data['phone']          = $phone;
           

            $order->shipping_address = json_encode($data);

            $order->payment_type = 'Cash';
            $order->delivery_viewed = '0';
            $order->payment_status_viewed = '0';
            $order->code = date('Ymd-His') . rand(10, 99);
            $order->date = strtotime('now');
            $order->payment_status = 'paid';
            $order->payment_details = 'Cash';
            $order->shipping_method = Session::get('shipping_method');
            $order->shipping_cost = Session::get('shipping');
            $order->comments = $request->comments;

            if ($order->save()) {
                $subtotal = 0;
                $tax = 0;
                $shipping = 0;
                foreach (Session::get('posCart') as $key => $cartItem) {
                    if ($cartItem['type'] == 'simple') {
                        $product = Product::find($cartItem['item_id']);
                    } else {
                        $product = ProductAddon::find($cartItem['item_id']);
                    }


                    $subtotal += $cartItem['price'] * $cartItem['quantity'];
                    $tax += $cartItem['tax'] * $cartItem['quantity'];

                    $product_variation = '';

                    $product->qty -= $cartItem['quantity'];
                    $product->save();

                    $order_detail = new OrderDetail;
                    $order_detail->order_id  = $order->id;
                    $order_detail->seller_id = $product->user_id;
                    $order_detail->product_id = $product->id;
                    $order_detail->payment_status = 'paid';
                    $order_detail->product_type = $cartItem['type'];
                    $order_detail->variation = $product_variation;
                    $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                    $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                    $order_detail->shipping_type = null;

                    $order_detail->shipping_cost = 0;


                    // if (Session::get('shipping', 0) == 0) {
                    //     $order_detail->shipping_cost = 0;
                    // } else {
                    //     if ($cartItem['shipping'] == null) {
                    //         $order_detail->shipping_cost = 0;
                    //     } else {
                    //         $order_detail->shipping_cost = $cartItem['shipping'];
                    //         $shipping += $cartItem['shipping'];
                    //     }
                    // }

                    $order_detail->quantity = $cartItem['quantity'];
                    $order_detail->save();

                    $product->num_of_sale++;
                    $product->save();
                }

                $order->grand_total = $subtotal + $tax + Session::get('shipping');

                if (Session::has('pos_discount')) {
                    $order->grand_total -= Session::get('pos_discount');
                    $order->coupon_discount = Session::get('pos_discount');
                }

                $order->save();

                //stores the pdf for invoice
                $pdf = PDF::setOptions([
                    'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                    'logOutputFile' => storage_path('logs/log.htm'),
                    'tempDir' => storage_path('logs/')
                ])->loadView('invoices.customer_invoice', compact('order'));
                $output = $pdf->output();
                file_put_contents('public/invoices/' . 'Order#' . $order->code . '.pdf', $output);

                $array['view'] = 'emails.invoice';
                $array['subject'] = 'Order Placed - ' . $order->code;
                $array['from'] = env('MAIL_USERNAME');
                $array['content'] = 'Hi. A new order has been placed. Please check the attached invoice.';
                $array['file'] = 'public/invoices/Order#' . $order->code . '.pdf';
                $array['file_name'] = 'Order#' . $order->code . '.pdf';

                $order->commission_calculated = 1;
                $order->save();

                //sends email to customer with the invoice pdf attached
                // if (env('MAIL_USERNAME') != null) {
                //     try {
                //         Mail::to($request->session()->get('pos_shipping_info')['email'])->queue(new InvoiceEmailManager($array));
                //         Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                //     } catch (\Exception $e) {
                //     }
                // }
                //unlink($array['file']);

                $request->session()->put('order_id', $order->id);

                Session::forget('pos_shipping_info');
                Session::forget('shipping');
                Session::forget('shipping_id');
                Session::forget('shipping_method');
                Session::forget('pos_discount');
                Session::forget('posCart');
                return 1;
            } else {
                return 0;
            }
        }
        return 0;
    }

    public function pos_activation()
    {
        $pos_activation = BusinessSetting::where('type', 'pos_activation_for_seller')->first();
        return view('pos.pos_activation', compact('pos_activation'));
    }
}
