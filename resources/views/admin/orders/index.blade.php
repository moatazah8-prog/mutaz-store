<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>الطلبات - معتز ستور</title>
<style>
*{box-sizing:border-box}
body{margin:0;background:#f5f5f5;color:#222;font-family:Tahoma,Arial}
header{background:#3b2418;color:white;padding:16px}
.header{max-width:1100px;margin:auto;display:flex;justify-content:space-between;align-items:center}
.logo{font-size:20px;font-weight:bold}
.back{color:white;text-decoration:none;background:#ffffff22;padding:9px 12px;border-radius:8px;font-size:13px}
.container{max-width:1100px;margin:20px auto;padding:0 12px}
h1{font-size:24px;margin:0 0 18px}
.card{background:white;border-radius:14px;overflow:hidden;box-shadow:0 2px 10px #0000000d}
.order{padding:16px;border-bottom:1px solid #eee}
.order:last-child{border-bottom:0}
.top{display:flex;justify-content:space-between;gap:10px;align-items:center}
.id{font-weight:bold;color:#3b2418}
.name{font-size:16px;font-weight:bold;margin:8px 0}
.info{font-size:13px;color:#666;line-height:1.8}
.bottom{display:flex;justify-content:space-between;align-items:center;margin-top:12px;gap:10px}
.status{padding:6px 10px;border-radius:20px;font-size:12px;background:#fff3cd;color:#856404}
.price{font-weight:bold;color:#3b2418}
.btn{display:inline-block;background:#3b2418;color:white;text-decoration:none;padding:9px 13px;border-radius:8px;font-size:12px}
.empty{text-align:center;padding:40px;color:#777}
@media(max-width:600px){
 h1{font-size:20px}
 .bottom{align-items:flex-start;flex-direction:column}
 .btn{width:100%;text-align:center}
}
</style>
</head>
<body>

<header>
<div class="header">
<div class="logo">معتز ستور | الطلبات</div>
<a class="back" href="/admin">لوحة التحكم</a>
</div>
</header>

<div class="container">
<h1>جميع الطلبات</h1>

<div class="card">
@if($orders->isEmpty())
    <div class="empty">لا توجد طلبات حتى الآن</div>
@else
    @foreach($orders as $order)
    <div class="order">
        <div class="top">
            <div class="id">طلب #{{ $order->id }}</div>
            <div class="info">{{ $order->created_at->format('Y-m-d H:i') }}</div>
        </div>

        <div class="name">{{ $order->customer_name }}</div>

        <div class="info">
            📞 {{ $order->phone }} <a href="https://wa.me/967{{ ltrim($order->phone, "0") }}" target="_blank" style="display:inline-block;background:#25D366;color:white;text-decoration:none;padding:5px 10px;border-radius:6px;font-size:11px;margin-right:6px">واتساب</a><br>
            📍 {{ $order->address }}
        </div>

        <div class="bottom">
            <div>
                <span class="status status-{{ $order->status }}">
                    @switch($order->status)
                        @case('pending') جديد @break
                        @case('processing') قيد التجهيز @break
                        @case('shipped') تم الشحن @break
                        @case('completed') مكتمل @break
                        @case('cancelled') ملغي @break
                        @default {{ $order->status }}
                    @endswitch
                </span>
                <span class="price">{{ number_format($order->total, 0) }} ريال</span>
            </div>

            <a class="btn" href="/admin/orders/{{ $order->id }}">عرض التفاصيل</a>
        </div>
    </div>
    @endforeach
@endif
</div>
</div>

</body>
</html>
