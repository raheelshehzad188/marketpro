@extends('frontend.layouts.master')
@section('title', 'Home')

@section('content')

@include('frontend.partials.home-sections.banner')
@include('frontend.partials.home-sections.feature')
@include('frontend.partials.home-sections.marketing-banners')
@include('frontend.partials.home-sections.bottom-banners')
@include('frontend.partials.home-sections.promotional-banner')
@include('frontend.partials.home-sections.flash-sales')
@include('frontend.partials.home-sections.newsletter-new')

@endsection

@section('script')
<script>
    window.addEventListener('load', function() {
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.slick !== 'undefined') {
            // Banner slider
            jQuery('.banner-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                arrows: true,
                prevArrow: jQuery('#banner-prev'),
                nextArrow: jQuery('#banner-next'),
                dots: true,
                fade: true,
                cssEase: 'linear'
            });
            
            // Feature slider
            jQuery('.feature-item-wrapper').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                prevArrow: jQuery('#feature-item-wrapper-prev'),
                nextArrow: jQuery('#feature-item-wrapper-next'),
                dots: false,
                responsive: [
                    { breakpoint: 1200, settings: { slidesToShow: 5 } },
                    { breakpoint: 992, settings: { slidesToShow: 4 } },
                    { breakpoint: 768, settings: { slidesToShow: 3 } },
                    { breakpoint: 576, settings: { slidesToShow: 2 } }
                ]
            });
            
            // Flash Sales slider (Product slider)
            jQuery('#flash-sales-slider').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true,
                prevArrow: jQuery('#flash-sales-prev'),
                nextArrow: jQuery('#flash-sales-next'),
                dots: false,
                responsive: [
                    { breakpoint: 1200, settings: { slidesToShow: 5 } },
                    { breakpoint: 992, settings: { slidesToShow: 4 } },
                    { breakpoint: 768, settings: { slidesToShow: 3 } },
                    { breakpoint: 576, settings: { slidesToShow: 2 } }
                ]
            });
            
            // Hot deals slider
            jQuery('.hot-deals-slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2500,
                arrows: true,
                prevArrow: jQuery('#deals-prev'),
                nextArrow: jQuery('#deals-next'),
                dots: false,
                responsive: [
                    { breakpoint: 992, settings: { slidesToShow: 2 } },
                    { breakpoint: 768, settings: { slidesToShow: 1 } }
                ]
            });
            
            // Brand slider
            jQuery('.brand-slider').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: true,
                prevArrow: jQuery('#brand-prev'),
                nextArrow: jQuery('#brand-next'),
                dots: false,
                responsive: [
                    { breakpoint: 1200, settings: { slidesToShow: 5 } },
                    { breakpoint: 992, settings: { slidesToShow: 4 } },
                    { breakpoint: 768, settings: { slidesToShow: 3 } },
                    { breakpoint: 576, settings: { slidesToShow: 2 } }
                ]
            });
            
            // Short product list slider
            jQuery('.short-product-list').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: false,
                dots: false,
                vertical: true,
                verticalSwiping: true
            });
        }
        
        // Initialize countdowns
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.countdown !== 'undefined') {
            jQuery('[id^="countdown"]').each(function() {
                var $this = jQuery(this);
                var targetDate = new Date();
                targetDate.setDate(targetDate.getDate() + 35);
                $this.countdown(targetDate, function(event) {
                    $this.find('.days').text(event.strftime('%D'));
                    $this.find('.hours').text(event.strftime('%H'));
                    $this.find('.minutes').text(event.strftime('%M'));
                    $this.find('.seconds').text(event.strftime('%S'));
                });
            });
        }
    });
</script>
@endsection
