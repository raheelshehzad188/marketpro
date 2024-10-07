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
use App\Models\Cart;
use App\Utility\SendGridUtility;
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
        return view('pos.cart', compact('shippings'));
    }

    public function thanks($id)
    {
        $order = Order::find($id);

        // Check if the order exists and belongs to the current user
        if ($order && $order->user_id == auth()->user()->id) {
            return view('pos.thank', compact('order'));
        }

        // Handle the case where the order is not found or doesn't belong to the user
        abort(404); // Or return a different response
    }



    public function get_tree(Request $request)
    {
        $parent = $request->parent;
        $data = array();

        if ($parent == "#") {
            //->where('id', '!=', 120)
            $categories = Category::with('childrenCategories')->where('parent_id', 0)->where('published', 1)->orderBy('created_at', 'desc')->get();
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
                $categories = Category::with(['childrenCategoriesCreatedOrder', 'products'])->where('published', 1)->where('parent_id',  $parent[1])->orderBy('created_at', 'desc')->get();
            } else {
                $categories = Category::with(['childrenCategoriesCreatedOrder', 'products'])->where('published', 1)->where('parent_id',  $parent[1])->orderBy('created_at', 'desc')->get();
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
        $keyword = $request->keyword;

        // Validate the keyword
        if (!$keyword) {
            return redirect()->back()->withErrors(['keyword' => 'Keyword is required']);
        }

        // Search for all ProductAddons with the provided SKU
        $product_addons = ProductAddon::where('sku', $keyword)
            ->with(['products' => function ($query) {
                $query->withPivot('sort_order')
                    ->orderByRaw('(thumbnail_img IS NULL) DESC');
            }])
            ->get();

        // Initialize variables for the result
        $linked_product_addon = null;
        $unlinked_product_addon = null;
        $detailedProduct = null;

        // Filter out the first addon that is linked to a product
        foreach ($product_addons as $addon) {
            if ($addon->products->isNotEmpty()) {
                $linked_product_addon = $addon; // Consider it linked if it has any associated products
                break;
            }
        }

        // Check for unlinked addons if no linked addon is found
        if (!$linked_product_addon) {
            $unlinked_product_addon = $product_addons->first(function ($addon) {
                return $addon->products->isEmpty(); // Unlinked if no products are associated
            });
        }

        // Search for a Product directly if no addon is found
        if (!$linked_product_addon && !$unlinked_product_addon) {
            $detailedProduct = Product::where('published', '1')
                ->where('sku', $keyword)
                ->first();
        }

        return view('pos.addon_search', compact('linked_product_addon', 'unlinked_product_addon', 'keyword', 'detailedProduct'));
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
        //orderBy('created_at','desc')->
        $products = $products->get();

        echo  view('pos.product_listing', compact('products'))->render();
    }

    // public function get_product(Request $request)
    // {
    //     $detailedProduct  = Product::with('product_addons')->where('id', $request->id)->where('published', 1)->where('approved', 1)->first();
    //     $keyword = $request->keyword;
    //     // echo '<pre>';
    //     //   print_r($detailedProduct);
    //     // echo '</pre>';
    //     // exit();
    //     echo  view('pos.product_detail', compact('detailedProduct', 'keyword'))->render();
    // }
    public function get_product(Request $request)
    {
        $relatedProducts = '';
        $detailedProduct = Product::where('id', $request->id)
            ->where('published', 1)
            ->where('approved', 1)
            ->with(['product_addons' => function ($query) {
                $query->withPivot('sort_order');
            }])
            ->first();

        // Perform custom sorting of product_addons
        if ($detailedProduct) {
            $detailedProduct->product_addons = $detailedProduct->product_addons->sortBy(function ($product_addon) {
                $sortOrder = $product_addon->pivot->sort_order;
                $sku = $product_addon->sku;

                // Create a sorting key
                $sortKey = is_null($sortOrder) ? "n/a_{$sku}" : sprintf('%05d_%s', $sortOrder, $sku);
                return $sortKey;
            }, SORT_NATURAL);

            // $relatedProducts = $detailedProduct->relevantProducts()->get();

            $uniqueProductsFromAddons = collect();

            foreach ($detailedProduct->relatedAddons as $addon) {
                $product = $addon->products->first(); // Get only the first product of this addon
                if ($product) {
                    // Add the SKU to the product object
                    $product->addonSKU = $addon->sku; // Assuming 'SKU' is the attribute name in product_addons
                    $uniqueProductsFromAddons->push($product);
                }
            }

            // Combine with directly related products
            $allRelatedProducts = $detailedProduct->relevantProducts
                ->merge($uniqueProductsFromAddons)
                ->unique('id')
                ->reject(fn ($p) => $p->id === $detailedProduct->id); // Exclude the main product

        }


        $keyword = $request->keyword;

        return view('pos.product_detail', compact('detailedProduct', 'keyword', 'allRelatedProducts'));
    }



    public function get_categories(Request $request)
    {
        //->where('id', '!=', 120)
        if ($request->id == 15) {
            $categories = Category::with('childrenCategoriesCreatedOrder')->where('published', 1)->where('parent_id', $request->id)->orderBy('created_at', 'desc')->get();
        } else {
            $categories = Category::with('childrenCategoriesCreatedOrder')->where('published', 1)->where('parent_id', $request->id)->orderBy('created_at', 'desc')->get();
        }

        echo  view('pos.category_listing', compact('categories'))->render();
    }

    public function addon_combination_edit(Request $request)
    {
        $pId = $request->id;
        $addons = array_filter(explode(',', $request->input('selectedCategories_addons')));
        if (!empty($addons)) {
            $addons = \DB::table('product_addons')->select(DB::raw('product_addons.id,product_addons.name,product_addons.sku,product_addon_pivot.sort_order'))
                ->leftJoin('product_addon_pivot', function ($join) use ($pId) {
                    $join->on('product_addons.id', '=', 'product_addon_pivot.product_addon_id')
                        ->where('product_addon_pivot.product_id', $pId);
                })
                ->whereIn('product_addons.id', $addons)->get();
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
        if ($request->product_id == 0) {
            $productUniqueId =  0 . '' . $request->addon;
        } else {
            $product = Product::find($request->product_id);
            $productUniqueId =  $product->id . '' . $request->addon;
        }


        if ($request->type == 'addon') {
            $productAddon = ProductAddon::find($request->addon);
        }

        $data = array();

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


        if ($request->product_id > 0) {
            if ($product->tax_type == 'percent') {
                $tax = ($price * $product->tax) / 100;
            } elseif ($product->tax_type == 'amount') {
                $tax = $product->tax;
            }
        } else {
            $tax = 0;
        }


        $data['quantity'] = $request->quantity;
        $data['price'] = $price;
        $data['tax'] = $tax;
        $data['shipping'] = 0;

        if (Cart::where('user_id', Auth::user()->id)->first()) {
            $posCart = unserialize(Cart::where('user_id', Auth::user()->id)->first()->cart_data);
            $foundInCart = false;
            $cart = collect();

            foreach ($posCart as $key => $cartItem) {
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

            Cart::where('user_id', Auth::user()->id)->delete();
            Cart::create(['user_id' => Auth::user()->id, 'cart_data' => serialize($cart)]);
            //$request->session()->put('posCart', $cart);
        } else {
            $cart = collect([$data]);
            Cart::where('user_id', Auth::user()->id)->delete();
            Cart::create(['user_id' => Auth::user()->id, 'cart_data' => serialize($cart)]);
            //$request->session()->put('posCart', $cart);
        }

        return;
    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        $cart = unserialize(Cart::where('user_id', Auth::user()->id)->first()->cart_data);
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

        Cart::where('user_id', Auth::user()->id)->delete();
        Cart::create(['user_id' => Auth::user()->id, 'cart_data' => serialize($cart)]);
        // $request->session()->put('posCart', $cart);

        return 1;
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
        if (Cart::where('user_id', Auth::user()->id)->first()) {
            $cart =  unserialize(Cart::where('user_id', Auth::user()->id)->first()->cart_data);
            $cart->forget($request->key);
            Cart::where('user_id', Auth::user()->id)->delete();
            Cart::create(['user_id' => Auth::user()->id, 'cart_data' => serialize($cart)]);
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
        Session::put('shipping_method', $shipping->name);
        Session::put('shipping_id', $shipping->id);
    }

    //order place
    public function order_store(Request $request)
    {
        $posCart = array();
        if (Cart::where('user_id', Auth::user()->id)->first()) {
            $posCart =  unserialize(Cart::where('user_id', Auth::user()->id)->first()->cart_data);
        }

        if (count($posCart) > 0) {
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
            $send_grid_items = array();
            if ($order->save()) {
                $subtotal = 0;
                $tax = 0;
                $shipping = 0;
                foreach ($posCart as $key => $cartItem) {
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

                    if ($order_detail->product_type == 'simple') {
                        $product_name = strip_tags($order_detail->product->name);
                        $article_numer = $order_detail->product->sku;
                    } else {
                        $product_name = \App\ProductAddon::findOrFail($order_detail->product_id)->name;
                        $article_numer = \App\ProductAddon::findOrFail($order_detail->product_id)->sku;
                    }



                    $send_grid_items[] = array(
                        'text' =>  $product_name,
                        'art' => $article_numer,
                        'qty' =>  $cartItem['quantity'],
                        'price' => single_price($cartItem['price'])
                    );
                }

                $order->grand_total = $subtotal + $tax + Session::get('shipping');

                if (Session::has('pos_discount')) {
                    $order->grand_total -= Session::get('pos_discount');
                    $order->coupon_discount = Session::get('pos_discount');
                }

                $order->save();

                //stores the pdf for invoice
                // $pdf = PDF::setOptions([
                //     'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                //     'logOutputFile' => storage_path('logs/log.htm'),
                //     'tempDir' => storage_path('logs/')
                // ])->loadView('invoices.customer_invoice', compact('order'));
                // $output = $pdf->output();
                // file_put_contents('public/invoices/' . 'Order#' . $order->code . '.pdf', $output);

                // $array['view'] = 'emails.invoice';
                // $array['subject'] = 'Order Placed - ' . $order->code;
                // $array['from'] = env('MAIL_USERNAME');
                // $array['content'] = 'Hi. A new order has been placed. Please check the attached invoice.';
                // $array['file'] = 'public/invoices/Order#' . $order->code . '.pdf';
                // $array['file_name'] = 'Order#' . $order->code . '.pdf';

                // $order->commission_calculated = 1;
                // $order->save();

                //sends email to customer with the invoice pdf attached
                // if (env('MAIL_USERNAME') != null) {
                //     try {
                //         Mail::to($request->session()->get('pos_shipping_info')['email'])->queue(new InvoiceEmailManager($array));
                //         Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                //     } catch (\Exception $e) {
                //     }
                // }
                //unlink($array['file']);


                //send admin email
                $send_grid = new SendGridUtility;
                $template_id = "d-72e8f2de0c664b1e963728a03a8417c1";
                $email_data = array(
                    'email' =>  auth()->user()->email,
                    'name' => 'Tm Racing Sweden',
                    'variables' => array(
                        'company' => auth()->user()->company,
                        'customer_name' => auth()->user()->name,
                        'customer_email' => auth()->user()->email,
                        'shipping_method' =>   $order->shipping_method,
                        'order_number' =>  $order->code,
                        'comments' => $order->comments,
                        'order_date' => date('D m d Y', strtotime($order->created_at)),
                        'items' => $send_grid_items,
                        'sub_total' => single_price($subtotal),
                        'shipping' => single_price(Session::get('shipping')),
                        'total' => single_price($order->grand_total),
                        'order_url' => route('all_orders.index')
                    ),
                );
                $send_grid->do_send($template_id, $email_data);

                //copy to admin
                $email_data = array(
                    'email' =>  'magnus@tmracingsweden.se',
                    'name' => 'Tm Racing Sweden',
                    'variables' => array(
                        'company' => auth()->user()->company,
                        'customer_name' => auth()->user()->name,
                        'customer_email' => auth()->user()->email,
                        'order_number' =>  $order->code,
                        'shipping_method' =>   $order->shipping_method,
                        'comments' => $order->comments,
                        'order_date' => date('D m d Y', strtotime($order->created_at)),
                        'items' => $send_grid_items,
                        'sub_total' => single_price($subtotal),
                        'shipping' => single_price(Session::get('shipping')),
                        'total' => single_price($order->grand_total),
                        'order_url' => route('all_orders.index')
                    ),
                );
                $send_grid->do_send($template_id, $email_data, true);

                $request->session()->put('order_id', $order->id);

                Session::forget('pos_shipping_info');
                Session::forget('shipping');
                Session::forget('shipping_id');
                Session::forget('shipping_method');
                Session::forget('pos_discount');
                Cart::where('user_id', Auth::user()->id)->delete();
                return $order->id;
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
