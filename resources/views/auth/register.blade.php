<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        /* Minimal CSS styling */
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { width: 300px; margin: 50px auto; background: #fff; padding: 20px; border: 1px solid #ccc; }
        h2 { text-align: center; }
        input { width: 100%; padding: 10px; margin: 5px 0; }
        button { width: 100%; padding: 10px; background: #333; color: #fff; border: none; }
        a { display: block; text-align: center; margin-top: 10px; text-decoration: none; }
        .errors { color: red; font-size: 0.9em; }
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('storage/images/menu/breads.jpg') }}');
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('components.landing-top-nav')
    <div class="container">
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
</body>
</html>
