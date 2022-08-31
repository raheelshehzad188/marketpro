@extends('frontend.layouts.app')

@section('meta_title'){{ $blog->meta_title }}@stop

@section('meta_description'){{ $blog->meta_description }}@stop

@section('meta_keywords'){{ $blog->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $blog->meta_title }}">
    <meta itemprop="description" content="{{ $blog->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $blog->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('blog.details', $blog->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->meta_img) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')
    <div class="container blog_detail">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="d-block">
                    <div class="container-fluid ps-0 pe-0 py-3 py-lg-5">
                        <div class="row position-relative">
                            <div class="col-md-12  text-shadow fw-800">
                                <div class="container text-center">
                                    <div class="title-content">
                                        <h1 class=" lh-1-1 px-3 px-lg-5 w-100 py-3">{{ $blog->title }}</h1>
                                        <div class="ff-bold fs-16">
                                            {{ date('M d, Y', strtotime($blog->created_at)) }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



                <section class="mt-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="d-block shadow bg-no-repeat  bg-cover bg-center lazyload"
                                    style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                    data-bg="{{ uploaded_asset($blog->banner) }}">
                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ static_asset('assets/img/portfolio-detail.jpg') }}"
                                        class="img-fluid invisible lazyload">
                                </div>
                            </div>
                        </div>

                    </div>
                </section>


                <section class="casestudy mt-1">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-4 overflow-hidden">
                                    {!! $blog->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <section class="bg-3 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5 pt-5 pb-3">
                    <div class="section-heading fs-32  px-5">Build a Beautiful, Water Efficient Garden.</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-5 pb-5">
                    <a href="{{ route('start_project') }}" class="btn btn-primary  ff-bold fs-20 btn-rounded px-5">START
                        YOUR
                        PROJECT</a>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    @if (get_setting('facebook_comment') == 1)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous"
                src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId={{ env('FACEBOOK_APP_ID') }}&autoLogAppEvents=1"
                nonce="ji6tXwgZ"></script>
    @endif
@endsection
