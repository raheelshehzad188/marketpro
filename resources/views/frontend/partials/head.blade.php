<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Dynamically set meta description and author -->
<meta name="description" content="@yield('meta_description', 'Default Description')">
<meta name="author" content="@yield('meta_author', 'Default Author')">
<!-- Dynamic Title -->
<title>@yield('title', 'Home')</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('frontend/img/favicon.ico') }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ asset('frontend/img/apple-touch-icon.png') }}">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Web Fonts -->
<link id="googleFonts"
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap"
    rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/animate/animate.compat.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/vendor/magnific-popup/magnific-popup.min.css') }}">

<!-- Theme CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/rsr-custome.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/theme.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/theme-elements.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/theme-blog.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/theme-shop.css') }}">

<!-- Current Page CSS -->
<link rel="stylesheet" href="{{ asset('frontend/vendor/circle-flip-slideshow/css/component.css') }}">

<!-- Skin CSS -->
<link id="skinCSS" rel="stylesheet" href="{{ asset('frontend/css/skins/default.css') }}">

<!-- Theme Custom CSS -->
<link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

<!-- Theme Custom fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
<style>
    * {
        font-family: "Poppins", sans-serif;
    }
</style>
@yield('style')
