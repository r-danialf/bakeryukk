<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: center;
            background-color: #fff4e6;
            margin: 0;
            padding: 0;
            position: relative;
            width: 100%;
            display: flex;
            flex-direction: column;
            /*background-image: url('http://127.0.0.1:8000/images/bg2.jpg');
            */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
        }
        .container {
            background-color: rgb(71, 46, 20);
            padding: 40px 10px;
            flex-grow: 1;
        }
        .title {
            font-size: 55px;
            font-weight: bold;
            color: rgb(247, 213, 189);
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2);
        }
        .subtitle {
            font-size: 28px;
            color: rgb(233, 181, 143);
            font-style: italic;
        }
        .banner {
            text-align: center;
            height: 62vh;
            display: flex;
        }
        .banner .image {
            flex: -30;
            display: flex;
            align-items: center;
        }
        .banner-text {
            width: 40%;
            font-size: 20px;
            color: rgb(53, 26, 6);
            text-align: left;
            margin-top: 50px;
        }
        .footer {
            background-color: #3a2612;
            color: white;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
            border-radius: 15px;
            display: block;
            width: 100%;
            text-align: center;
            position: relative;
        }
        marquee {
            font-size: 16px;
            font-weight: bold;
            display: block;
        }
        .corner-decoration {
            position: absolute;
            padding: 20px;
            width: 160px;
            height: 160px;
        }
        .top-right {
            top: 2px;
            right: 2px;
        }
        .nav {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 15px;
        }
        .nav a {
            color: #3a2612;
            font-weight: bold;
            text-decoration: none;
            font-size: 18px;
            background: #f3d9b1;
            padding: 8px 12px;
            border-radius: 5px;
        }
        .nav a:hover {
            background: #e4b97f;
        }

        .logincontainer { width: 300px; margin: 1em auto; background: #fff; padding: 20px; border: 1px solid #ccc; }
        h2 { text-align: center; }
        input { width: 90%; padding: 10px; margin: 5px 0; }
        button { width: 100%; padding: 10px; background: #333; color: #fff; border: none; }
        a { display: block; text-align: center; margin-top: 10px; text-decoration: none; }
        .errors { color: red; font-size: 0.9em; }
    </style>

</head>
<body>
    <img src="{{ asset('storage/images/menu/gandum1.png') }}" class="corner-decoration top-right" alt="Leaf Decor">
    <div class="nav">
        <a href="/login">Login</a>
        <a href="/register">Registrasi</a>
    </div>
    <div class="container">
        <div class="title">Selamat Datang di Felia Bakery</div>
        <div class="subtitle">Rasa dan Kualitas Terbaik!</div>
    </div>
    <div class="banner">
        <div class="image">
            <img src="{{ asset('storage/images/menu/chef1.png') }}" alt="">
        </div> 
        <div class="logincontainer">
            <h2>Register</h2>
            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password (min 8 characters)" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <button type="submit">Register</button>
            </form>
            <a href="{{ route('login') }}">Already have an account? Login</a>
        </div>
    </div>
    <div class="footer">
        <marquee> ☎️ 088296190618 | 📍 Sumberrejo, Bojonegoro, Jawa Timur | 🚗 Kunjungi Toko Roti Felia Bakery!!</marquee>
    </div>
</body>
</html>
        
