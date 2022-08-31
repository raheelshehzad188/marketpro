@extends('frontend.layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="d-block">
                    <div class="container-fluid ps-0 pe-0 py-3 py-lg-5">
                        <div class="row position-relative">
                            <div class="col-md-12  text-shadow fw-800">
                                <div class="container text-center">
                                    <div class="title-content">
                                        <h1 class=" lh-1-1 px-3 px-lg-5 w-100 py-3">{{ $portfolio->title }}</h1>
                                        <div class="ff-bold fs-16">
                                            {{ date('M d, Y', strtotime($portfolio->created_at)) }}
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
                                    data-bg="{{ uploaded_asset($portfolio->banner) }}">
                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ static_asset('assets/img/portfolio-detail.jpg') }}"
                                        class="img-fluid invisible lazyload">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="fs-16 fw-500">
                                    {{ $portfolio->short_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                @php
                    $i = 0;
                @endphp
                @if (json_decode($portfolio->example, true) != null)
                    @foreach (json_decode($portfolio->example, true)['image'] as $key => $value)
                        @if ($i % 2 == 0)
                            <section class="casestudy mt-5">
                                <div class="container">
                                    <div class="row">

                                        <div class="col-md-5">
                                            <div class=" text-start h-100 pe-5">

                                                <div class="fs-16 ff-bold ">
                                                    {{ json_decode($portfolio->example, true)['before'][$key] }}
                                                </div>
                                                <div class="detail fs-16 mb-4   fw-500">
                                                    {{ json_decode($portfolio->example, true)['before_description'][$key] }}
                                                </div>
                                                <div class="fs-16 ff-bold ">
                                                    {{ json_decode($portfolio->example, true)['after'][$key] }}
                                                </div>
                                                <div class="detail fs-16 mb-4  fw-500">
                                                    {{ json_decode($portfolio->example, true)['after_description'][$key] }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="bg-no-repeat bg-cover bg-center lazyload h-100"
                                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                                data-bg="{{ uploaded_asset(json_decode($portfolio->example, true)['image'][$key]) }}">
                                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    class="img-fluid lazyload invisible"
                                                    data-src="{{ static_asset('assets/img/portfolio-detail2.jpg') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @else

                            <section class="casestudy mt-5">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-7 order-2 order-md-1">
                                            <div class="bg-no-repeat bg-cover bg-center lazyload h-100"
                                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                                data-bg="{{ uploaded_asset(json_decode($portfolio->example, true)['image'][$key]) }}">
                                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    class="img-fluid lazyload invisible"
                                                    data-src="{{ static_asset('assets/img/portfolio-detail3.jpg') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-5 order-1">
                                            <div class=" text-end h-100 ps-5">
                                                <div class="fs-16 ff-bold ">
                                                    {{ json_decode($portfolio->example, true)['before'][$key] }}
                                                </div>
                                                <div class="detail fs-16 mb-4   fw-500">
                                                    {{ json_decode($portfolio->example, true)['before_description'][$key] }}
                                                </div>
                                                <div class="fs-16 ff-bold ">
                                                    {{ json_decode($portfolio->example, true)['after'][$key] }}
                                                </div>
                                                <div class="detail fs-16 mb-4  fw-500">
                                                    {{ json_decode($portfolio->example, true)['after_description'][$key] }}
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


                <section class=" mt-5">
                    <div class="container">
                        <div class="row">
                            @if (json_decode($portfolio->more_images, true) != null)
                                @foreach (json_decode($portfolio->more_images, true)['image'] as $key => $value)
                                    <div class="col-sm-6 col-md-4 mx-auto mb-4 mb-md-5 text-center">
                                        <div class="d-block shadow bg-no-repeat  bg-cover bg-center lazyload"
                                            style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                            data-bg="{{ uploaded_asset(json_decode($portfolio->more_images, true)['image'][$key]) }}">
                                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ static_asset('assets/img/portfolio-detail4.jpg') }}"
                                                class="img-fluid invisible lazyload">
                                        </div>
                                        <div class="ff-bold text-dark fs-16 lh-1-2 mt-2 d-block">{{json_decode($portfolio->more_images, true)['caption'][$key]}}</div>
                                    </div>
                                @endforeach
                            @endif
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
                    <a href="{{route('start_project')}}" class="btn btn-primary  ff-bold fs-20 btn-rounded px-5">START YOUR PROJECT</a>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('script')

@endsection
