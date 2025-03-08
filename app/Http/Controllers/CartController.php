<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'addon_id' => 'nullable|exists:product_addons,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = auth()->id();
        $sessionId = session()->getId();

        // Check if item already exists in the cart
        $cartItem = CartItem::where(function ($query) use ($userId, $sessionId) {
            $query->where('user_id', $userId)->orWhere('session_id', $sessionId);
        })
            ->where('product_id', $validated['product_id'])
            ->where('addon_id', $validated['addon_id'])
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
                'product_id' => $validated['product_id'],
                'addon_id' => $validated['addon_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        return response()->json(['success' => 'Product added to cart successfully!']);
    }

    public function updateCart(Request $request, $cartItemId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->quantity = $validated['quantity'];
        $cartItem->save();

        return response()->json(['success' => 'Cart updated successfully!']);
    }

    public function removeFromCart(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:cart_items,id',
        ]);

        $cartItem = CartItem::findOrFail($validated['id']);
        $cartItem->delete();

        return response()->json(['success' => 'Item removed from cart successfully!']);
    }

    public function viewCart()
    {
        $userId = auth()->id();
        $sessionId = session()->getId();


        $cartItems = CartItem::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->with(['product', 'addon'])->get();

        return response()->json(['cartItems' => $cartItems]);
    }



    public function getMiniCart()
    {
        $userId = auth()->id();
        $sessionId = session()->getId();

        $cartItems = CartItem::where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->with(['product', 'addon'])->get();

        $total = $cartItems->sum(function ($item) {
            $productPrice = $item->product->unit_price ?? 0;
            $addonPrice = $item->addon->unit_price ?? 0;
            return ($productPrice + $addonPrice) * $item->quantity;
        });

        $cartQty = $cartItems->sum('quantity');

        return response()->json([
            'html' => view('frontend.partials.mini-cart', compact('cartItems', 'total', 'cartQty'))->render(),
            'cartQty' => $cartQty,
            'total' => $total,
        ]);
    }
}
