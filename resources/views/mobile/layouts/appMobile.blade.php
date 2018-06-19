<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="all">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app-mobile.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/responsivemobilemenu.css') }}">
</head>
<body>
@include('mobile.layouts.header')

@include('mobile.layouts.breadcrumbs')

<div id="wrapper">
    <div id="content">
        @yield('content')
    </div>
</div>

@include('mobile.layouts.footer')

<script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/responsivemobilemenu.js') }}"></script>
</body>
</html>