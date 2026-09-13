<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>سلة المشتريات - معتز ستور</title>
<style>
*{box-sizing:border-box}
body{margin:0;font-family:Tahoma,Arial,sans-serif;background:#f6f4f2;color:#222}
header{background:#3b2418;color:#fff;padding:16px 20px;text-align:center;position:sticky;top:0;z-index:10}
header a{color:#fff;text-decoration:none;font-size:21px;font-weight:bold}
.container{max-width:900px;margin:20px auto;padding:12px}
.item,.total,.empty{background:#fff;border-radius:18px;box-shadow:0 4px 20px #00000010}
.item{padding:14px;margin-bottom:12px;display:flex;align-items:center;gap:14px}
.item-info{flex:1}
.item-image{width:90px;height:90px;background:#f7f7f7;border-radius:12px;display:flex;align-items:center;justify-content:center;overflow:hidden;font-size:35px}
.item-image img{width:100%;height:100%;object-fit:contain}
.item h3{margin:0 0 8px;font-size:17px}
.price{color:#9b6918;font-weight:bold;font-size:16px}
.subtotal{font-size:13px;color:#666;margin-top:6px}
button{background:#c62828;color:#fff;border:0;padding:9px 12px;border-radius:8px;cursor:pointer}
.remove-btn{background:#c62828;color:#fff;border:1px solid #ffd6d6;padding:6px 9px;border-radius:7px;font-size:11px;font-weight:bold;white-space:nowrap;margin-top:8px}
.total{padding:20px;font-size:20px;font-weight:bold;display:flex;justify-content:space-between;align-items:center}
.whatsapp{display:block;background:#25D366;color:#fff;text-align:center;text-decoration:none;padding:15px;border-radius:11px;font-size:17px;font-weight:bold;margin-top:15px}
.back{display:block;text-align:center;margin-top:18px;color:#3b2418;text-decoration:none;font-weight:bold}
.empty{text-align:center;padding:45px 20px}
.empty h2{margin-top:0}
@media(max-width:550px){
.item{padding:10px;gap:10px}
.item-image{width:75px;height:75px}
.item h3{font-size:15px}
.total{font-size:18px}
}
</style>
</head>
<body>

<header>
<a href="/">معتز ستور</a>
</header>

<div class="container">

@if(session('success'))
<div style="background:#e8f5e9;color:#2e7d32;padding:12px;border-radius:10px;margin-bottom:12px;text-align:center">
{{ session('success') }}
</div>
@endif

@if($items->count())
@php $total=0; @endphp

@foreach($items as $item)
@php
$subtotal=$item->product->price*$item->quantity;
$total += $subtotal;
@endphp

<div class="item">
<div class="item-image">
@if($item->product->image)
<img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
@else
📱
@endif
</div>

<div class="item-info">
<h3>{{ $item->product->name }}</h3>

<div class="price">
{{ number_format($item->product->price,0) }} {{ $item->product->currency }}
</div>

<form method="POST" action="/cart/update/{{ $item->product->id }}" style="display:flex;align-items:center;gap:6px;margin-top:8px">
@csrf
<button type="submit" name="quantity" value="{{ max(1,$item->quantity-1) }}" style="background:#eee;color:#333;padding:6px 10px">−</button>
<span style="min-width:25px;text-align:center">{{ $item->quantity }}</span>
<button type="submit" name="quantity" value="{{ min($item->product->stock,$item->quantity+1) }}" style="background:#3b2418;color:#fff;padding:6px 10px">+</button>
</form>

<div class="subtotal">
الإجمالي: {{ number_format($subtotal,0) }} {{ $item->product->currency }}
</div>
</div>

<form method="POST" action="/cart/remove/{{ $item->product->id }}">
@csrf
@method('DELETE')
<button type="submit" class="remove-btn">حذف</button>
</form>
</div>

@endforeach

<div class="total">
<span>الإجمالي الكلي</span>
<span>{{ number_format($total,0) }} YER</span>
</div>

@php
$whatsappMessage = "السلام عليكم، أريد تأكيد طلبي من معتز ستور:\n\n";
foreach($items as $item) {
    $whatsappMessage .= "📱 " . $item->product->name . "\n";
    $whatsappMessage .= "الكمية: " . $item->quantity . "\n";
    $whatsappMessage .= "السعر: " . number_format($item->product->price,0) . " " . $item->product->currency . "\n\n";
}
$whatsappMessage .= "💰 الإجمالي: " . number_format($total,0) . " YER";
@endphp

<a href="/checkout" style="display:block;background:#3b2418;color:#fff;text-align:center;text-decoration:none;padding:15px;border-radius:11px;font-size:17px;font-weight:bold;margin-top:15px">
🛒 إتمام الطلب
</a>

<a class="whatsapp" href="https://wa.me/967775197432?text={{ urlencode($whatsappMessage) }}">
تأكيد الطلب عبر واتساب
</a>

<a class="back" href="/products">← متابعة التسوق</a>

@else

<div class="empty">
<h2>السلة فارغة 🛒</h2>
<p>لم تضف أي منتجات إلى السلة بعد.</p>
<a class="back" href="/products">ابدأ التسوق</a>
</div>

@endif

</div>
</body>
</html>
