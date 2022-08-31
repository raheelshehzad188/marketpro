<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CombinedOrder;
use App\Order;
use App\BusinessSetting;
use App\Product;
use App\ProductAddon;
use App\Seller;
use Session;
use App\CustomerPackage;
use App\SellerPackage;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('frontend.payment.stripe');
    }

    public function create_checkout_session(Request $request)
    {
        $amount = 0;
        $list_items = array();
        if ($request->session()->has('payment_type')) {
            if ($request->session()->get('payment_type') == 'cart_payment') {
                $combined_order = CombinedOrder::with('orders')->findOrFail(Session::get('combined_order_id'));
                $amount = round($combined_order->grand_total * 100);

                foreach ($combined_order->orders as $single_order) {
                    $orders = Order::with('orderDetails')->findOrFail($single_order->id);
                    foreach ($orders->orderDetails as $order_detail) {
                        if ($order_detail->product_type == 2) {
                            $list_items[] = array(
                                'price_data' => array(
                                    'currency' => \App\Currency::findOrFail(get_setting('system_default_currency'))->code,
                                    'product_data' => array(
                                        'name' =>  strip_tags(Product::where('product_type', 2)->findOrFail($order_detail->product_id)->name)
                                    ),
                                    'unit_amount' => round(Product::where('product_type', 2)->findOrFail($order_detail->product_id)->unit_price * 100)
                                ),
                                'quantity' => 1
                            );
                        } elseif ($order_detail->product_type == 3) {
                            $addon = ProductAddon::findOrFail($order_detail->product_id);
                            $list_items[] = array(
                                'price_data' => array(
                                    'currency' => \App\Currency::findOrFail(get_setting('system_default_currency'))->code,
                                    'product_data' => array(
                                        'name' =>  $addon->name
                                    ),
                                    'unit_amount' => round($addon->unit_price * 100)
                                ),
                                'quantity' => 1
                            );
                        }
                    }
                }
            }
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $list_items,
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return response()->json(['id' => $session->id, 'status' => 200]);
    }

    public function success()
    {
        try {
            $payment = ["status" => "Success"];

            $payment_type = Session::get('payment_type');

            if ($payment_type == 'cart_payment') {
                $checkoutController = new CheckoutController;
                return $checkoutController->checkout_done(session()->get('combined_order_id'), json_encode($payment));
            }
        } catch (\Exception $e) {
            flash(translate('Payment failed'))->error();
            return redirect()->route('home');
        }
    }

    public function cancel(Request $request)
    {
        flash(translate('Payment is cancelled'))->error();
        return redirect()->route('home');
    }
}
