<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery Dashboard</title>
    <style>
        .landing {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('storage/images/menu/breads.jpg') }}');
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="overflow: hidden;">
    <nav class="topnav">
        <div>
            <img src="{{ asset('storage/images/menu/bun.webp') }}" alt="">
            <div class="tn-title">Crème n' Crumb</div>
            <div class="tn-separator"></div>
        </div>
        <div class="tn-navlink">
            <ul>
                <li><a href="/register">Register</a></li>
                <li><a href="/login">Login</a></li>
            </ul>
        </div>
    </nav>

    <div class="landing">
        <div>
            <h1>Halo, Karyawan Crème n' Crumb.</h1>
            <hr>
            <p>Silahkan memulai pekerjaanmu dengan tepat waktu.</p>
            <p>Pastikan untuk login dengan mengakses menu yang ada di atas.</p>
            <p>Atau register saat belum terdaftar.</p>
        </div>
    </div>

</body>
</html>
