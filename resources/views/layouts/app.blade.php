<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="all">
    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <script type="text/javascript" src="{{ asset('/js/jquery-2.1.2.min.js') }}"></script>
</head>
<body>
    @include('layouts.header')

    <div class="wrapper">
        @yield('content')
    </div>

    @include('layouts.footer')
</body>
</html>