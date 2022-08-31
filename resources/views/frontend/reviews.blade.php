@extends('frontend.layouts.app')

@section('content')


    <div class="d-block  packages-banner-area   bg-no-repeat  bg-cover bg-center lazyload"
        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
        data-bg="{{ static_asset('assets/img/reviews-banner.jpg') }}">
        <div class="container-fluid ps-0 pe-0">
            <div class="row position-relative">
                <div class="col-md-12 text-white text-shadow fw-800">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/reviews-banner.jpg') }}" class="w-100 lazyload invisible">
                    <div class="container text-center">
                        <div class="banner-content">
                            <h1 class=" lh-1-1 w-100 px-3 px-lg-5">Real Reviews from Real Clients</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <section class="testimonial">
        <div class="container">
            <div class="row">

                <div class="col-md-10 col-lg-8 mx-auto  bg-3 pt-4 pb-2 mt-4">
                    <div class="auther row align-items-center pb-2 ps-4">
                        <div class="col-md-auto">
                            <div class="img bg-no-repeat bg-cover bg-center lazyload h-70px w-70px"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ static_asset('assets/img/review_author.png') }}"></div>
                        </div>
                        <div class="col-md-auto">
                            <div class="row align-items-center">
                                <div class="col-12 ff-bold fs-18">
                                    Debbie L.
                                </div>
                                <div class="col-12 fs-16">
                                    West San Jose, CA  | Oct 4, 2021
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail fs-16  ps-4">
                        ”Really want to thank Water Efficient Garden
                        for designing my new rain garden with
                        drought tolerant plants. They did a wonderful job on my yard. I am not depressed like I used
                        to be when I looked out the window with all the weeds, and I have been getting approval from
                        all my neighbors!”
                    </div>
                    <div class="review_star ps-4">
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                    </div>
                </div>

                <div class="col-md-10 col-lg-8 mx-auto  bg-3 pt-4 pb-2 mt-4">
                    <div class="auther row align-items-center pb-2 ps-4">
                        <div class="col-md-auto">
                            <div class="img bg-no-repeat bg-cover bg-center lazyload h-70px w-70px"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ static_asset('assets/img/review_author.png') }}"></div>
                        </div>
                        <div class="col-md-auto">
                            <div class="row align-items-center">
                                <div class="col-12 ff-bold fs-18">
                                    Debbie L.
                                </div>
                                <div class="col-12 fs-16">
                                    West San Jose, CA  | Oct 4, 2021
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail fs-16  ps-4">
                        ”Really want to thank Water Efficient Garden
                        for designing my new rain garden with
                        drought tolerant plants. They did a wonderful job on my yard. I am not depressed like I used
                        to be when I looked out the window with all the weeds, and I have been getting approval from
                        all my neighbors!”
                    </div>
                    <div class="review_star ps-4">
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                    </div>
                </div>

                <div class="col-md-10 col-lg-8 mx-auto  bg-3 pt-4 pb-2 mt-4">
                    <div class="auther row align-items-center pb-2 ps-4">
                        <div class="col-md-auto">
                            <div class="img bg-no-repeat bg-cover bg-center lazyload h-70px w-70px"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ static_asset('assets/img/review_author.png') }}"></div>
                        </div>
                        <div class="col-md-auto">
                            <div class="row align-items-center">
                                <div class="col-12 ff-bold fs-18">
                                    Debbie L.
                                </div>
                                <div class="col-12 fs-16">
                                    West San Jose, CA  | Oct 4, 2021
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail fs-16  ps-4">
                        ”Really want to thank Water Efficient Garden
                        for designing my new rain garden with
                        drought tolerant plants. They did a wonderful job on my yard. I am not depressed like I used
                        to be when I looked out the window with all the weeds, and I have been getting approval from
                        all my neighbors!”
                    </div>
                    <div class="review_star ps-4">
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                    </div>
                </div>

                <div class="col-md-10 col-lg-8 mx-auto  bg-3 pt-4 pb-2 mt-4">
                    <div class="auther row align-items-center pb-2 ps-4">
                        <div class="col-md-auto">
                            <div class="img bg-no-repeat bg-cover bg-center lazyload h-70px w-70px"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ static_asset('assets/img/review_author.png') }}"></div>
                        </div>
                        <div class="col-md-auto">
                            <div class="row align-items-center">
                                <div class="col-12 ff-bold fs-18">
                                    Debbie L.
                                </div>
                                <div class="col-12 fs-16">
                                    West San Jose, CA  | Oct 4, 2021
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail fs-16  ps-4">
                        ”Really want to thank Water Efficient Garden
                        for designing my new rain garden with
                        drought tolerant plants. They did a wonderful job on my yard. I am not depressed like I used
                        to be when I looked out the window with all the weeds, and I have been getting approval from
                        all my neighbors!”
                    </div>
                    <div class="review_star ps-4">
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                    </div>
                </div>

                <div class="col-md-10 col-lg-8 mx-auto  bg-3 pt-4 pb-2 mt-4">
                    <div class="auther row align-items-center pb-2 ps-4">
                        <div class="col-md-auto">
                            <div class="img bg-no-repeat bg-cover bg-center lazyload h-70px w-70px"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ static_asset('assets/img/review_author.png') }}"></div>
                        </div>
                        <div class="col-md-auto">
                            <div class="row align-items-center">
                                <div class="col-12 ff-bold fs-18">
                                    Debbie L.
                                </div>
                                <div class="col-12 fs-16">
                                    West San Jose, CA  | Oct 4, 2021
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail fs-16  ps-4">
                        ”Really want to thank Water Efficient Garden
                        for designing my new rain garden with
                        drought tolerant plants. They did a wonderful job on my yard. I am not depressed like I used
                        to be when I looked out the window with all the weeds, and I have been getting approval from
                        all my neighbors!”
                    </div>
                    <div class="review_star ps-4">
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                    </div>
                </div>

                <div class="col-md-10 col-lg-8 mx-auto  bg-3 pt-4 pb-2 mt-4">
                    <div class="auther row align-items-center pb-2 ps-4">
                        <div class="col-md-auto">
                            <div class="img bg-no-repeat bg-cover bg-center lazyload h-70px w-70px"
                                style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                data-bg="{{ static_asset('assets/img/review_author.png') }}"></div>
                        </div>
                        <div class="col-md-auto">
                            <div class="row align-items-center">
                                <div class="col-12 ff-bold fs-18">
                                    Debbie L.
                                </div>
                                <div class="col-12 fs-16">
                                    West San Jose, CA  | Oct 4, 2021
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="detail fs-16  ps-4">
                        ”Really want to thank Water Efficient Garden
                        for designing my new rain garden with
                        drought tolerant plants. They did a wonderful job on my yard. I am not depressed like I used
                        to be when I looked out the window with all the weeds, and I have been getting approval from
                        all my neighbors!”
                    </div>
                    <div class="review_star ps-4">
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                        <i class="las la-star fs-24 color-2 py-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-1 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5 pt-5 pb-3">
                    <div class="section-heading fs-32  px-5 text-white">Have Questions? Talk to a Consultant.</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-5 pb-5">
                    <a href="" class="btn btn-primary bg-white color-2 ff-bold fs-20 btn-rounded px-5">EMAIL US</a>
                    <a href="" class="btn btn-primary bg-white color-2 ff-bold fs-20 btn-rounded px-5">CALL US</a>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
    <script>

    </script>
@endsection
