<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>إضافة منتج - معتز ستور</title>
<style>
body{margin:0;background:#f5f3f1;font-family:Arial,sans-serif;color:#2f1d14}
.container{max-width:600px;margin:30px auto;padding:20px}
.card{background:#fff;padding:25px;border-radius:16px;box-shadow:0 4px 20px #0001}
h2{margin-top:0}
label{display:block;margin:14px 0 7px;font-weight:bold}
input,textarea,select{width:100%;box-sizing:border-box;padding:12px;border:1px solid #ddd;border-radius:9px;font-size:15px}
button{width:100%;margin-top:20px;padding:13px;background:#3b2418;color:#fff;border:0;border-radius:9px;font-size:16px}
.back{display:inline-block;margin-bottom:15px;color:#3b2418;text-decoration:none}
</style>
</head>
<body>
<div class="container">
<a class="back" href="/admin/products">← العودة للمنتجات</a>

<div class="card">
<h2>إضافة منتج جديد</h2>

@if($errors->any())
<div style="background:#fee2e2;color:#991b1b;padding:12px;border-radius:8px">
@foreach($errors->all() as $error)
<div>{{ $error }}</div>
@endforeach
</div>
@endif

<form method="POST" action="/admin/products" enctype="multipart/form-data">
@csrf

<label>اسم المنتج</label>
<input type="text" name="name" value="{{ old('name') }}" required>

<label>الوصف</label>
<textarea name="description" rows="4">{{ old('description') }}</textarea>

<label>صورة المنتج</label>
<input type="file" name="image" accept="image/jpeg,image/png,image/webp">

<label>التصنيف</label>
<input type="text" name="category" value="{{ old('category') }}" placeholder="الهواتف">

<label>السعر</label>
<input type="number" name="price" value="{{ old('price') }}" step="0.01" required>

<label>سعر الشراء</label>
<input type="number" name="cost_price" value="{{ old('cost_price', 0) }}" step="0.01" min="0">
<label>العملة</label>
<select name="currency">
<option value="YER">ريال يمني</option>
<option value="USD">دولار</option>
</select>

<label>الكمية في المخزون</label>
<input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" required>

<label style="display:flex;align-items:center;gap:8px">
<input type="checkbox" name="featured" value="1" style="width:auto">
منتج مميز
</label>

<button type="submit">إضافة المنتج</button>
</form>
</div>
</div>
</body>
</html>
