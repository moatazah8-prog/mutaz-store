<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>دخول الإدارة - معتز ستور</title>
<style>
*{box-sizing:border-box}
body{
    margin:0;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#f5f3f1;
    font-family:Tahoma,Arial,sans-serif;
    color:#222;
}
.box{
    width:calc(100% - 30px);
    max-width:390px;
    background:#fff;
    border:1px solid #e8e4e1;
    border-radius:16px;
    padding:28px 22px;
    box-shadow:0 8px 30px #0000000d;
}
.logo{
    text-align:center;
    color:#2f1d14;
    font-size:25px;
    font-weight:bold;
    margin-bottom:5px;
}
.subtitle{
    text-align:center;
    color:#888;
    font-size:12px;
    margin-bottom:25px;
}
label{
    display:block;
    font-size:12px;
    font-weight:bold;
    margin-bottom:7px;
}
input{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:9px;
    outline:none;
    font-family:inherit;
    font-size:13px;
    margin-bottom:14px;
}
input:focus{border-color:#2f1d14}
button{
    width:100%;
    border:0;
    border-radius:9px;
    padding:13px;
    background:#2f1d14;
    color:#fff;
    font-family:inherit;
    font-size:14px;
    font-weight:bold;
    cursor:pointer;
}
.error{
    background:#fff1f1;
    border:1px solid #f0b8b8;
    color:#a52828;
    border-radius:9px;
    padding:10px;
    margin-bottom:15px;
    font-size:12px;
}
.back{
    display:block;
    text-align:center;
    margin-top:16px;
    color:#777;
    text-decoration:none;
    font-size:11px;
}
</style>
</head>
<body>

<div class="box">

<div class="logo">معتز ستور</div>
<div class="subtitle">لوحة تحكم الإدارة</div>

@if($errors->any())
<div class="error">
{{ $errors->first() }}
</div>
@endif

<form method="POST" action="/admin/login">
@csrf

<label>البريد الإلكتروني</label>
<input
    type="email"
    name="email"
    value="{{ old('email') }}"
    placeholder="admin@mutazstore.com"
    required
>

<label>كلمة المرور</label>
<input
    type="password"
    name="password"
    placeholder="أدخل كلمة المرور"
    required
>

<button type="submit">دخول إلى لوحة الإدارة</button>

</form>

<a class="back" href="/">← العودة إلى المتجر</a>

</div>

</body>
</html>
