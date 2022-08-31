@extends('frontend.layouts.app')
@section('content')
    <section class="py-5 mt-5  mt-lg-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    @include('frontend.inc.user_side_nav')
                </div>

                <div class="aiz-user-panel col-md-8 col-lg-9">
                    @yield('panel_content')
                </div>
            </div>
        </div>
    </section>
@endsection
