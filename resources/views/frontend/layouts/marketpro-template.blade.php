<!DOCTYPE html>
<html lang="en" class="color-two font-exo header-style-two">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>MarketPro - {{ $pageTitle ?? 'Checkout' }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('marketpro_php/assets/images/logo/favicon.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('marketpro_php/assets/css/bootstrap.min.css') }}">
    <!-- select 2 -->
    <link rel="stylesheet" href="{{ asset('marketpro_php/assets/css/select2.min.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('marketpro_php/assets/css/slick.css') }}">
    <!-- Jquery Ui -->
    <link rel="stylesheet" href="{{ asset('marketpro_php/assets/css/jquery-ui.css') }}">
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('marketpro_php/assets/css/animate.css') }}">
    <!-- AOS Animation -->
    <link rel="stylesheet" href="{{ asset('marketpro_php/assets/css/aos.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('marketpro_php/assets/css/main.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    @yield('style')
</head> 
<body>
    
<!--==================== Preloader Start ====================-->
  <div class="preloader">
    <img src="{{ asset('marketpro_php/assets/images/icon/preloader.gif') }}" alt="">
  </div>
<!--==================== Preloader End ====================-->

<!--==================== Overlay Start ====================-->
<div class="overlay"></div>
<!--==================== Overlay End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

<!-- ==================== Scroll to Top End Here ==================== -->
<div class="progress-wrap">
  <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
  </svg>
</div>
<!-- ==================== Scroll to Top End Here ==================== -->

<!-- ==================== Search Box Start Here ==================== -->
 <form action="#" class="search-box">
  <button type="button" class="search-box__close position-absolute inset-block-start-0 inset-inline-end-0 m-16 w-48 h-48 border border-gray-100 rounded-circle flex-center text-white hover-text-gray-800 hover-bg-white text-2xl transition-1">
    <i class="ph ph-x"></i>
  </button>
  <div class="container">
    <div class="position-relative">
      <input type="text" class="form-control py-16 px-24 text-xl rounded-pill pe-64" placeholder="Search for a product or brand">
      <button type="submit" class="w-48 h-48 bg-main-600 rounded-circle flex-center text-xl text-white position-absolute top-50 translate-middle-y inset-inline-end-0 me-8">
        <i class="ph ph-magnifying-glass"></i>
      </button>
    </div>
  </div>
 </form>
<!-- ==================== Search Box End Here ==================== -->

@php
    $categoryStable = $categoryStable ?? 'd-none';
    $categoryHover = $categoryHover ?? 'd-block';
    $breadcrumbClass = $breadcrumbClass ?? 'bg-main-two-50';
    $pageTitle = $pageTitle ?? 'Checkout';
    $pageText = $pageText ?? 'Checkout';
    $section_margin = $section_margin ?? 'mb-24';
    $itemClass = $itemClass ?? 'bg-main-50';
    $iconClass = $iconClass ?? 'bg-main-600';
@endphp

@include('frontend.partials.marketpro.header-middle-two')
@include('frontend.partials.marketpro.header-two')
@include('frontend.partials.marketpro.breadcrumb-two')

@yield('content')

@include('frontend.partials.marketpro.shipping')
@include('frontend.partials.marketpro.footer-two')

<!-- Jquery js -->
<script src="{{ asset('marketpro_php/assets/js/jquery-3.7.1.min.js') }}"></script>
<!-- Bootstrap Bundle Js -->
<script src="{{ asset('marketpro_php/assets/js/boostrap.bundle.min.js') }}"></script>
<!-- Bootstrap Bundle Js -->
<script src="{{ asset('marketpro_php/assets/js/phosphor-icon.js') }}"></script>
<!-- Select 2 -->
<script src="{{ asset('marketpro_php/assets/js/select2.min.js') }}"></script>
<!-- Slick js -->
<script src="{{ asset('marketpro_php/assets/js/slick.min.js') }}"></script>
<!-- count down js -->
<script src="{{ asset('marketpro_php/assets/js/count-down.js') }}"></script>
<!-- jquery UI js -->
<script src="{{ asset('marketpro_php/assets/js/jquery-ui.js') }}"></script>
<!-- wow js -->
<script src="{{ asset('marketpro_php/assets/js/wow.min.js') }}"></script>
<!-- AOS Animation -->
<script src="{{ asset('marketpro_php/assets/js/aos.js') }}"></script>
<!-- marque -->
<script src="{{ asset('marketpro_php/assets/js/marque.min.js') }}"></script>
<!-- marque -->
<script src="{{ asset('marketpro_php/assets/js/vanilla-tilt.min.js') }}"></script>
<!-- Counter -->
<script src="{{ asset('marketpro_php/assets/js/counter.min.js') }}"></script>
<!-- main js -->
<script src="{{ asset('marketpro_php/assets/js/main.js') }}"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('script')

</body>
</html>
