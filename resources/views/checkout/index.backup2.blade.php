<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>إتمام الطلب | معتز ستور</title>

<style>
*{box-sizing:border-box}

body{
margin:0;
font-family:Tahoma,Arial,sans-serif;
background:#f7f7f7;
color:#252525;
}

header{
background:#fff;
border-bottom:1px solid #e9e9e9;
padding:15px;
}

.header{
max-width:1100px;
margin:auto;
display:flex;
align-items:center;
justify-content:space-between;
}

.logo{
color:#2f1d14;
text-decoration:none;
font-size:21px;
font-weight:bold;
}

.cart{
color:#fff;
background:#2f1d14;
padding:10px 15px;
border-radius:9px;
text-decoration:none;
font-size:13px;
}

.container{
max-width:1050px;
margin:auto;
padding:28px 16px;
}

.heading h1{
margin:0 0 7px;
font-size:25px;
color:#2f1d14;
}

.heading p{
margin:0 0 22px;
color:#888;
font-size:13px;
}

.layout{
display:grid;
grid-template-columns:1fr 360px;
gap:20px;
align-items:start;
}

.card{
background:#fff;
border:1px solid #e8e8e8;
border-radius:15px;
padding:22px;
}

.card-title{
display:flex;
align-items:center;
gap:10px;
margin-bottom:20px;
padding-bottom:15px;
border-bottom:1px solid #eee;
}

.icon{
width:38px;
height:38px;
border-radius:10px;
background:#f1ece9;
display:flex;
align-items:center;
justify-content:center;
font-size:18px;
}

.card-title h2{
margin:0;
font-size:17px;
}

.field{
margin-bottom:17px;
}

label{
display:block;
margin-bottom:7px;
font-size:13px;
font-weight:bold;
}

input,
textarea{
width:100%;
border:1px solid #ddd;
border.summary{
background:#fff;
}

.items{
margin-bottom:18px;
}

.item{
display:flex;
justify-content:space-between;
gap:12px;
padding:13px 0;
border-bottom:1px solid #eee;
}

.item-name{
font-size:13px;
font-weight:bold;
}

.item-qty{
color:#888;
font-size:11px;
margin-top:5px;
}

.item-price{
color:#2f1d14;
font-weight:bold;
font-size:13px;
white-space:nowrap;
}

.total{
background:#f7f4f2;
border-radius:11px;
padding:15px;
display:flex;
justify-content:space-between;
align-items:center;
}

.total span{
font-size:13px;
color:#666;
}

.total strong{
color:#2f1d14;
font-size:19px;
}

.submit{
width:100%;
border:0;
border-radius:10px;
padding:14px;
margin-top:16px;
background:#168c45;
color:#fff;
font-family:inherit;
font-size:14px;
font-weight:bold;
}

.secure{
text-align:center;
color:#999;
font-size:11px;
margin-top:11px;
}

.back{
display:block;
text-align:center;
color:#2f1d14;
text-decoration:none;
font-size:12px;
margin-top:14px;
}

@media(max-width:750px){

.layout{
grid-template-columns:1fr;
gap:12px;
}

.container{
padding:20px 10px 35px;
}

.card{
padding:17px;
}

.heading h1{
font-size:21px;
}

.logo{
font-size:18px;
}

.cart{
padding:8px 11px;
}

}
</style>
</head><body>

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

<div class="heading">
<h1>إتمام الطلب</h1>
<p>أدخل بياناتك وسنتواصل معك لتأكيد طلبك</p>
</div>

<div class="layout">

<div class="card">

<div class="card-title">
<div class="icon">👤</div>
<h2>بيانات العميل</h2>
</div>

<form method="POST" action="/checkout">
@csrf

<div class="field">
<label>الاسم الكامل</label>
<input type="text" name="customer_name"
placeholder="مثال: محمد أحمد"
value="{{ old('customer_name') }}" required>
</div>

<div class="field">
<label>رقم الهاتف</label>
<input type="tel" name="phone"
placeholder="مثال: 777123456"
value="{{ old('phone') }}" required>
</div>

<div class="field">
<label>عنوان التوصيل</label>
<textarea name="address"
placeholder="المحافظة - المدينة - الحي - الشارع"
required>{{ old('address') }}</textarea>
</div>

<div class="field">
<label>ملاحظات إضافية</label>
<textarea name="notes"
placeholder="مثلاً: اتصل بي قبل التوصيل">{{ old('notes') }}</textarea>
</div>

<button class="submit" type="submit">
📱 تأكيد الطلب عبر واتساب
</button>

<div class="secure">
🔒 بياناتك تستخدم فقط لتجهيز طلبك
</div>

</form>

<a class="back" href="/cart">
← العودة إلى السلة
</a>

</div>

<div class="card summary">

<div class="card-title">
<div class="icon">🛍️</div>
<h2>ملخص الطلب</h2>
</div>

<div class="items">

@foreach($items as $item)

<div class="item">

<div>
<div class="item-name">
{{ $item->product->name }}
</div>

<div class="item-qty">
الكمية: {{ $item->quantity }}
</div>
</div>

<div class="item-price">
{{ number_format($item->product->price * $item->quantity,0) }}
{{ $item->product->currency }}
</div>

</div>

@endforeach

</div>

<div class="total">
<span>الإجمالي</span>

<strong>
{{ number_format($total,0) }}
</strong>
</div>

</div>

</div>

</div>

</body>
</html>
