<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Dynamically set meta description and author -->
<meta name="description" content="@yield('meta_description', get_setting('meta_description', 'Default Description'))">
<meta name="author" content="@yield('meta_author', get_setting('site_name', 'MarketPro'))">
<!-- Dynamic Title -->
<title>@yield('title', get_setting('site_name', 'MarketPro')) - {{ get_setting('site_motto', 'E-commerce') }}</title>

<!-- Favicon -->
@php
    $favicon = get_setting('site_icon');
    $faviconUrl = $favicon ? uploaded_asset($favicon) : static_asset('frontend/img/favicon.ico');
@endphp
<link rel="shortcut icon" href="{{ $faviconUrl }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ $faviconUrl }}">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

<!-- Web Fonts -->
<link id="googleFonts"
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap"
    rel="stylesheet" type="text/css">

<!-- Bootstrap -->
<link rel="stylesheet" href="{{ static_asset('frontend/css/bootstrap.min.css') }}">
<!-- select 2 -->
<link rel="stylesheet" href="{{ static_asset('frontend/css/select2.min.css') }}">
<!-- Slick -->
<link rel="stylesheet" href="{{ static_asset('frontend/css/slick.css') }}">
<!-- Jquery Ui -->
<link rel="stylesheet" href="{{ static_asset('frontend/css/jquery-ui.css') }}">
<!-- animate -->
<link rel="stylesheet" href="{{ static_asset('frontend/css/animate.css') }}">
<!-- AOS Animation -->
<link rel="stylesheet" href="{{ static_asset('frontend/css/aos.css') }}">
<!-- Main css -->
<link rel="stylesheet" href="{{ static_asset('frontend/css/main.css') }}">

@yield('style')

