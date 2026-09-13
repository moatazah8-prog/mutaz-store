<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $items = Cart::with('product')
            ->where('session_id', $request->session()->getId())
            ->get();

        if ($items->isEmpty()) {
            return redirect('/cart');
        }

        $total = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'governorate' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:500',
            'notes' => 'nullable|string|max:500',
        ]);

        $items = Cart::with('product')
            ->where('session_id', $request->session()->getId())
            ->get();

        if ($items->isEmpty()) {
            return redirect('/cart');
        }

        $total = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $fullAddress = $request->governorate . ' - ' . $request->city . ' - ' . $request->address;

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'address' => $fullAddress,
            'notes' => $request->notes,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
                'cost_price' => $item->product->cost_price,
            ]);
        }

        Cart::where('session_id', $request->session()->getId())->delete();

        $message = "السلام عليكم، أريد تأكيد الطلب رقم #".$order->id."\n\n";
        $message .= "الاسم: ".$order->customer_name."\n";
        $message .= "الهاتف: ".$order->phone."\n";
        $message .= "المحافظة: ".$request->governorate."\n";
        $message .= "المدينة/المديرية: ".$request->city."\n";
        $message .= "العنوان: ".$request->address."\n";

        if ($order->notes) {
            $message .= "ملاحظات: ".$order->notes."\n";
        }

        $message .= "\nالمنتجات:\n";

        foreach ($items as $item) {
            $itemTotal = $item->product->price * $item->quantity;
            $message .= "- ".$item->product->name."\n";
            $message .= "  الكمية: ".$item->quantity." | سعر الوحدة: ".number_format($item->product->price, 0)." ".$item->product->currency."\n";
            $message .= "  إجمالي المنتج: ".number_format($itemTotal, 0)." ".$item->product->currency."\n";
        }

        $message .= "\n💰 الإجمالي: ".number_format($total, 0)." YER";

        return redirect()->away(
            'https://wa.me/967775197432?text='.urlencode($message)
        );
    }
}
