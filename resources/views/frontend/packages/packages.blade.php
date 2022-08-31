@extends('frontend.layouts.app')

@section('content')
    <div class="d-block  packages-banner-area   bg-no-repeat  bg-cover bg-center lazyload"
        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
        data-bg="{{ static_asset('assets/img/packages-banner.jpg') }}">
        <div class="container-fluid ps-0 pe-0">
            <div class="row position-relative">
                <div class="col-md-12 text-white text-shadow fw-800">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/packages-banner.jpg') }}" class="w-100 lazyload invisible">
                    <div class="container text-center">
                        <div class="banner-content">
                            <h1 class=" lh-1-1">Design Packages</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <section class="my-5 px-4">
        <div class="container-fluid">
            <div class="row g-2">

                @foreach ($packages as $package)
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body bg-6">
                                <div class="text-center p-xl-3">
                                    <h5 class="card-title fs-32 fw-500">{!! $package->name !!}</h5>
                                    <hr class="bg-dark opacity-100 border-width-1 border-dark my-3">
                                    <div class="fs-16 fw-600 text-uppercase ">{{ $package->sub_title }}</div>
                                    @if ($package->sub_sub_title)
                                        <div class="fs-13 fw-600 mb-3">{!! $package->sub_sub_title !!}</div>
                                    @else
                                        <div class="fs-13 fw-600 mb-3 invisible">Title</div>
                                    @endif


                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($package->thumbnail_img) }}" class="w-100 lazyload">
                                    <div class="fs-32 fw-500 mt-3">${{ $package->unit }}</div>
                                    <div class="fs-13 fw-500">All Locations</div>

                                    <a href="{{ route('package_detail', $package->slug) }}"
                                        class="btn btn-primary btn-rounded fs-18 ff-bold d-block mt-3">GET
                                        STARTED</a>

                                </div>
                                <ul class="list-group list-group-flush">
                                    @if (json_decode($package->included, true) != null)
                                        @foreach (json_decode($package->included, true)['item'] as $key => $value)
                                            <li class="list-group-item d-flex   border-0 fs-16 fw-600 bg-6">
                                                <i class="las la-check color-2 fs-18 me-1"></i>
                                                {{ json_decode($package->included, true)['item'][$key] }}
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        </div>


        </div>
    </section>




    <section class="how-to bg-4 text-center py-3 py-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading fs-32  px-5">We Also Provide</div>
                    <hr class="bg-dark opacity-100 mt-3 mb-4">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 col-sm-6 mx-auto mb-3 text-start">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/hp1.jpg') }}" class="img-fluid lazyload">
                    <div class="title fs-26 lh-1-2 py-2 fw-500">Lawn Replacement Rebate Assistance</div>
                    <div class="p fs-18 mb-3"> $2-4/sf (in many cities), 1000 sf lawn may receive $2,000 rebate after
                        project
                        completion</div>
                    <div class="fs-26">$250</div>

                    <ul class="p fs-16 fw-500 mt-3">
                        <li>Expert assistance throughout rebate process.</li>
                        <li>Preparation of required information per application requirements.</li>
                        <li>Help homeowner receive maximum rebate ie for installation of water
                            efficient irrigation system and rain garden rebate in addition to lawn conversion.</li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-6 mx-auto mb-3 text-start">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/hp2.jpg') }}" class="img-fluid lazyload">
                    <div class="title fs-26 lh-1-2 py-2 fw-500">Parking Strip Design</div>
                    <div class="fs-26">$400</div>
                    <ul class="p fs-16 fw-500 mt-3">

                        <li>Get curb appeal! Additional rebates available.</li>
                        <li>Add it to your front yard package for a consistent design.</li>
                        <li>Additional habitat space for pollinators and wildlife.</li>

                    </ul>
                </div>
                <div class="col-md-4 col-sm-6 mx-auto mb-3 text-start">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/hp3.jpg') }}" class="img-fluid lazyload">
                    <div class="title fs-26 lh-1-2 py-3 fw-500">Veggie Garden Starter Package</div>
                    <div class="fs-26">$400</div>
                    <ul class="p fs-16 fw-500 mt-3">
                        <li>Turn extra space into a "victory garden.</li>
                        <li>Help with design and purchasing of plants for your very own at-home
                            veggie garden (cost of plants billed separately).</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>



    <section class="bg-1 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5 pt-5 pb-3">
                    <div class="section-heading fs-32  px-5 text-white">Have Questions?</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-5 pb-5">
                    <a href="{{ route('contact-us') }}"
                        class="btn btn-primary bg-white color-2 ff-bold fs-20 btn-rounded px-5">Contact us</a>
                    {{-- <a href="" class="btn btn-primary bg-white color-2 ff-bold fs-20 btn-rounded px-5">CALL US</a> --}}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>

    </script>
@endsection
