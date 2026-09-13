<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>المنتجات - معتز ستور</title>
<style>
*{box-sizing:border-box}
body{margin:0;background:#f5f5f5;color:#222;font-family:Tahoma,Arial}
header{background:#3b2418;color:white;padding:16px}
.header{max-width:1100px;margin:auto;display:flex;justify-content:space-between;align-items:center}
.logo{font-size:19px;font-weight:bold}
.back,.add{color:white;text-decoration:none;padding:9px 12px;border-radius:8px;font-size:12px}
.back{background:#ffffff22}
.add{background:#6b422d}
.container{max-width:1100px;margin:20px auto;padding:0 12px}
.title{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
h1{font-size:22px;margin:0}
.card{background:white;border-radius:14px;overflow:hidden;box-shadow:0 2px 10px #0000000d}
.product{padding:15px;border-bottom:1px solid #eee}
.product:last-child{border-bottom:0}
.product-row{display:flex;gap:14px;align-items:center}
.product-image{width:80px;height:80px;background:#f7f7f7;border-radius:12px;overflow:hidden;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:32px}
.product-image img{width:100%;height:100%;object-fit:contain;display:block}
.product-content{flex:1;min-width:0}
.top{display:flex;justify-content:space-between;gap:10px}
.name{font-weight:bold;color:#3b2418;font-size:16px}
.category{font-size:12px;color:#777;margin-top:5px}
.info{font-size:13px;line-height:1.9;color:#555;margin-top:8px}
.price{font-weight:bold;color:#3b2418}
.btn{display:inline-block;text-decoration:none;border:0;padding:8px 12px;border-radius:7px;font-size:12px;cursor:pointer}
.edit{background:#eee;color:#333}
.delete{background:#ffe8e8;color:#a00}
.featured{background:#fff3cd;color:#856404;padding:4px 8px;border-radius:12px;font-size:11px;white-space:nowrap}
.success{background:#e8f7e8;color:#287a28;padding:11px;border-radius:9px;margin-bottom:15px;font-size:13px}
.empty{text-align:center;padding:40px;color:#777}
form{margin:0}
@media(max-width:600px){
.product-row{align-items:flex-start}
.product-image{width:70px;height:70px}
.name{font-size:14px}
}
.actions{display:flex;align-items:center;gap:3px;margin-top:10px;flex-wrap:nowrap;width:100%;overflow:visible}.stock-form{display:flex;align-items:center;gap:3px;margin:0;flex:0 0 auto}.stock-input{width:45px!important;height:32px!important;padding:4px!important;border:1px solid #ddd;border-radius:6px;font-size:10px}.stock-btn{height:32px!important;padding:4px 6px!important;background:#3b2418;color:#fff;white-space:nowrap}.actions .edit{background:#8b5e3c;color:#fff}.actions .delete{background:#c62828;color:#fff}.actions .edit,.actions .delete{height:32px!important;min-width:45px!important;padding:4px 6px!important;margin:0!important;display:inline-flex;align-items:center;justify-content:center;font-size:10px!important;white-space:nowrap}.actions form{margin:0!important;display:flex;flex:0 0 auto}
.stock{font-weight:bold;padding:3px 7px;border-radius:6px}.stock.available{background:#e8f5e9;color:#2e7d32}.stock.low{background:#fff3cd;color:#856404}.stock.out{background:#ffebee;color:#c62828}
</style>
</head>
<body>

<header>
<div class="header">
<div class="logo">معتز ستور | المنتجات</div>
<a class="back" href="/admin">لوحة التحكم</a>
</div>
</header>

<div class="container">

@if(session('success'))
<div class="success">{{ session('success') }}</div>
@endif

<form method="GET" action="/admin/products" style="display:flex;gap:8px;margin-bottom:15px"><input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث عن منتج أو قسم..." style="flex:1;padding:10px;border:1px solid #ddd;border-radius:8px;font-size:13px"><button type="submit" style="background:#3b2418;color:white;border:0;padding:10px 16px;border-radius:8px;cursor:pointer">بحث</button></form>
<div class="title">
<h1>إدارة المنتجات</h1>
<a class="add" href="/admin/products/create">+ إضافة منتج</a>
</div>

<div class="card">
@if($products->isEmpty())

<div class="empty">لا توجد منتجات حتى الآن</div>

@else

@foreach($products as $product)

<div class="product">
<div class="product-row">

<div class="product-image">
@if($product->image)
<img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
@else
📱
@endif
</div>

<div class="product-content">

<div class="top">
<div>
<div class="name">{{ $product->name }}</div>
<div class="category">{{ $product->category ?: 'بدون تصنيف' }}</div>
</div>

@if($product->featured)
<span class="featured">مميز</span>
@endif
</div>

<div class="info">
السعر:
<span class="price">{{ number_format($product->price, 0) }} {{ $product->currency }}</span>
<br>
المخزون: @if($product->stock <= 0)<span class="stock out">نفد المخزون</span>@elseif($product->stock <= 3)<span class="stock low">{{ $product->stock }} قطع - مخزون منخفض</span>@else<span class="stock available">{{ $product->stock }} قطعة - متوفر</span>@endif
</div>

<div class="actions">
<a class="btn edit" href="/admin/products/{{ $product->id }}/edit">تعديل</a>

<form method="POST" action="/admin/products/{{ $product->id }}/add-stock" class="stock-form">@csrf<input class="stock-input" type="number" name="quantity" min="1" placeholder="الكمية" required><button class="btn stock-btn" type="submit">+ مخزون</button></form>
<form method="POST" action="/admin/products/{{ $product->id }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
@csrf
@method('DELETE')
<button class="btn delete" type="submit">حذف</button>
</form>
</div>

</div>

</div>
</div>

@endforeach

@endif
</div>

</div>
</body>
</html>
