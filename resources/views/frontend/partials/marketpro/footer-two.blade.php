@php
$footerMenus = [
    'About us' => [
        'Company Profile',
        'All Retail Store',
        'Merchant Center',
        'Affiliate',
        'Contact Us',
        'Feedback',
        'Huawei Group',
        'Rules & Policy'
    ],
    'Customer Support' => [
        'Help Center',
        'Contact Us',
        'Gift Card',
        'Report Abuse',
        'Submit and Dispute',
        'Policies & Rules',
        'Online Shopping',
        'Redeem Voucher'
    ],
    'My Account' => [
        'My Account',
        'Order History',
        'Shoping Cart',
        'Compare',
        'Help Ticket',
        'Wishlist',
        'Product Support'
    ],
    'Information' => [
        'Become a Vendor',
        'Affiliate Program',
        'Privacy Policy',
        'Our Suppliers',
        'Extended Plan',
        'Community'
    ]
];
@endphp
<!-- ==================== Footer Two Start Here ==================== -->
<footer class="footer py-80 overflow-hidden">
    <div class="container container-lg">
        <div class="footer-item-two-wrapper d-flex align-items-start flex-wrap">
            <div class="footer-item max-w-275" data-aos="fade-up" data-aos-duration="200">
                <div class="footer-item__logo">
                    <a href="{{ route('home') }}"> <img src="{{ asset('marketpro_php/assets/images/logo/logo-two-black.png') }}" alt=""></a>
                </div>
                <p class="mb-24">Marketpro become the largest computer parts, gaming pc parts, and other IT related products.</p>
                <div class="flex-align gap-16 mb-16">
                    <span class="w-32 h-32 flex-center rounded-circle border border-gray-100 text-main-two-600 text-md flex-shrink-0"><i class="ph-fill ph-phone-call"></i></span>
                    <a href="tel:+00123456789" class="text-md text-gray-900 hover-text-main-600">+00 123 456 789</a>
                </div>
                <div class="flex-align gap-16 mb-16">
                    <span class="w-32 h-32 flex-center rounded-circle border border-gray-100 text-main-two-600 text-md flex-shrink-0"><i class="ph-fill ph-envelope"></i></span>
                    <a href="mailto:support24@marketpro.com" class="text-md text-gray-900 hover-text-main-600">support24@marketpro.com</a>
                </div>
                <div class="flex-align gap-16 mb-16">
                    <span class="w-32 h-32 flex-center rounded-circle border border-gray-100 text-main-two-600 text-md flex-shrink-0"><i class="ph-fill ph-map-pin"></i></span>
                    <span class="text-md text-gray-900">789 Inner Lane, California, USA</span>
                </div>
            </div>

            @php $animationDuration = 400; @endphp
            @foreach($footerMenus as $title => $links)
                <div class="footer-item" data-aos="fade-up" data-aos-duration="{{ $animationDuration }}">
                    <h6 class="footer-item__title">{{ $title }}</h6>
                    <ul class="footer-menu">
                        @foreach($links as $index => $link)
                            <li class="{{ $index !== array_key_last($links) ? 'mb-16' : '' }}">
                                <a href="#" class="text-gray-600 hover-text-main-600">{{ $link }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @php $animationDuration += 200; @endphp
            @endforeach

            <div class="footer-item" data-aos="fade-up" data-aos-duration="1200">
                <h6 class="">Shop on The Go</h6>
                <p class="mb-16">Marketpro App is available. Get it now</p>
                <div class="flex-align gap-8 my-32">
                    <a href="https://www.apple.com/store" class="">
                        <img src="{{ asset('marketpro_php/assets/images/thumbs/store-img1.png') }}" alt="">
                    </a>
                    <a href="https://play.google.com/store/apps?hl=en" class="">
                        <img src="{{ asset('marketpro_php/assets/images/thumbs/store-img2.png') }}" alt="">
                    </a>
                </div>

                <ul class="flex-align gap-16">
                    <li>
                        <a href="https://www.facebook.com" class="w-44 h-44 flex-center bg-main-two-50 text-main-two-600 text-xl rounded-8 hover-bg-main-two-600 hover-text-white">
                            <i class="ph-fill ph-facebook-logo"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.twitter.com" class="w-44 h-44 flex-center bg-main-two-50 text-main-two-600 text-xl rounded-8 hover-bg-main-two-600 hover-text-white">
                            <i class="ph-fill ph-twitter-logo"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com" class="w-44 h-44 flex-center bg-main-two-50 text-main-two-600 text-xl rounded-8 hover-bg-main-two-600 hover-text-white">
                            <i class="ph-fill ph-instagram-logo"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.pinterest.com" class="w-44 h-44 flex-center bg-main-two-50 text-main-two-600 text-xl rounded-8 hover-bg-main-two-600 hover-text-white">
                            <i class="ph-fill ph-linkedin-logo"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- bottom Footer -->
<div class="bottom-footer bg-color-three py-8">
    <div class="container container-lg">
        <div class="bottom-footer__inner flex-between flex-wrap gap-16 py-16">
            <p class="bottom-footer__text wow fadeInLeftBig">Marketpro eCommerce &copy; {{ date('Y') }}. All Rights Reserved </p>
            <div class="flex-align gap-8 flex-wrap wow fadeInRightBig">
                <span class="text-heading text-sm">We Are Accepting</span>
                <img src="{{ asset('marketpro_php/assets/images/thumbs/payment-method.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- ==================== Footer Two End Here ==================== -->
