<header class="bg-2 d-block d-lg-none pt-2 pb-2 d-print-none">
    <div class="container">
        <div class="mobile-top row">
            <div class="col-12 text-center top-nav">
                <ul class="list-inline mb-0">
                    @if (!Auth::guest())
                        <li class="list-inline-item mr-5 login">
                            <a href="{{ route('dashboard') }}"
                                class="py-2 d-inline-block text-white">{{ translate('My Account') }}</a>
                        </li>
                    @else
                        <li class="list-inline-item mr-5 login">
                            <a href="{{ route('user.login') }}"
                                class="py-2 d-inline-block text-white">{{ translate('Login') }}</a>
                        </li>
                    @endif
                    <li class="list-inline-item start">
                        <a href="{{ route('start_project') }}"
                            class="py-2 d-inline-block hover-blue btn-rounded text-capitalize">{{ translate('Start my project') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<header class="main-nav z-1020">
    <div class="mobile-nav d-block d-lg-none">
        <div class="m-logo">
            <a class="" href="{{ route('home') }}">
                @php
                    $header_logo = get_setting('header_logo');
                @endphp
                <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"
                    class="m-100" height="45">
            </a>
        </div>
        <nav class="mean-menu">
            <ul style="display: none">
                <li><a href="">How it works</a></li>
                <li><a href="">packages</a></li>
                <li><a href="">reviews</a></li>
                <li><a href="">portfolio</a></li>
                <li><a href="">Style Quiz</a></li>
                <li>
                    <a href="">Resources</a>
                    <ul>
                        <li><a href="">Rebate</a></li>
                        <li><a href="">Water savings</a></li>
                        <li><a href="">Events</a></li>
                        <li><a href="">Blog</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

    <div class=" logo-bar-area bg-white">
        <div class="container position-relative">


            <div class="d-lg-flex d-none align-items-center ">
                <div class="col-auto col-lg-2 pl-0 logo">
                    <a class="d-block py-20px mr-3 ml-0" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if ($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"
                                class="d-logo">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"
                                class="d-logo">
                        @endif
                    </a>
                </div>
                <div class="col-xl-8">
                    <nav class="navbar navbar-expand-lg pl-0 pr-0">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('how_ite_works') }}">How it works</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('packages') }}">packages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('client-reviews') }}">reviews</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('portfolio') }}">portfolio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('style_quiz') }}">Style Quiz</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button">
                                        Resources
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="nav-link" href="{{ route('rebates') }}">Rebate</a>
                                        <a class="nav-link" href="{{ route('water_savings') }}">Water
                                            savings</a>
                                        <a class="nav-link" href="{{ route('blogs') }}">Blog</a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-auto text-right top-nav">
                    <ul class="list-inline mb-0">
                        @if (!Auth::guest())
                            <li class="list-inline-item mr-3">
                                <a href="{{ route('dashboard') }}"
                                    class="py-2 d-inline-block">{{ translate('My Account') }}</a>
                            </li>
                            <li class="list-inline-item start">
                                <a href="{{ route('start_project') }}"
                                    class="py-2 d-inline-block btn-rounded text-capitalize">{{ translate('Start my project') }}</a>
                            </li>
                        @else
                            <li class="list-inline-item mr-3">
                                <a href="{{ route('user.login') }}"
                                    class="py-2 d-inline-block">{{ translate('Login') }}</a>
                            </li>
                            <li class="list-inline-item start">
                                <a href="{{ route('start_project') }}"
                                    class="py-2 d-inline-block hover-blue btn-rounded text-capitalize">{{ translate('Start my project') }}</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>
    </div>
</header>
