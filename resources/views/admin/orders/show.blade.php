<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>طلب #{{ $order->id }} - معتز ستور</title>
<style>
*{box-sizing:border-box}
body{margin:0;background:#f5f5f5;color:#222;font-family:Tahoma,Arial}
header{background:#3b2418;color:white;padding:16px}
.header{max-width:900px;margin:auto;display:flex;justify-content:space-between;align-items:center}
.logo{font-size:19px;font-weight:bold}
.back{color:white;text-decoration:none;background:#ffffff22;padding:8px 12px;border-radius:8px;font-size:12px}
.container{max-width:900px;margin:20px auto;padding:0 12px}
.card{background:white;border-radius:14px;padding:18px;margin-bottom:15px;box-shadow:0 2px 10px #0000000d}
h1{font-size:22px;margin:0 0 15px}
h2{font-size:17px;margin:0 0 14px;color:#3b2418}
.info{line-height:2;font-size:14px}
.item{display:flex;justify-content:space-between;gap:10px;padding:12px 0;border-bottom:1px solid #eee;font-size:13px}
.item:last-child{border-bottom:0}
.total{display:flex;justify-content:space-between;font-size:18px;font-weight:bold;color:#3b2418;margin-top:15px}
select{width:100%;padding:12px;border:1px solid #ddd;border-radius:9px;background:white;font-size:14px}
button{width:100%;margin-top:10px;padding:13px;border:0;border-radius:9px;background:#3b2418;color:white;font-size:15px}
.success{background:#e8f7e8;color:#287a28;padding:11px;border-radius:9px;margin-bottom:15px;font-size:13px}
.status-badge{display:inline-block;padding:8px 14px;border-radius:20px;font-weight:bold;font-size:13px;margin-bottom:12px}
.status-badge.pending{background:#fff3cd;color:#856404}
.status-badge.processing{background:#e3f2fd;color:#1565c0}
.status-badge.shipped{background:#e8eaf6;color:#3949ab}
.status-badge.completed{background:#e8f5e9;color:#2e7d32}
.status-badge.cancelled{background:#ffebee;color:#c62828}
.whatsapp-btn{display:block;width:100%;margin-top:10px;padding:13px;border-radius:9px;background:#25D366;color:white;text-decoration:none;text-align:center;font-size:15px;font-weight:bold}

</style>
</head>
<body>

<header>
<div class="header">
<div class="logo">معتز ستور | تفاصيل الطلب</div>
<a class="back" href="/admin/orders">الطلبات</a>
</div>
</header>

<div class="container">

@if(session('success'))
<div class="success">{{ session('success') }}</div>
@endif

<div class="card">
<h1>طلب #{{ $order->id }}</h1>

<div class="info">
<strong>العميل:</strong> {{ $order->customer_name }}<br>
<strong>الهاتف:</strong> {{ $order->phone }} <a href="https://wa.me/967{{ ltrim($order->phone, "0") }}" target="_blank" style="display:inline-block;background:#25D366;color:white;text-decoration:none;padding:5px 10px;border-radius:6px;font-size:11px;margin-right:6px">واتساب</a><br>
<strong>العنوان:</strong> {{ $order->address }}<br>

@if($order->notes)
<strong>ملاحظات:</strong> {{ $order->notes }}<br>
@endif

<strong>تاريخ الطلب:</strong> {{ $order->created_at->format('Y-m-d H:i') }}
</div>
</div>

<div class="card">
<h2>المنتجات</h2>
@php $orderProfit = 0; @endphp

@foreach($order->items as $item)
@php $itemProfit = ($item->price - $item->cost_price) * $item->quantity; $orderProfit += $itemProfit; @endphp
<div class="item">
<div>
<strong>{{ $item->product->name }}</strong><br>
الكمية: {{ $item->quantity }}
</div>
<div style="text-align:left">
{{ number_format($item->price * $item->quantity, 0) }} {{ $item->product->currency }}<br>
<span style="font-size:11px;color:#777">سعر الشراء: {{ number_format($item->cost_price, 0) }} {{ $item->product->currency }}</span><br>
<span style="font-size:12px;color:#2e7d32;font-weight:bold">الربح: {{ number_format($itemProfit, 0) }} {{ $item->product->currency }}</span>
</div>
</div>
@endforeach
<div class="total">
<span>الإجمالي</span>
<span>{{ number_format($order->total, 0) }} ريال</span>
</div>
<div style="margin-top:10px;padding:12px;background:#e8f5e9;border-radius:9px;color:#2e7d32;font-weight:bold;text-align:center">
إجمالي الربح: {{ number_format($orderProfit, 0) }} ريال
</div>
</div>


<div class="card">
<h2>حالة الطلب</h2>

<div class="status-badge {{ $order->status }}">
@switch($order->status)
@case('pending') 🆕 الحالة الحالية: جديد @break
@case('processing') 🔧 الحالة الحالية: قيد التجهيز @break
@case('shipped') 🚚 الحالة الحالية: تم الشحن @break
@case('completed') ✅ الحالة الحالية: مكتمل @break
@case('cancelled') ❌ الحالة الحالية: ملغي @break
@default الحالة الحالية: {{ $order->status }}
@endswitch
</div>
<form method="POST" action="/admin/orders/{{ $order->id }}/status">
@csrf

<select name="status">
<option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>جديد</option>
<option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>قيد التجهيز</option>
<option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>تم الشحن</option>
<option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>مكتمل</option>
<option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>ملغي</option>
</select>

<button type="submit">تحديث حالة الطلب</button>
</form>

@php
$statusMessages = [
    'pending' => 'السلام عليكم {{CUSTOMER}}، تم استلام طلبك رقم #{{ID}} في معتز ستور، وطلبك الآن بحالة: جديد. شكرًا لثقتك بنا.',
    'processing' => 'السلام عليكم {{CUSTOMER}}، طلبك رقم #{{ID}} في معتز ستور قيد التجهيز حاليًا. سنبلغك عند شحنه.',
    'shipped' => 'السلام عليكم {{CUSTOMER}}، تم شحن طلبك رقم #{{ID}} من معتز ستور. شكرًا لثقتك بنا.',
    'completed' => 'السلام عليكم {{CUSTOMER}}، تم إكمال طلبك رقم #{{ID}} بنجاح. شكرًا لاختيارك معتز ستور.',
    'cancelled' => 'السلام عليكم {{CUSTOMER}}، نعتذر منك، تم إلغاء طلبك رقم #{{ID}} في معتز ستور. للاستفسار تواصل معنا.',
];

$message = str_replace(
    ['{{CUSTOMER}}', '{{ID}}'],
    [$order->customer_name, $order->id],
    $statusMessages[$order->status] ?? $statusMessages['pending']
);

$whatsappNumber = '967' . ltrim($order->phone, '0');
@endphp

<a class="whatsapp-btn" target="_blank"
   href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($message) }}">
   📱 إرسال إشعار الحالة عبر واتساب
</a>
</div>

</div>
</body>
</html>
