@extends('frontend.layouts.app')

@section('content')
    <div class="d-block  packages-banner-area   bg-no-repeat  bg-cover bg-center lazyload"
        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
        data-bg="{{ static_asset('assets/img/how-it-works.jpg') }}">
        <div class="container-fluid ps-0 pe-0">
            <div class="row position-relative">
                <div class="col-md-12 text-white text-shadow fw-800">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/how-it-works.jpg') }}" class="w-100 lazyload invisible">
                    <div class="container text-center">
                        <div class="banner-content">
                            <h1 class=" lh-1-1 px-5 w-100">An All-Online Process</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <section id="how-it-works-v3" class="three-up--area how-it-works-experiment">
        <div class="container three-up-row--container">
            <div class="row">
                <div class="col text-center">
                    <div class="fs-32 mt-5 mb-2 pt-4 lh-1-3">Online Yard Design in 4 Easy Steps!</div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12 card-container">
                    <div class="item">
                        <div class="row mt-5 mb-2 mb-lg-5">
                            <div class="col-lg-6 text-lg-end text-center">

                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/bp1.jpg') }}" class="img-fluid lazyload step-1">
                            </div>
                            <div class="col-lg-1 content text-center position-relative z-0">
                                <div class="step-count d-inline-block bg-1 text-white  fs-40 text-center lh-1-1">1</div>
                                <div class="vertical-line-top d-none d-lg-block"></div>
                            </div>
                            <div class="col-lg-5 content how-it-works-content text-lg-start text-center">
                                <h4 class="card-title fs-18 ff-bold">
                                    Tell Us What You Like
                                </h4>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    Take the garden style quiz
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 card-container">
                    <div class="item">
                        <div class="row mt-5 mb-2 mb-lg-5 ">
                            <div class="col-lg-6 text-lg-end text-center">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/bp2.jpg') }}" class="img-fluid lazyload step-2">
                            </div>
                            <div class="col-lg-1 content text-center position-relative z-0">
                                <div class="step-count d-inline-block bg-1 text-white  fs-40 text-center lh-1-1">2</div>
                                <div class="vertical-line-middle d-none d-lg-block"></div>
                            </div>
                            <div class="col-lg-5 content how-it-works-content text-lg-start text-center">
                                <h4 class="card-title fs-18 ff-bold">
                                    Show Us Your Space
                                </h4>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    Take some photos and measurements of your yard, and tell us what you want in the design.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 card-container">
                    <div class="item">
                        <div class="row mt-5 mb-2 mb-lg-5 ">
                            <div class="col-lg-6 text-lg-end text-center">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/bp3.jpg') }}" class="img-fluid lazyload step-3">
                            </div>
                            <div class="col-lg-1 content text-center position-relative z-0">
                                <div class="step-count d-inline-block bg-1 text-white  fs-40 text-center lh-1-1">3</div>
                                <div class="vertical-line-middle d-none d-lg-block"></div>
                            </div>
                            <div class="col-lg-5 content how-it-works-content text-lg-start text-center">
                                <h4 class="card-title fs-18 ff-bold">
                                    Review and Finalize Your Design
                                </h4>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    We will work with you to develop concepts, choose the one you like, and create the final
                                    design.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 card-container">
                    <div class="item">
                        <div class="row mt-5 mb-2 mb-lg-5 ">
                            <div class="col-lg-6 text-lg-end text-center">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/bp4.jpg') }}"
                                    class="img-fluid lazyload step-4">
                            </div>
                            <div class="col-lg-1 content text-center position-relative z-0">
                                <div class="step-count d-inline-block bg-1 text-white  fs-40 text-center lh-1-1">4</div>
                                <div class="vertical-line-bottom d-none d-lg-block"></div>
                            </div>
                            <div class="col-lg-5 content how-it-works-content text-lg-start text-center">
                                <h4 class="card-title fs-18 ff-bold">
                                    Bring Your New Yard to Life
                                </h4>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    Based on the package selected, you may be connected with a recommended contractor.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" mt-3">
        <div class="container">

            <div class="row">
                <div class="col-12 text-center  pb-5">
                    <a href="" class="btn btn-primary  ff-bold fs-20 btn-rounded px-5">GET STARTED</a>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 bg-4 design-process-time">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="fs-32 mt-5 mb-2 lh-1-3">The Design Process Typically Takes 3-10 Weeks</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-10 mx-auto my-5">
                    <div class="row aiz-steps arrow-divider">
                        <div class="col-md mb-3">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600  text-dark">Week 0</h3>
                                <p class="fs-16 fw-500 lh-1-4">Design starts.</p>
                            </div>
                        </div>

                        <div class="col-md mb-3">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600 text-dark">Weeks 1-3</h3>
                                <p class="fs-16 fw-500 lh-1-4">Two different design concepts and some initial plant choices
                                    will
                                    be presented. Pick the concept you like best. There may be several rounds of revisions.
                                </p>
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600  text-dark">Weeks 3-10</h3>
                                <p class="fs-16 fw-500 lh-1-4">Finalized design plan
                                    with full plant list will
                                    be delivered.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5">
        <div class="bg-white">

            <h3 class="fs-32 fw-600 mb-0 text-center mb-4 mt-4">
                What Our Customers Said
            </h3>

            <div class="p-3">
                <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="5" data-xl-items="3" data-lg-items="3"
                    data-md-items="2" data-sm-items="2" data-xs-items="1" data-arrows='true' data-infinite='true'>

                    @foreach (\App\Testimonial::where('featured', 0)->orWhereNull('featured')->get() as $testimonial)
                        <div class="carousel-box px-4">
                            <div class="text-center">
                                <div class="review_star py-2">
                                    <i class="las la-star fs-28 color-2 py-3"></i>
                                    <i class="las la-star fs-28 color-2 py-3"></i>
                                    <i class="las la-star fs-28 color-2 py-3"></i>
                                    <i class="las la-star fs-28 color-2 py-3"></i>
                                    <i class="las la-star fs-28 color-2 py-3"></i>
                                </div>
                                <div class="detail fs-16 mb-4">
                                    “{{ $testimonial->reviews }}”
                                </div>
                                <div class="auther row align-items-center">
                                    <div class="col">
                                        <div class="row align-items-center">
                                            <div class="col-12 ff-bold fs-16">
                                                {{ $testimonial->name }}
                                            </div>
                                            <div class="col-12 fs-16">
                                                {{ $testimonial->position }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>


    <section class="faq py-5 bg-3">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="fs-32 mt-4 mb-5 mb-2 lh-1-3">Frequently Asked Questions</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed fs-18 ff-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    If I want a design for my front yard, what package should I choose?
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fs-16 fw-500">You can choose the “Online Solutions” package,
                                    which is
                                    attractively priced at $580. You can also choose the “Expert Assistance” or “Full
                                    Customization” package.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed fs-18 ff-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    If I want a design for my front yard, what package should I choose?
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fs-16 fw-500">Placeholder content for this accordion, which is
                                    intended to
                                    demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion
                                    body. Let's imagine this being filled with some actual content.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed fs-18 ff-bold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    If I want a design for my front yard, what package should I choose?
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fs-16 fw-500">Placeholder content for this accordion, which is
                                    intended to
                                    demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                                    body. Nothing more exciting happening here in terms of content, but just filling up the
                                    space to make it look, at least at first glance, a bit more representative of how this
                                    would look in a real-world application.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="partner-logos  text-center py-5">
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto">
                    <div class="section-heading fs-32 mb-5">
                        We are Proud Members and Partners of:
                    </div>
                </div>
            </div>
            <div class="row  align-items-center">
                <div class="col-md-3 col-sm-4 col-6 mx-auto mb-4">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/brand1.png') }}" class="img-fluid lazyload">
                </div>
                <div class="col-md-3 col-sm-4 col-6 mx-auto mb-4">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/brand2.png') }}" class="img-fluid lazyload w-180px">
                </div>
                <div class="col-md-3 col-sm-4 col-6 mx-auto mb-4">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/brand3.png') }}" class="img-fluid lazyload w-160px">
                </div>
                <div class="col-md-3 col-sm-4 col-6 mx-auto mb-4">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/brand4.png') }}" class="img-fluid lazyload">
                </div>
                <div class="col-md-3 col-sm-4 col-6 mx-auto mb-4">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/brand5.png') }}" class="img-fluid lazyload w-170px">
                </div>
                <div class="col-md-3 col-sm-4 col-6 mx-auto mb-4">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/brand6.png') }}" class="img-fluid lazyload w-130px">
                </div>
                <div class="col-md-3 col-sm-4 col-6 mx-auto mb-4">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/brand7.png') }}" class="img-fluid lazyload">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>

    </script>
@endsection
