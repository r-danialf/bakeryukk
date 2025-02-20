<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Dashboard</title>
    @vite(['resources/css/app.css'])
</head>
<body>

    @include('components.top-nav')

    <div class="dashboardform">
        <h1>Dashboard</h1>
        <hr>
        <div class="boxes">
            <div class="green">
                <p>Total Customers: {{ $totalCustomers }}</p>
            </div>
            <div class="blue">
                <p>Total Transactions: {{ $totalTransactions }}</p>
            </div>
            <div class="yellow">
                <p>Total Revenue: Rp{{ number_format($totalRevenue, 2) }}</p>
            </div>
            <div class="red">
                <p>Total Products: {{ $totalProducts }}</p>
            </div>
        </div>
    </div>

</body>
</html>
