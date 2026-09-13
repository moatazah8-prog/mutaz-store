<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $product->name }} - معتز ستور</title>
<style>
*{box-sizing:border-box}
body{margin:0;font-family:Tahoma,Arial,sans-serif;background:#f6f4f2;color:#222}
header{background:#3b2418;color:#fff;padding:16px 20px;display:flex;align-items:center;justify-content:space-between;gap:10px;position:sticky;top:0;z-index:10}
header a{color:#fff;text-decoration:none;font-size:21px;font-weight:bold}
header a::before{content:"‹";font-size:28px;margin-left:8px;vertical-align:-2px}
.container{max-width:900px;margin:25px auto;padding:12px}
.product{background:#fff;padding:18px;border-radius:20px;box-shadow:0 5px 25px #00000012;overflow:hidden}
.image{height:360px;background:#fafafa;border-radius:16px;display:flex;align-items:center;justify-content:center;overflow:hidden;font-size:90px;margin-bottom:18px}
.image img{width:100%;height:100%;object-fit:contain;display:block}
.category{display:inline-block;background:#f2e9e3;color:#6b422d;padding:6px 12px;border-radius:20px;font-size:13px;margin-bottom:10px}
h1{font-size:27px;margin:5px 0 12px;color:#2d1b13}
.description{font-size:15px;line-height:1.9;color:#666;margin:0 0 15px}
.price{font-size:27px;font-weight:bold;color:#9b6918;margin:18px 0}
.stock{display:inline-block;color:#188038;background:#eaf6ed;padding:7px 12px;border-radius:20px;font-size:13px;margin-bottom:18px}
form{display:flex;gap:10px;align-items:center}
.quantity{width:80px;height:50px;padding:10px;border:1px solid #ddd;border-radius:10px;text-align:center;font-size:17px}
.cart-btn{flex:1;background:#3b2418;color:#fff;border:0;padding:15px;border-radius:10px;font-size:16px;font-weight:bold;cursor:pointer}
.back{display:block;text-align:center;margin-top:20px;color:#3b2418;text-decoration:none;font-weight:bold}
@media(max-width:600px){
.container{margin:10px auto;padding:10px}
.product{padding:12px;border-radius:16px}
.image{height:300px}
h1{font-size:23px}
.price{font-size:24px}
}
</style>
</head>

<body>

<header>
<a href="/">معتز ستور للإلكترونيات</a>
</header>

<div class="container">
<div class="product">

<div class="image">@if($product->image)<img decoding="async" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:contain;border-radius:12px">@else📱@endif</div>

<p>{{ $product->category }}</p>

<h1>{{ $product->name }}</h1>

<p class="description">{{ $product->description }}</p>

<div class="price">
{{ number_format($product->price, 0) }} {{ $product->currency }}
</div>

<div class="stock">
المتوفر: {{ $product->stock }} قطعة
</div>

<form method="POST" action="/cart/add/{{ $product->id }}">
@csrf

<input
class="quantity"
type="number"
name="quantity"
value="1"
min="1"
max="{{ $product->stock }}"
>

<button class="cart-btn" type="submit">
🛒 أضف إلى السلة
</button>

</form>
@if($product->stock > 0)
<a href="https://wa.me/967775197432?text={{ urlencode('السلام عليكم، أريد الاستفسار عن المنتج: ' . $product->name . ' - السعر: ' . number_format($product->price,0) . ' ' . $product->currency) }}" target="_blank" style="display:block;text-align:center;background:#25D366;color:white;text-decoration:none;padding:14px;border-radius:10px;font-weight:bold;margin-top:10px">💬 استفسار عبر واتساب</a>
@endif

<a class="back" href="/products">← العودة للمنتجات</a>

</div>
</div>

</body>
</html>
