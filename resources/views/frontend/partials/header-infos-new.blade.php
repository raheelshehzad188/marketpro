@php
    $phoneNumber = get_setting('contact_phone', '+(2) 871 382 023');
    // Get cart count
    $cartCount = 0;
    try {
        if(auth()->check()) {
            $cartCount = \App\Cart::where('user_id', auth()->id())->count();
        } else {
            $cart = session('cart', []);
            $cartCount = is_array($cart) ? count($cart) : 0;
        }
    } catch(\Exception $e) {
        $cartCount = 0;
    }
    // Get wishlist count (if wishlist feature exists)
    $wishlistCount = 0;
@endphp

<div class="flex-align gap-20">
    <button type="button" class="search-icon flex-align d-lg-none d-flex gap-4 item-hover">
        <span class="text-2xl text-gray-700 d-flex position-relative item-hover__text">
            <i class="ph ph-magnifying-glass"></i>
        </span>
    </button>
    @auth
        <a href="{{ route('my-account') }}" class="flex-align gap-4 item-hover" title="My Account">
            <span class="text-xl text-gray-700 d-flex position-relative item-hover__text">
                <i class="ph ph-user"></i>
            </span>
            <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Profile</span>
        </a>
    @else
        <a href="{{ route('shop.login') }}" class="flex-align gap-4 item-hover" title="Login">
            <span class="text-xl text-gray-700 d-flex position-relative item-hover__text">
                <i class="ph ph-user"></i>
            </span>
            <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Login</span>
        </a>
    @endauth
    <a href="{{ url('/wishlist') }}" class="flex-align gap-4 item-hover" title="Wishlist">
        <span class="text-xl text-gray-700 d-flex position-relative me-6 mt-6 item-hover__text">
            <i class="ph ph-heart"></i>
            @if($wishlistCount > 0)
                <span class="w-16 h-16 flex-center rounded-circle bg-main-600 text-white text-xs position-absolute top-n6 end-n4 wishlist-count">{{ $wishlistCount }}</span>
            @endif
        </span>
        <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Wishlist</span>
    </a>
    <a href="{{ route('basket') }}" class="flex-align gap-4 item-hover" title="Shopping Cart">
        <span class="text-xl text-gray-700 d-flex position-relative me-6 mt-6 item-hover__text">
            <i class="ph ph-shopping-cart-simple"></i>
            @if($cartCount > 0)
                <span class="w-16 h-16 flex-center rounded-circle bg-main-600 text-white text-xs position-absolute top-n6 end-n4 cart-qty">{{ $cartCount }}</span>
            @endif
        </span>
        <span class="text-md text-heading-three item-hover__text d-none d-lg-flex">Cart</span>
    </a>
</div>

