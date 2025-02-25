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

        .logincontainer { width: 300px; margin: 50px auto; background: #fff; padding: 20px; border: 1px solid #ccc; }
        h2 { text-align: center; }
        input { width: 90%; padding: 10px; margin: 5px 0; }
        button { width: 100%; padding: 10px; background: #333; color: #fff; border: none; }
        .loga { display: block; text-align: center; margin-top: 10px; text-decoration: none; }
        .errors { color: red; font-size: 0.9em; }
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

    

    <div class="logincontainer">
                <h2>Login</h2>
                @if ($errors->any())
                    <div class="errors">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                </form>
                <a class="loga" href="{{ route('register') }}">Register</a>
            </div>


</body>
</html>