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
    font-family:Tahoma,Arial,sans-serif;
    background:#f6f6f6;
    color:#222;
}

header{
    background:#fff;
    border-bottom:1px solid #eee;
    padding:15px;
}

.header{
    max-width:900px;
    margin:auto;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    color:#2f1d14;
    text-decoration:none;
    font-size:20px;
    font-weight:bold;
}

.container{
    max-width:700px;
    margin:auto;
    padding:20px 12px;
}

.box{
    background:#fff;
    padding:20px;
    border-radius:14px;
    border:1px solid #eee;
}

h1{
    font-size:21px;
    margin:0 0 20px;
}

label{
    display:block;
    font-size:13px;
    margin:14px 0 7px;
    font-weight:bold;
}

input,
textarea{
    width:100%;
    border:1px solid #ddd;
    border-radius:9px;
    padding:13px;
    font-family:inherit;
    font-size:14px;
    outline:none;
}

textarea{
    min-height:90px;
    resize:vertical;
}

.summary{
    background:#f7f5f3;
    padding:14px;
    border-radius:10px;
    margin:20px 0;
}

.summary p{
    margin:7px 0;
    font-size:13px;
}

.total{
    color:#2f1d14;
    font-size:19px;
    font-weight:bold;
    margin-top:12px;
}

.submit{
    width:100%;
    border:0;
    border-radius:10px;
    padding:14px;
    background:#168c45;
    color:#fff;
    font-size:16px;
    font-family:inherit;
    cursor:pointer;
}

.back{
    display:block;
    text-align:center;
    margin-top:15px;
    color:#2f1d14;
    text-decoration:none;
    font-size:13px;
}
</style>
</head>

<body>

<header>
<div class="header">
<a href="/" class="logo">معتز ستور للإلكترونيات</a>
</div>
</header>

<div class="container">

<div class="box">

<h1>إتمام الطلب</h1>

<form method="POST" action="/checkout">
@csrf

<label>الاسم الكامل</label>
<input
type="text"
name="customer_name"
placeholder="اكتب اسمك"
value="{{ old('customer_name') }}"
required
>

<label>رقم الهاتف</label>
<input
type="tel"
name="phone"
placeholder="مثال: 777123456"
value="{{ old('phone') }}"
required
>

<label>العنوان</label>
<textarea
name="address"
placeholder="المحافظة - المدينة - الحي - الشارع"
required
>{{ old('address') }}</textarea>

<label>ملاحظات إضافية</label>
<textarea
name="notes"
placeholder="أي ملاحظات على الطلب (اختياري)"
>{{ old('notes') }}</textarea>

<div class="summary">

<strong>ملخص الطلب</strong>

@foreach($items as $item)
<p>
{{ $item->product->name }}
× {{ $item->quantity }}
</p>
@endforeach

<div class="total">
الإجمالي:
{{ number_format($total,0) }}
</div>

</div>

<button class="submit" type="submit">
📱 تأكيد الطلب عبر واتساب
</button>

</form>

<a class="back" href="/cart">
← العودة إلى السلة
</a>

</div>

</div>

</body>
</html>
