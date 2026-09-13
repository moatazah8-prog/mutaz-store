<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>معتز ستور</title>

<style>
*{box-sizing:border-box}

body{
    margin:0;
    font-family:Tahoma,Arial,sans-serif;
    background:#f6f6f6;
    color:#222;
}

header{
    background:#fff;
    border-bottom:1px solid #eee;
    padding:14px 16px;
}

.header{
    max-width:1100px;
    margin:auto;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.logo{
    text-decoration:none;
    color:#2f1d14;
    font-size:21px;
    font-weight:bold;
}

.cart{
    text-decoration:none;
    color:#fff;
    background:#2f1d14;
    padding:9px 13px;
    border-radius:9px;
    font-size:14px;
}

.container{
    max-width:1100px;
    margin:auto;
    padding:18px 14px;
}

/* البحث */

.search{
    display:flex;
    background:#fff;
    border:1px solid #e2e2e2;
    border-radius:12px;
    padding:4px;
    height:48px;
    margin-bottom:15px;
}

.search input{
    flex:1;
    min-width:0;
    border:0;
    outline:0;
    padding:0 12px;
    font-size:14px;
    background:transparent;
}

.search button{
    width:65px;
    border:0;
    border-radius:9px;
    background:#2f1d14;
    color:#fff;
    font-size:13px;
}

/* التصنيفات */

.categories{
    display:flex;
    gap:8px;
    overflow-x:auto;
    padding-bottom:8px;
    scrollbar-width:none;
}

.categories::-webkit-scrollbar{
    display:none;
}

.categories a{
    flex-shrink:0;
    text-decoration:none;
    background:#fff;
    color:#555;
    border:1px solid #e5e5e5;
    padding:9px 13px;
    border-radius:9px;
    font-size:13px;
}

.categories .active{
    background:#2f1d14;
    color:#fff;
    border-color:#2f1d14;
}

.title{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin:22px 2px 14px;
}

.title h1{
    font-size:20px;
    margin:0;
}

.count{
    color:#888;
    font-size:12px;
}

/* المنتجات */

.grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
}

.card{
    background:#fff;
    border-radius:13px;
    overflow:hidden;
    border:1px solid #eee;
}

.image{
    height:190px;
    background:#f1f1f1;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:65px;
}

.info{
    padding:13px;
}

.category{
    color:#999;
    font-size:11px;
    margin-bottom:6px;
}

.name{
    font-size:16px;
    margin:0 0 7px;
}

.description{
    color:#777;
    font-size:12px;
    margin:0;
    min-height:32px;
}

.price{
    color:#2f1d14;
    font-weight:bold;
    font-size:17px;
    margin:13px 0;
}

.actions{
    display:flex;
    gap:6px;
}

.details,
.add{
    flex:1;
    border:0;
    border-radius:8px;
    padding:10px 5px;
    text-align:center;
    text-decoration:none;
    font-size:12px;
}

.details{
    background:#f0eeec;
    color:#333;
}

.add{
    background:#2f1d14;
    color:#fff;
}

form{
    flex:1;
    margin:0;
}

form button{
    width:100%;
    border:0;
    border-radius:8px;
    padding:10px 5px;
    background:#2f1d14;
    color:#fff;
    font-size:12px;
}

.empty{
    background:#fff;
    padding:45px 20px;
    text-align:center;
    border-radius:13px;
    color:#777;
}

/* الجوال */

@media(max-width:700px){

    .container{
        padding:14px 10px;
    }

    .grid{
        grid-template-columns:repeat(2,1fr);
        gap:10px;
    }

    .image{
        height:150px;
        font-size:55px;
    }

    .info{
        padding:10px;
    }

    .name{
        font-size:14px;
    }

    .price{
        font-size:15px;
        margin:10px 0;
    }

    .description{
        font-size:11px;
    }

    .details,
    .add,
    form button{
        font-size:11px;
        padding:9px 3px;
    }
}

@media(max-width:380px){

    .grid{
        grid-template-columns:1fr 1fr;
    }

    .image{
        height:135px;
    }

    .logo{
        font-size:18px;
    }
}
.image img{width:100%;height:100%;object-fit:contain;display:block;border-radius:12px}

</style>
</head>

<body>

<header>
<div class="header">

<a href="/" class="logo">
معتز ستور
</a>

<a href="/cart" class="cart">
🛒 السلة
</a>

</div>
</header>

<div class="container">

<form class="search" method="GET" action="/products">

<input
type="text"
name="search"
value="{{ $search ?? '' }}"
placeholder="ابحث عن هاتف أو منتج..."
>

<button type="submit">بحث</button>

</form>

<div class="categories">

<a href="/products"
class="{{ empty($category) ? 'active' : '' }}">
الكل
</a>

<a href="/products?category=الهواتف"
class="{{ ($category ?? '') == 'الهواتف' ? 'active' : '' }}">
📱 الهواتف
</a>

<a href="/products?category=الإكسسوارات"
class="{{ ($category ?? '') == 'الإكسسوارات' ? 'active' : '' }}">
🎧 إكسسوارات
</a>

<a href="/products?category=الراوتر والمودم"
class="{{ ($category ?? '') == 'الراوتر والمودم' ? 'active' : '' }}">
📡 راوتر
</a>

</div>

<div class="title">

<h1>
@if($category)
{{ $category }}
@elseif($search)
نتائج البحث
@else
أحدث المنتجات
@endif
</h1>

<span class="count">
{{ $products->count() }} منتج
</span>

</div>

<div class="grid">

@forelse($products as $product)

<div class="card">

<div class="image">
@if($product->image)
<img loading="lazy" decoding="async" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:contain;display:block;">
@else
📱
@endif
</div>

<div class="info">

<div class="category">
{{ $product->category }}
</div>

<h2 class="name">
{{ $product->name }}
</h2>

<p class="description">
{{ $product->description }}
</p>

<div class="price">
{{ number_format($product->price,0) }}
{{ $product->currency }}
</div>

<div class="actions">

<a class="details"
href="/products/{{ $product->id }}">
التفاصيل
</a>

@if($product->stock > 0)

<form method="POST" action="/cart/add/{{ $product->id }}">
@csrf
<input type="hidden" name="quantity" value="1">

<button type="submit">
🛒 أضف
</button>

</form>

@endif

</div>

</div>
</div>

@empty

<div class="empty">
<h3>لا توجد منتجات</h3>
<p>جرّب البحث بكلمة أخرى.</p>
</div>

@endforelse

</div>

</div>

</body>
</html>
