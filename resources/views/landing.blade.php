<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NESSA BAKERY</title>
    <style>
        body {
            background-color: #F3E5AB;
            color: #4E2B24;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;

            background-image: url('{{ asset('storage/images/menu/beground.png') }}');
            background-size: cover;
            background-repeat: no-repeat; /* Prevents tiling */
            background-position: center; /* Centers the image */
            background-attachment: fixed; /* Keeps the image fixed */
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        .logo-container img {
            height: 64px;
            width: auto;
            margin-right: 10px;
        }
        .nav-links a {
            text-decoration: none;
            color: #4E2B24;
            margin-left: 15px;
            transition: color 0.3s;
        }
        .nav-links a:hover {
            color: #7B3F00;
        }
        .hero-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
        }
        .hero-text {
            max-width: 600px;
            margin-bottom: 20px;
        }
        .hero-text h1 {
            font-size: 20px;
            font-weight: bold;
        }
        .hero-text h2 {
            font-size: 50px;
            font-weight: bold;
        }
        .hero-text p {
            font-size: 16px;
        }
        
        
        footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
        }
        @media (min-width: 768px) {
            .hero-section {
                flex-direction: row;
                justify-content: center;
                text-align: left;
                padding: 60px 80px;
                margin
            }
            .hero-text {
                flex: 1;
            }
            .hero-image {
                flex: 1;
                text-align: right;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="{{ asset('storage/images/menu/logobakery.png') }}" alt="Logo Bakery">
            <span class="text-lg font-semibold">@Nessa.bakery_</span>
        </div>
        <nav class="nav-links">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Registrasi</a>
        </nav>
    </header>

    <section class="hero-section">
        <div class="hero-text">
            <h1>📞 0858-1633-7475 | 🏠 Sukosewu, Bojonegoro, Jawa Timur</h1>
        </div>
        
            
        </div>
    </section>

   
</body>
</html>