@php
    // Get footer navigation from database
    $footerNavigation = get_setting('footer_navigation');
    $footerMenus = [];
    
    if (!empty($footerNavigation)) {
        $footerMenus = json_decode($footerNavigation, true);
    }
    
    // If no footer navigation found, use default
    if (empty($footerMenus) || !is_array($footerMenus)) {
        $footerMenus = [
            'Information' => [
                'Become a Vendor' => '#',
                'Affiliate Program' => '#',
                'Privacy Policy' => route('terms-and-conditions'),
                'Our Suppliers' => '#',
                'Extended Plan' => '#',
                'Community' => '#',
            ],
            'Customer Support' => [
                'Help Center' => '#',
                'Contact Us' => url('/contact'),
                'Report Abuse' => '#',
                'Submit and Dispute' => '#',
                'Policies & Rules' => '#',
                'Online Shopping' => route('products.listing'),
            ],
            'My Account' => [
                'My Account' => route('my-account'),
                'Order History' => route('orders'),
                'Shopping Cart' => route('basket'),
                'Compare' => '#',
                'Help Ticket' => '#',
                'Wishlist' => url('/wishlist'),
            ]
        ];
    }
    
    // Get footer description and contact info
    $footerDescription = get_setting('footer_description', "We're Grocery Shop, an innovative team of food suppliers.");
    $footerAddress = get_setting('contact_address', get_setting('footer_address', '2972 Westheimer Rd. Santa Ana, Illinois 85486'));
    $footerEmail = get_setting('contact_email', 'support@example.com');
    $footerPhone = get_setting('contact_phone', '+ (406) 555-0120');
    
    // Get footer logo
    $footerLogo = get_setting('footer_logo');
    $footerLogoUrl = $footerLogo ? uploaded_asset($footerLogo) : static_asset('frontend/img/logo-default.png');
    $websiteName = get_setting('site_name', 'MarketPro');
@endphp

<!-- ==================== Footer Start Here ==================== -->
<footer class="footer py-120">
    <div class="container container-lg">
        <div class="footer-item-wrapper d-flex align-items-start flex-wrap">
            <div class="footer-item" data-aos="fade-up" data-aos-duration="200">
                <div class="max-w-340">
                    <div class="footer-item__logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ $footerLogoUrl }}" alt="{{ $websiteName }}">
                        </a>
                    </div>
                    <p class="mb-28 text-heading">{{ $footerDescription }}</p>

                    <div class="d-flex flex-column gap-8">
                        @if (!empty($footerAddress))
                            <p class="text-heading fw-medium">{{ $footerAddress }}</p>
                        @endif
                        @if (!empty($footerEmail))
                            <a href="mailto:{{ $footerEmail }}" class="text-heading fw-medium hover-text-main-600">{{ $footerEmail }}</a>
                        @endif
                        @if (!empty($footerPhone))
                            <a href="tel:{{ $footerPhone }}" class="text-heading fw-medium hover-text-main-600">{{ $footerPhone }}</a>
                        @endif
                    </div>
                </div>
            </div>

            @php
                $duration = 400;
            @endphp
            @foreach ($footerMenus as $title => $links)
                <div class="footer-item" data-aos="fade-up" data-aos-duration="{{ $duration }}">
                    <h6 class="footer-item__title">{{ $title }}</h6>
                    <ul class="footer-menu">
                        @php
                            $lastKey = array_key_last($links);
                        @endphp
                        @foreach ($links as $text => $url)
                            @php
                                $isLast = ($text === $lastKey);
                            @endphp
                            <li class="{{ !$isLast ? 'mb-16' : '' }}">
                                <a href="{{ $url }}" class="text-heading hover-text-main-600">{{ $text }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @php
                    $duration += 200;
                @endphp
            @endforeach

            <div class="footer-item" data-aos="fade-up" data-aos-duration="1200">
                <h6 class="">Shop on The Go</h6>
                <p class="mb-16">{{ $websiteName }} App is available. Get it now</p>
                <div class="my-32">
                    <div class="flex-align gap-8">
                        <div class="bg-white rounded-10 p-1 box-shadow-5xl">
                            <img src="{{ static_asset('frontend/img/qr-code.png') }}" alt="QR Code">
                        </div>
                        <div class="d-flex flex-column gap-16">
                            <a href="https://www.apple.com/app-store" class="py-14 px-32 d-flex justify-content-center align-items-center gap-8 fw-medium text-heading text-sm hover-bg-main-600 hover-text-white box-shadow-6xl rounded-6">
                                <i class="ph-fill ph-apple-logo"></i>
                                App Store
                            </a>
                            <a href="https://play.google.com/store" class="py-14 px-32 d-flex justify-content-center align-items-center gap-8 fw-medium text-heading text-sm hover-bg-main-600 hover-text-white box-shadow-6xl rounded-6">
                                <img src="{{ static_asset('frontend/img/icons/google-play.svg') }}" alt="Play Store">
                                Google Play
                            </a>
                        </div>
                    </div>
                    <div class="mt-24">
                        <img src="{{ static_asset('frontend/img/payment-methods.png') }}" alt="Payment Methods">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- bottom Footer -->
<div class="bottom-footer py-8">
    <div class="container container-lg">
        <div class="bottom-footer__inner flex-between flex-wrap gap-16 py-16 border-top border-neutral-50">
            <p class="bottom-footer__text text-heading wow fadeInLeft fw-medium">Copyright &copy; <span class="text-success-600 fw-semibold">{{ date('Y') }}</span> {{ $websiteName }} All Rights Reserved </p>
            <div class="flex-align gap-8 flex-wrap wow fadeInRight">
                <ul class="flex-align gap-16">
                    @php
                        $facebook = get_setting('facebook_link', 'https://www.facebook.com');
                        $twitter = get_setting('twitter_link', 'https://www.twitter.com');
                        $instagram = get_setting('instagram_link', 'https://www.instagram.com');
                        $linkedin = get_setting('linkedin_link', 'https://www.linkedin.com');
                    @endphp
                    @if ($facebook)
                        <li>
                            <a href="{{ $facebook }}" class="w-44 h-44 flex-center bg-white shadow-sm text-main-600 text-xl rounded-circle hover-bg-main-600 hover-text-white">
                                <i class="ph-fill ph-facebook-logo"></i>
                            </a>
                        </li>
                    @endif
                    @if ($twitter)
                        <li>
                            <a href="{{ $twitter }}" class="w-44 h-44 flex-center bg-white shadow-sm text-main-600 text-xl rounded-circle hover-bg-main-600 hover-text-white">
                                <i class="ph-fill ph-twitter-logo"></i>
                            </a>
                        </li>
                    @endif
                    @if ($instagram)
                        <li>
                            <a href="{{ $instagram }}" class="w-44 h-44 flex-center bg-white shadow-sm text-main-600 text-xl rounded-circle hover-bg-main-600 hover-text-white">
                                <i class="ph-fill ph-instagram-logo"></i>
                            </a>
                        </li>
                    @endif
                    @if ($linkedin)
                        <li>
                            <a href="{{ $linkedin }}" class="w-44 h-44 flex-center bg-white shadow-sm text-main-600 text-xl rounded-circle hover-bg-main-600 hover-text-white">
                                <i class="ph-fill ph-linkedin-logo"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- ==================== Footer End Here ==================== -->

