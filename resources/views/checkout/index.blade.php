<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>إتمام الطلب - معتز ستور</title>

<style>
*{box-sizing:border-box}

body{
margin:0;
background:#f5f5f5;
font-family:Tahoma,Arial,sans-serif;
color:#222;
}

header{
height:60px;
background:#fff;
border-bottom:1px solid #eee;
display:flex;
align-items:center;
}

.header{
width:100%;
max-width:1000px;
margin:auto;
padding:0 12px;
display:flex;
align-items:center;
justify-content:space-between;
}

.logo{
color:#2f1d14;
text-decoration:none;
font-size:19px;
font-weight:bold;
}

.cart{
background:#2f1d14;
color:#fff;
text-decoration:none;
padding:8px 11px;
border-radius:8px;
font-size:12px;
}

.container{
width:100%;
max-width:1000px;
margin:auto;
padding:16px 10px 35px;
}

.title{
margin-bottom:14px;
}

.title h1{
font-size:21px;
margin:0 0 5px;
color:#2f1d14;
}

.title p{
font-size:12px;
color:#888;
margin:0;
}

.grid{
display:grid;
grid-template-columns:minmax(0,1fr) 320px;
gap:12px;
align-items:start;
}

.card{
background:#fff;
border:1px solid #e8e8e8;
border-radius:12px;
padding:16px;
}

.card h2{
font-size:15px;
margin:0 0 16px;
padding-bottom:12px;
border-bottom:1px solid #eee;
}

.field{
margin-bottom:13px;
}

label{
display:block;
font-size:12px;
font-weight:bold;
margin-bottom:6px;
}

input,
textarea{
width:100%;
border:1px solid #ddd;
border-radius:8px;
padding:11px;
font-family:Tahoma,Arial,sans-serif;
font-size:13px;
background:#fff;
outline:none;
}

input:focus,
textarea:focus{
border-color:#2f1d14;
}

textarea{
height:75px;
resize:none;
}

.submit{
width:100%;
border:0;
border-radius:9px;
padding:13px;
margin-top:3px;
background:#168c45;
color:white;
font-family:inherit;
font-size:13px;
font-weight:bold;
}

.back{
display:block;
text-align:center;
text-decoration:none;
color:#2f1d14;
font-size:12px;
margin-top:12px;
}

.product{
display:flex;
align-items:center;
justify-content:space-between;
gap:10px;
padding:11px 0;
border-bottom:1px solid #eee;
}

.product:last-child{
border-bottom:0;
}

.checkout-image{width:48px;height:48px;background:#f7f7f7;border-radius:8px;overflow:hidden;display:flex;align-items:center;justify-content:center;flex-shrink:0}.checkout-image img{width:100%;height:100%;object-fit:contain}
.product-name{
font-size:12px;
font-weight:bold;
line-height:1.6;
}

.product-qty{
font-size:10px;
color:#888;
}

.product-price{
font-size:12px;
font-weight:bold;
color:#2f1d14;
white-space:nowrap;
}

.total{
margin-top:12px;
padding:13px;
background:#f5f2f0;
border-radius:9px;
display:flex;
align-items:center;
justify-content:space-between;
}

.total span{
font-size:12px;
color:#777;
}

.total strong{
font-size:17px;
color:#2f1d14;
}

.note{
text-align:center;
font-size:10px;
color:#999;
margin-top:10px;
}

@media(max-width:700px){

.grid{
display:flex;
flex-direction:column;
gap:10px;
}

.form-card{
order:1;
}

.summary-card{
order:2;
}

.card{
width:100%;
padding:15px;
}

.title h1{
font-size:20px;
}

input,
textarea{
font-size:14px;
}

.submit{
font-size:14px;
padding:14px;
}

}
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

<div class="title">

<h1>إتمام الطلب</h1>

<p>
أدخل بيانات التوصيل لإرسال طلبك
</p>

</div>

<div class="grid">

<div class="card form-card">

@if($errors->any())<div style="background:#fff1f1;border:1px solid #f0b8b8;color:#a52828;border-radius:9px;padding:11px;margin-bottom:14px;font-size:12px;"><strong>يرجى تصحيح البيانات:</strong><ul style="margin:7px 0 0;padding-right:18px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif<h2>بيانات التوصيل</h2>

<form method="POST" action="/checkout">

@csrf

<div class="field">

<label>الاسم الكامل</label>

<input
type="text"
name="customer_name"
placeholder="اكتب اسمك الكامل"
value="{{ old('customer_name') }}"
required
>

</div>

<div class="field">

<label>رقم الهاتف</label>

<input
type="tel"
name="phone"
placeholder="777123456"
value="{{ old('phone') }}"
required
>

</div>

<div class="field">

<label>المحافظة</label>

<select
name="governorate"
required
style="width:100%;border:1px solid #ddd;border-radius:8px;padding:11px;font-family:Tahoma,Arial,sans-serif;font-size:13px;background:#fff;outline:none"
>
<option value="">اختر المحافظة</option>
@foreach(['أمانة العاصمة','صنعاء','تعز','عدن','إب','الحديدة','حضرموت','لحج','أبين','ذمار','البيضاء','شَـبوة','مأرب','الجوف','صعدة','حجة','المحويت','ريمة','الضالع','عمران','سقطرى','المهرة'] as $gov)
<option value="{{ $gov }}" @selected(old('governorate') === $gov)>{{ $gov }}</option>
@endforeach
</select>

</div>

<div class="field">

<label>المدينة / المديرية</label>

<input
type="text"
name="city"
placeholder="مثال: صنعاء القديمة"
value="{{ old('city') }}"
required
>

</div>

<div class="field">

<label>الحي والشارع</label>

<textarea
name="address"
placeholder="اكتب الحي واسم الشارع وأقرب معلم"
required
>{{ old('address') }}</textarea>

</div>

<div class="field">

<label>ملاحظات إضافية <span style="color:#999">(اختياري)</span></label>

<textarea
name="notes"
placeholder="أي ملاحظة خاصة بالطلب"
>{{ old('notes') }}</textarea>

</div>

<button class="submit" type="submit">
📱 تأكيد الطلب عبر واتساب
</button>

</form>

<a href="/cart" class="back">
← العودة إلى السلة
</a>

</div>

<div class="card summary-card">

<h2>ملخص الطلب</h2>

@foreach($items as $item)

<div class="product">
<div class="checkout-image">@if($item->product->image)<img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">@else📱@endif</div>

<div>

<div class="product-name">
{{ $item->product->name }}
</div>

<div class="product-qty">
الكمية: {{ $item->quantity }}
</div>

</div>

<div class="product-price">
{{ number_format($item->product->price * $item->quantity,0) }}
{{ $item->product->currency }}
</div>

</div>

@endforeach

<div class="total">

<span>الإجمالي</span>

<strong>
{{ number_format($total,0) }}
</strong>

</div>

<div class="note">
🔒 بياناتك تستخدم لإتمام طلبك فقط
</div>

</div>

</div>

</div>

</body>
</html>
