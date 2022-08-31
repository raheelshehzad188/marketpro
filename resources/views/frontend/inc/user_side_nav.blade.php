<div class="position-relative z-1 shadow-sm">
    <div class="aiz-user-sidenav rounded overflow-auto c-scrollbar-light pb-5 pb-xl-0">
        <div class="p-4 text-xl-center mb-4 border-bottom bg-primary text-white position-relative">

            <h4 class="h5 fs-16 mb-1 fw-600">{{ Auth::user()->name }}</h4>
            @if (Auth::user()->phone != null)
                <div class="text-truncate opacity-60">{{ Auth::user()->phone }}</div>
            @else
                <div class="text-truncate opacity-60">{{ Auth::user()->email }}</div>
            @endif
        </div>

        <div class="sidemnenu mb-3">
            <ul class="aiz-side-nav-list px-2" data-toggle="aiz-side-menu">

                <li class="aiz-side-nav-item">
                    <a href="{{ route('dashboard') }}" class="aiz-side-nav-link {{ areActiveRoutes(['dashboard']) }}">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Dashboard') }}</span>
                    </a>
                </li>



                @php
                    $delivery_viewed = App\Order::where('user_id', Auth::user()->id)
                        ->where('delivery_viewed', 0)
                        ->get()
                        ->count();
                    $payment_status_viewed = App\Order::where('user_id', Auth::user()->id)
                        ->where('payment_status_viewed', 0)
                        ->get()
                        ->count();
                @endphp
                <li class="aiz-side-nav-item">
                    <a href="{{ route('purchase_history.index') }}"
                        class="aiz-side-nav-link {{ areActiveRoutes(['purchase_history.index']) }}">
                        <i class="las la-file-alt aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Purchase History') }}</span>
                        @if ($delivery_viewed > 0 || $payment_status_viewed > 0)
                            <span class="badge badge-inline badge-success">{{ translate('New') }}</span>
                        @endif
                    </a>
                </li>


                @if (Auth::user()->user_type == 'seller')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('seller.products') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['seller.products', 'seller.products.upload', 'seller.products.edit']) }}">
                            <i class="lab la-sketch aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Products') }}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('product_bulk_upload.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['product_bulk_upload.index']) }}">
                            <i class="las la-upload aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Product Bulk Upload') }}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('seller.digitalproducts') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['seller.digitalproducts', 'seller.digitalproducts.upload', 'seller.digitalproducts.edit']) }}">
                            <i class="lab la-sketch aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Digital Products') }}</span>
                        </a>
                    </li>
                    @if (addon_is_activated('auction'))
                        <li class="aiz-side-nav-item">
                            <a href="javascript:void(0);"
                                class="aiz-side-nav-link {{ areActiveRoutes(['auction_products.seller.index']) }}">
                                <i class="las la-gavel aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text">{{ translate('Auction products') }}</span>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('auction_products.seller.index') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['auction_products.seller.index', 'auction_products.create', 'auction_products.edit']) }}">
                                        <span
                                            class="aiz-side-nav-text">{{ translate('All Auction Products') }}</span>
                                    </a>
                                </li>
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('auction_products_orders.seller') }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['auction_products_orders.seller']) }}">
                                        <span
                                            class="aiz-side-nav-text">{{ translate('Auction Product Orders') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('my_uploads.all') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['my_uploads.new']) }}">
                            <i class="las la-folder-open aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Uploaded Files') }}</span>
                        </a>
                    </li>
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('seller.coupon.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['my_uploads.new']) }}">
                            <i class="las la-bullhorn aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Coupon') }}</span>
                        </a>
                    </li>
                @endif


                <li class="aiz-side-nav-item">
                    <a href="{{ route('profile') }}"
                        class="aiz-side-nav-link {{ areActiveRoutes(['profile']) }}">
                        <i class="las la-user aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Manage Profile') }}</span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="{{ route('logout') }}"
                        class="aiz-side-nav-link">
                        <i class="las la-sign-out-alt  aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Logout') }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
