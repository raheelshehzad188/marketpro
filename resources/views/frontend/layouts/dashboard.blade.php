<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.partials.head')
</head>

<body>
    @include('frontend.partials.header')

    <div role="main" class="main shop pb-4">

        <div class="container">
            <div class="row margin-50">
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                        <li><a href="#">Home</a></li>
                        <li><a href="#"> Account</a></li>
                        <li><a href="#"> User Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="container pt-5 pb-2">

            <div class="row pt-2">
                <div class="col-lg-3 mt-4 mt-lg-0">

                        @include('frontend.partials.sidebar')

                </div>
                
    @yield('content')
            </div>

        </div>

    
    @include('frontend.partials.instagram')
    </div>
    @include('frontend.partials.footer')
    @include('frontend.partials.foot')
    @yield('script')
</body>

</html>
