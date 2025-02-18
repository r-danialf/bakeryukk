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
    </body>
</html>
