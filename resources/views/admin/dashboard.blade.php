<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>لوحة الإدارة - معتز ستور</title>

<style>
*{box-sizing:border-box}

body{
    margin:0;
    background:#f5f5f5;
    color:#222;
    font-family:Tahoma,Arial,sans-serif;
}

header{
    background:#2f1d14;
    color:#fff;
    padding:14px;
}

.header{
    max-width:1100px;
    margin:auto;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.logo{
    font-size:19px;
    font-weight:bold;
}

.logout{
    background:#fff;
    color:#2f1d14;
    border:0;
    border-radius:8px;
    padding:8px 12px;
    font-family:inherit;
    font-size:11px;
}

.container{
    max-width:1100px;
    margin:auto;
    padding:18px 12px 35px;
}

.welcome{
    margin-bottom:18px;
}

.welcome h1{
    margin:0 0 5px;
    font-size:21px;
    color:#2f1d14;
}

.welcome p{
    margin:0;
    color:#888;
    font-size:12px;
}

.stats{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:12px;
    margin-bottom:18px;
}

.stat{
    background:#fff;
    border:1px solid #e8e8e8;
    border-radius:12px;
    padding:17px;
}

.stat-icon{
    font-size:22px;
    margin-bottom:8px;
}

.stat-label{
    color:#888;
    font-size:11px;
}

.stat-value{
    color:#2f1d14;
    font-size:21px;
    font-weight:bold;
    margin-top:5px;
}

.card{
    background:#fff;
    border:1px solid #e8e8e8;
    border-radius:12px;
    padding:16px;
}

.card h2{
    font-size:15px;
    margin:0 0 14px;
    padding-bottom:12px;
    border-bottom:1px solid #eee;
}

.order{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    padding:12px 0;
    border-bottom:1px solid #eee;
}

.order:last-child{
    border-bottom:0;
}

.order-info strong{
    display:block;
    font-size:13px;
    margin-bottom:5px;
}

.order-info span{
    color:#888;
    font-size:10px;
}

.order-price{
    color:#2f1d14;
    font-size:12px;
    font-weight:bold;
    white-space:nowrap;
}

.status{
    display:inline-block;
    margin-top:5px;
    background:#fff4d6;
    color:#916b00;
    padding:4px 7px;
    border-radius:5px;
    font-size:9px;
}

.empty{
    text-align:center;
    padding:25px;
    color:#999;
    font-size:12px;
}

@media(max-width:700px){

    .stats{
        grid-template-columns:repeat(2,1fr);
        gap:9px;
    }

    .stat{
        padding:13px;
    }

    .stat-value{
        font-size:18px;
    }

    .container{
        padding:14px 10px 30px;
    }
}
</style>
</head>

<body>

<header>
<div class="header">

<div class="logo">
معتز ستور | الإدارة
</div>

<form method="POST" action="/admin/logout">
@csrf
<button class="logout" type="submit">
تسجيل الخروج
</button>
</form>

</div>
</header>

<div class="container">

<div class="welcome">
<h1>مرحبًا، {{ $admin->name }}</h1>
<p>هذه لوحة التحكم الخاصة بمتجر معتز ستور</p>
</div>

<div class="stats">

<div class="stat">
<div class="stat-icon">📦</div>
<div class="stat-label">إجمالي الطلبات</div>
<div class="stat-value">{{ $ordersCount }}</div>
</div>

<div class="stat">
<div class="stat-icon">🛍️</div>
<div class="stat-label">المنتجات</div>
<div class="stat-value">{{ $productsCount }}</div>
</div>

<div class="stat">
<div class="stat-icon">🆕</div>
<div class="stat-label">طلبات جديدة</div>
<div class="stat-value">{{ $pendingOrders }}</div>
</div>

<div class="stat"><div class="stat-icon">💰</div><div class="stat-label">إجمالي المبيعات</div><div class="stat-value">{{ number_format($totalSales,0) }}</div></div>
<div class="stat" style="border:2px solid #d4a017"><div class="stat-icon">📈</div><div class="stat-label">إجمالي الأرباح</div><div class="stat-value">{{ number_format($totalProfit,0) }} YER</div></div>
<div class="stat"><div class="stat-icon">📦</div><div class="stat-label">قيمة المخزون</div><div class="stat-value">{{ number_format($inventoryValue,0) }} YER</div>

</div>

</div>
<div class="card">

<div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:15px"><a href="/admin/products" style="background:#3b2418;color:white;text-decoration:none;padding:10px 14px;border-radius:8px;font-size:13px">📦 إدارة المنتجات</a><a href="/admin/orders" style="background:#6b422d;color:white;text-decoration:none;padding:10px 14px;border-radius:8px;font-size:13px">🛒 إدارة الطلبات</a></div>
@if($topProducts->count())
<div class="card" style="margin-bottom:18px"><h2>🏆 أكثر المنتجات مبيعًا</h2>
@foreach($topProducts as $top)
<div style="display:flex;justify-content:space-between;align-items:center;padding:11px 0;border-bottom:1px solid #eee">
                <span style="font-size:13px;font-weight:bold">{{ $top->product->name }}</span>
                <span style="font-size:12px;color:#2e7d32;font-weight:bold">{{ $top->total_quantity }} قطعة<br>{{ number_format($top->total_sales,0) }} ريال<br><span style="color:#2e7d32">ربح: {{ number_format($top->total_profit,0) }} ريال</span></span>
</div>
@endforeach
</div>
@endif
<div class="card" style="margin-bottom:18px"><h2>📊 تقرير المبيعات والأرباح</h2>
<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:10px">
<div style="background:#f8f8f8;padding:12px;border-radius:9px;text-align:center"><strong>اليوم</strong><br><span style="font-size:12px">مبيعات: {{ number_format($todaySales,0) }}</span><br><span style="font-size:12px;color:#2e7d32">ربح: {{ number_format($todayProfit,0) }}</span></div>
<div style="background:#f8f8f8;padding:12px;border-radius:9px;text-align:center"><strong>الأسبوع</strong><br><span style="font-size:12px">مبيعات: {{ number_format($weekSales,0) }}</span><br><span style="font-size:12px;color:#2e7d32">ربح: {{ number_format($weekProfit,0) }}</span></div>
<div style="background:#f8f8f8;padding:12px;border-radius:9px;text-align:center"><strong>الشهر</strong><br><span style="font-size:12px">مبيعات: {{ number_format($monthSales,0) }}</span><br><span style="font-size:12px;color:#2e7d32">ربح: {{ number_format($monthProfit,0) }}</span></div>
<div style="background:#f8f8f8;padding:12px;border-radius:9px;text-align:center"><strong>السنة</strong><br><span style="font-size:12px">مبيعات: {{ number_format($yearSales,0) }}</span><br><span style="font-size:12px;color:#2e7d32">ربح: {{ number_format($yearProfit,0) }}</span></div>
</div></div>
<div class="card" style="margin-bottom:18px"><h2>📈 مبيعات وأرباح السنة</h2>
<div style="height:300px"><canvas id="salesChart"></canvas></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const monthlySales = @json($monthlySales);
const monthlyProfit = @json($monthlyProfit);
const months = ["يناير","فبراير","مارس","أبريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر"];
new Chart(document.getElementById("salesChart"), {
type:"bar",
data:{labels:months,datasets:[{label:"المبيعات",data:months.map((_,i)=>Number(monthlySales[i+1]||0))},{label:"الأرباح",data:months.map((_,i)=>Number(monthlyProfit[i+1]||0))}]},
options:{responsive:true,maintainAspectRatio:false,interaction:{mode:"index",intersect:false},plugins:{tooltip:{callbacks:{label:function(context){return context.dataset.label+": "+Number(context.raw).toLocaleString("ar-YE")+" ريال";}}}},scales:{y:{beginAtZero:true}}}
});
</script>
<h2>آخر الطلبات</h2>
@if($latestOrders->count())
@foreach($latestOrders as $order)
<div class="order">
<div class="order-info">
<strong>#{{ $order->id }} — {{ $order->customer_name }}</strong>
<span>{{ $order->phone }}</span>
<div><span class="status">{{ $order->status }}</span></div>
</div>
<div class="order-price">{{ number_format($order->total,0) }} ريال</div>
</div>
@endforeach
@else
<div class="empty">لا توجد طلبات حتى الآن</div>
@endif
</div>



<div class="container">
<div class="card" style="margin-top:15px">
<h2>⚠️ منتجات المخزون المنخفض</h2>
@if($lowStockProducts->count())
@foreach($lowStockProducts as $product)
<div class="order">
 <div style="text-align:left"><div style="color:{{ $product->stock == 0 ? "#c62828" : "#916b00" }};font-weight:bold;font-size:13px">{{ $product->stock == 0 ? "نفد المخزون" : $product->stock . " قطع فقط" }}</div><div><a href="{{ url("/admin/products/" . $product->id . "/edit") }}" style="display:inline-block;margin-top:6px;background:#2f1d14;color:#fff;padding:5px 8px;border-radius:5px;text-decoration:none;font-size:10px">تعديل المخزون</a><form method="POST" action="{{ url("/admin/products/" . $product->id . "/add-stock") }}" style="display:inline-flex;gap:4px;margin-top:6px;margin-right:4px">@csrf<input type="number" name="quantity" min="1" placeholder="الكمية" required style="width:65px;padding:5px;border:1px solid #ddd;border-radius:5px;font-size:10px"><button type="submit" style="background:#2e7d32;color:#fff;border:0;border-radius:5px;padding:5px 7px;font-size:10px">+ مخزون</button></form></div></div>
</div>
@endforeach
@else
<div class="empty">لا توجد منتجات منخفضة المخزون 🎉</div>
@endif
</div>
</div>
</body>
</html>
