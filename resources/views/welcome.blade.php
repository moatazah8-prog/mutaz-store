<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="manifest" href="/manifest.json"><meta name="theme-color" content="#2f1d14">
<script>if ("serviceWorker" in navigator) { window.addEventListener("load", () => navigator.serviceWorker.register("/sw.js")); }</script>
<title>معتز ستور للإلكترونيات</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Arial,Tahoma,sans-serif;background:#f5f5f5;color:#222}
header{background:#3b2418;color:#fff;padding:16px 5%;display:flex;align-items:center;gap:20px}
.logo{font-size:25px;font-weight:bold;white-space:nowrap}
.logo span{color:#d6a84f}
.search{flex:1}
.search form{width:100%}.search input{width:100%;padding:13px 20px;border:0;border-radius:30px;font-size:15px;outline:0}
.cart{font-size:25px}
.hero{width:90%;max-width:1200px;margin:25px auto;background:linear-gradient(135deg,#3b2418,#70482f);color:#fff;border-radius:20px;padding:55px 20px;text-align:center}
.hero h1{font-size:38px;margin-bottom:15px}
.hero p{font-size:18px;margin-bottom:25px}
.hero a{display:inline-block;background:#d6a84f;color:#25170f;text-decoration:none;padding:13px 30px;border-radius:30px;font-weight:bold}
.container{width:90%;max-width:1200px;margin:auto}
.title{font-size:25px;margin:35px 0 20px;border-right:5px solid #d6a84f;padding-right:12px}
.categories{display:grid;grid-template-columns:repeat(4,1fr);gap:15px}
.category,.product{background:#fff;border-radius:15px;box-shadow:0 3px 12px #00000012}
.category{color:#222;text-decoration:none;display:block}
.category{text-align:center;padding:25px 10px}
.category .icon{font-size:38px;margin-bottom:10px}
.products{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:45px}
.product{overflow:hidden}
.product-image{height:210px;background:#eee;display:flex;align-items:center;justify-content:center;font-size:70px}
.product-info{padding:15px}
.product-info h3{margin:0 0 7px;font-size:15px;font-weight:700;color:#2f1d14;line-height:1.4;height:42px;display:flex;align-items:center;justify-content:center;text-align:center;overflow:hidden}
.price{font-size:17px;font-weight:800;color:#8a5a16;margin:0 0 9px;text-align:center;line-height:1.4}
.order{display:flex;align-items:center;justify-content:center;text-align:center;text-decoration:none;background:#3b2418;color:#fff;height:34px;padding:0 7px;border-radius:7px;font-size:11px;box-sizing:border-box;white-space:nowrap}
footer{background:#29180f;color:#fff;text-align:center;padding:30px 15px;line-height:2}
@media(max-width:800px){
header{flex-wrap:wrap}
.search{order:3;flex-basis:100%}
.hero h1{font-size:29px}
.categories,.products{grid-template-columns:repeat(2,1fr)}
.product-image{height:170px}
}
@media(max-width:450px){
.logo{font-size:20px}
.hero{padding:40px 15px}
.hero h1{font-size:25px}
.categories{gap:10px}
.products{gap:10px}
}
</style>
</head>
<body>

<header>
<div class="logo">معتز <span>ستور</span></div>
<div class="search">
<form action="/products" method="GET"><input type="search" name="search" placeholder="ابحث عن منتج..." value="{{ request('search') }}"></form>
</div>
<div class="cart">🛒</div>
</header>

<section class="hero">
<h1>معتز ستور للإلكترونيات</h1>
<p>هواتف وإلكترونيات وإكسسوارات بأفضل الأسعار</p>
<a href="#products">تصفح المنتجات</a>
</section>

<main class="container">

<h2 class="title">التصنيفات</h2>

<div class="categories">
<a class="category" href="/products?category=الهواتف"><div class="icon">📱</div><h3>الهواتف</h3></a>
<a class="category" href="/products?category=اللابتوبات"><div class="icon">💻</div><h3>اللابتوبات</h3></a>
<a class="category" href="/products?category=الإكسسوارات"><div class="icon">🎧</div><h3>الإكسسوارات</h3></a>
<a class="category" href="/products?category=الراوتر والمودم"><div class="icon">📡</div><h3>الراوتر والمودم</h3></a>
</div>

<h2 class="title" id="products">منتجات مميزة</h2>

<div class="products">
@forelse($products as $product)
<div class="product">
<div class="product-image">
@if($product->image)
<img loading="lazy" decoding="async" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:contain;">
@else
📱
@endif
</div>
<div class="product-info">
<h3>{{ $product->name }}</h3>
<div class="price">{{ number_format($product->price) }} {{ $product->currency }}</div>
<div class="stock-status {{ $product->stock > 0 ? "available" : "unavailable" }}" style="display:block;width:max-content;margin:0 auto 10px;">{{ $product->stock > 0 ? "متوفر" : "غير متوفر" }}</div>
<div style="display:flex;gap:8px"><a class="order" href="{{ url('/products/' . $product->id) }}" style="flex:1">عرض المنتج</a><form method="POST" action="/cart/add/{{ $product->id }}" style="flex:1">@csrf<button type="submit" class="order" style="width:100%;border:0;cursor:pointer">أضف للسلة</button></form></div>
</div>
</div>
@empty
<p>لا توجد منتجات مميزة حاليًا.</p>
@endforelse
</div>
</div>

</div>
</main>

<footer>
<h3>معتز ستور للإلكترونيات</h3>
<p>📞 775197432</p>
<p>🚚 توصيل داخل صنعاء وجميع المحافظات</p>
<p>© 2026 معتز ستور</p>
</footer>

</body>
</html>
