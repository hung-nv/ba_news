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
    <link rel="stylesheet" href="{{ asset('/css/app-mobile.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/responsivemobilemenu.css') }}">
    <script type="text/javascript" src="{{ asset('/js/jquery-2.1.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/responsivemobilemenu.js') }}"></script>
</head>
<body>
@include('mobile.layouts.header')

@include('mobile.layouts.breadcrumbs')

@if (!empty($ads300))
    <div style="text-align: center; margin-bottom: 5px;">
        <!-- ADS 300 -->
        <div class="clear"></div>
    </div>
@endif

<div id="wrapper">
    <div id="content">
        @yield('content')
    </div>
</div>

@include('mobile.layouts.footer')
</body>
</html>