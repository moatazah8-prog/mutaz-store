<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $quantity = max(1, (int) $request->input('quantity', 1));

        $cart = Cart::where('session_id', $request->session()->getId())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            Cart::create([
                'session_id' => $request->session()->getId(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect('/cart')->with('success', 'تمت إضافة المنتج إلى السلة');
    }

    public function index(Request $request)
    {
        $items = Cart::with('product')
            ->where('session_id', $request->session()->getId())
            ->get();

        return view('cart.index', compact('items'));
    }

    public function remove(Request $request, $id)
    {
        Cart::where('session_id', $request->session()->getId())
            ->where('product_id', $id)
            ->delete();

        return redirect('/cart')->with('success', 'تم حذف المنتج من السلة');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('session_id', $request->session()->getId())
            ->where('product_id', $id)
            ->firstOrFail();

        $product = Product::findOrFail($id);
        $quantity = max(1, (int) $request->input('quantity', 1));
        $quantity = min($quantity, $product->stock);

        $cart->update([
            'quantity' => $quantity,
        ]);

        return redirect('/cart')->with('success', 'تم تحديث الكمية');
    }
}
