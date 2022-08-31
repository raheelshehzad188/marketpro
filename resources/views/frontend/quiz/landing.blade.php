@extends('frontend.layouts.app')

@section('content')



    <div class="d-block  packages-banner-area   bg-no-repeat  bg-cover bg-center lazyload"
        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
        data-bg="{{ uploaded_asset($page->banner) }}">
        <div class="container-fluid ps-0 pe-0">
            <div class="row position-relative">
                <div class="col-md-12 text-white text-shadow fw-800">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ uploaded_asset($page->banner) }}" class="w-100 lazyload invisible">
                    <div class="container text-center">
                        <div class="banner-content">
                            <h1 class=" lh-1-1 px-5 w-100">{{ $page->title }}</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <section class="bg-3">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto text-center mt-5 pt-3  pb-3">
                    <div class="section-heading fs-30  px-5 lh-1-2 mb-3">Take Our Fast &amp; Free Style Quiz to Help
                        Determine
                        What Kind of Garden is Right for You
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-5 pb-3">
                    <a href="{{ route('start_style_quiz') }}" class="btn btn-primary  ff-bold fs-20 btn-rounded px-5">TAKE
                        THE QUIZ</a>
                </div>
            </div>
        </div>
    </section>


    @if (get_setting('template_content11_images') != null)
        @php
            $i = 0;
        @endphp
        @foreach (json_decode(get_setting('template_content11_images'), true) as $key => $value)
            @if ($i % 2 == 0)
                <section class="my-5">
                    <div class="container">
                        <div class="row align-items-center g-5">
                            <div class="col-md-6">
                                <div class="text-start h-100 left p-xxl-8">
                                    <div class="fs-30 px-5 lh-1-2 mb-3">
                                        {{ json_decode(get_setting('template_content11_title'), true)[$key] }}
                                    </div>
                                    <div class="detail fs-16 mb-4  px-5 fw-500">
                                        {{ json_decode(get_setting('template_content11_desc'), true)[$key] }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="bg-no-repeat bg-cover bg-center lazyload h-100"
                                    style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                    data-bg="{{ uploaded_asset(json_decode(get_setting('template_content11_images'), true)[$key]) }}">
                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        class="img-fluid lazyload invisible"
                                        data-src="{{ static_asset('assets/img/take-quiz1.jpg') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <section class="my-5">
                    <div class="container">
                        <div class="row align-items-center g-5">
                            <div class="col-md-6">
                                <div class="bg-no-repeat bg-cover bg-center lazyload h-100"
                                    style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                    data-bg="{{ uploaded_asset(json_decode(get_setting('template_content11_images'), true)[$key]) }}">
                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        class="img-fluid lazyload invisible"
                                        data-src="{{ static_asset('assets/img/take-quiz2.jpg') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-start h-100 left p-xxl-8">

                                    <div class="fs-30 px-5 lh-1-2 mb-3">
                                        {{ json_decode(get_setting('template_content11_title'), true)[$key] }}
                                    </div>
                                    <div class="detail fs-16 mb-4  px-5 fw-500">
                                        {{ json_decode(get_setting('template_content11_desc'), true)[$key] }}
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </section>
            @endif

            @php
                $i++;
            @endphp
        @endforeach
    @endif




    <section class=" mt-5 bg-3">
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="section-heading text-center fs-32 mb-4 mt-5">
                        Popular Design Styles
                    </div>
                </div>
            </div>
            <div class="row">

                @if (get_setting('poplar_design11_images') != null)
                    @foreach (json_decode(get_setting('poplar_design11_images'), true) as $key => $value)
                        <div class="col-sm-6 col-md-4 mx-auto mb-4 mb-md-5 text-center">
                            <div class="d-block shadow bg-no-repeat  bg-cover bg-center lazyload"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ uploaded_asset(json_decode(get_setting('poplar_design11_images'), true)[$key]) }}">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/take-quiz5.jpg') }}"
                                    class="img-fluid invisible lazyload">
                            </div>
                            <div class="ff-bold text-dark fs-16 lh-1-2 mt-4 d-block">{{ json_decode(get_setting('poplar_design11_title'), true)[$key] }}</div>
                            <div class="text-dark fs-16 lh-1-2 mt-2 d-block">{{ json_decode(get_setting('poplar_design11_desc'), true)[$key] }}</div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

    <section class="bg-1">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5 pt-5 pb-3">
                    <div class="section-heading fs-32  px-5 text-white">Ready to Get Started?
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-5 pb-5">
                    <a href="{{ route('start_style_quiz') }}"
                        class="btn btn-primary bg-white color-2 ff-bold fs-20 btn-rounded px-5">TAKE THE QUIZ</a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>

    </script>
@endsection
