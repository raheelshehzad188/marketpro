<footer class="bg-5 py-sm-5 py-3 text-white">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-6  order-xl-1 mb-3">
                <div class="mt-4">
                    <a href="" class="d-block">
                        <img class="lazyload w-150px" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ static_asset('assets/img/footer-logo.png') }}" alt="{{ env('APP_NAME') }}">
                    </a>
                    <div class="my-4 fs-16">
                        © Water Efficient Gardens 2021,
                        All Rights Reserved.
                    </div>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item border-right pr-3 lh-1">
                            <a href="" class="text-white">Privacy Policy</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="" class="text-white">Terms of Service</a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-xl-2 col-md-4 ml-xl-auto col-md-4 mr-0 order-xl-2 order-md-3 mb-3">
                <div class=" mt-4">
                    <h4 class="fs-16 text-uppercase ff-bold  pb-2 mb-4">
                        COMPANY
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="" class="fs-15 text-white">
                                Gallery
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="" class="fs-15 text-white">
                                Log In
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('contact-us') }}" class="fs-15 text-white">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 order-xl-3 order-md-3 mb-3">
                <div class=" mt-4">
                    <h4 class="fs-16 text-uppercase ff-bold  pb-2 mb-4">
                        RESOURCES
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ translate('rebates') }}" class="fs-15 text-white">
                                Rebate
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ translate('water_savings') }}" class="fs-15 text-white">
                                Water Savings
                            </a>
                        </li>

                        <li class="mb-2">
                            <a href="{{ translate('blogs') }}" class="fs-15 text-white">
                                Blog
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 order-xl-4 order-lg-2 mb-3">
                <div class=" mt-4">
                    <h4 class="fs-16 text-uppercase ff-bold  pb-2 mb-4">
                        BE INFORMED
                    </h4>
                    <div class="my-3 fs-15">
                        Sign up for our mailing list to receive
                        newsletters on events, sustainability,
                        water conservation and more.
                    </div>
                    <div class="mt-4">
                        <div class="d-inline-block d-md-block mb-4">
                            <form class="form-inline" method="POST" action="{{ route('subscribers.store') }}">
                                @csrf
                                <div class="form-group mb-0 d-inline-block">
                                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary d-inline-block btn-rounded fs-14 text-uppercase ff-bold border border-width-2">
                                    {{ translate('Subscribe') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-1 col-md-4 text-md-right  pt-3 fs-30 order-xl-5 order-md-4 mb-3 social">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href=""><i class="lab la-instagram text-white"></i></a>
                    </li>
                    <li class="mb-2">
                        <a href=""><i class="lab la-twitter text-white"></i></a>
                    </li>
                    <li class="mb-2">
                        <a href=""><i class="lab la-facebook-f text-white"></i></a>
                    </li>
                    <li class="mb-2">
                        <a href=""><i class="lab la-pinterest text-white"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>




{{--
@if (Auth::check() && !isAdmin())
    <div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top"
        style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
        <div class="row align-items-center gutters-5">
            <div class="col">
                <a href="{{ route('home') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <i
                        class="las la-home fs-20 opacity-60 {{ areActiveRoutes(['home'], 'opacity-100 text-primary') }}"></i>
                    <span
                        class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['home'], 'opacity-100 fw-600') }}">{{ translate('Home') }}</span>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('categories.all') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <i
                        class="las la-list-ul fs-20 opacity-60 {{ areActiveRoutes(['categories.all'], 'opacity-100 text-primary') }}"></i>
                    <span
                        class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['categories.all'], 'opacity-100 fw-600') }}">{{ translate('Categories') }}</span>
                </a>
            </div>
            @php
                if (auth()->user() != null) {
                    $user_id = Auth::user()->id;
                    $cart = \App\Cart::where('user_id', $user_id)->get();
                } else {
                    $temp_user_id = Session()->get('temp_user_id');
                    if ($temp_user_id) {
                        $cart = \App\Cart::where('temp_user_id', $temp_user_id)->get();
                    }
                }
            @endphp
            <div class="col-auto">
                <a href="{{ route('cart') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span
                        class="align-items-center bg-primary border border-white border-width-4 d-flex justify-content-center position-relative rounded-circle size-50px"
                        style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                        <i class="las la-shopping-bag la-2x text-white"></i>
                    </span>
                    <span
                        class="d-block mt-1 fs-10 fw-600 opacity-60 {{ areActiveRoutes(['cart'], 'opacity-100 fw-600') }}">
                        {{ translate('Cart') }}
                        @php
                            $count = isset($cart) && count($cart) ? count($cart) : 0;
                        @endphp
                        (<span class="cart-count">{{ $count }}</span>)
                    </span>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('all-notifications') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-inline-block position-relative px-2">
                        <i
                            class="las la-bell fs-20 opacity-60 {{ areActiveRoutes(['all-notifications'], 'opacity-100 text-primary') }}"></i>
                        @if (Auth::check() && count(Auth::user()->unreadNotifications) > 0)
                            <span
                                class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right"
                                style="right: 7px;top: -2px;"></span>
                        @endif
                    </span>
                    <span
                        class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['all-notifications'], 'opacity-100 fw-600') }}">{{ translate('Notifications') }}</span>
                </a>
            </div>
            <div class="col">
                @if (Auth::check())
                    @if (isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-reset d-block text-center pb-2 pt-3">
                            <span class="d-block mx-auto">
                                @if (Auth::user()->photo != null)
                                    <img src="{{ custom_asset(Auth::user()->avatar_original) }}"
                                        class="rounded-circle size-20px">
                                @else
                                    <img src="{{ static_asset('assets/img/avatar-place.png') }}"
                                        class="rounded-circle size-20px">
                                @endif
                            </span>
                            <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
                        </a>
                    @else
                        <a href="javascript:void(0)"
                            class="text-reset d-block text-center pb-2 pt-3 mobile-side-nav-thumb"
                            data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav">
                            <span class="d-block mx-auto">
                                @if (Auth::user()->photo != null)
                                    <img src="{{ custom_asset(Auth::user()->avatar_original) }}"
                                        class="rounded-circle size-20px">
                                @else
                                    <img src="{{ static_asset('assets/img/avatar-place.png') }}"
                                        class="rounded-circle size-20px">
                                @endif
                            </span>
                            <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
                        </a>
                    @endif
                @else
                    <a href="{{ route('user.login') }}" class="text-reset d-block text-center pb-2 pt-3">
                        <span class="d-block mx-auto">
                            <img src="{{ static_asset('assets/img/avatar-place.png') }}"
                                class="rounded-circle size-20px">
                        </span>
                        <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">
        <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static"
            data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
        <div class="collapse-sidebar bg-white">
            @include('frontend.inc.user_side_nav')
        </div>
    </div>
@endif --}}
