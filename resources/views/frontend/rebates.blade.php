@extends('frontend.layouts.app')

@section('content')



    <div class="d-block  packages-banner-area   bg-no-repeat  bg-cover bg-center lazyload"
        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
        data-bg="{{ static_asset('assets/img/rebates-banner.jpg') }}">
        <div class="container-fluid ps-0 pe-0">
            <div class="row position-relative">
                <div class="col-md-12 text-white text-shadow fw-800">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/rebates-banner.jpg') }}" class="w-100 lazyload invisible">
                    <div class="container text-center">
                        <div class="banner-content">
                            <h1 class=" lh-1-1 px-5 w-100">California Rebates</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <section class="casestudy my-5">
        <div class="container-fluid px-0">
            <div class="row">

                <div class="col-md-5">
                    <div class="text-start h-100 left p-xxl-8">

                        <div class="fs-30 px-5 lh-1-2 mb-3">
                            The Landscape Conversion Rebate Programs
                        </div>



                        <div class="detail fs-16 mb-4  px-5 fw-500">
                            In an effort to encourage conversion from lawn to water efficient garden, water agencies and
                            companies across California offer rebate programs, with some of them listed here. Check with
                            your local water agency to find out more info.
                        </div>

                        <a href="" class="detail fs-16 mb-2 px-5 ff-bold d-block text-decoration-underline">
                            Save Our Water Turf Replacement Rebate
                        </a>
                        <a href="" class="detail fs-16 mb-2 px-5 ff-bold d-block text-decoration-underline">
                            Cal Water Rebates and Programs (Southern CA)
                        </a>
                        <a href="" class="detail fs-16 mb-2 px-5 ff-bold d-block text-decoration-underline">
                            SoCal Water $mart Residential Rebates (Southern CA)
                        </a>
                        <a href="" class="detail fs-16 mb-2 px-5 ff-bold d-block text-decoration-underline">
                            Santa Clara Water District Landscape Conversion Rebates (Northern CA)
                        </a>
                        <a href="" class="detail fs-16 mb-2 px-5 ff-bold d-block text-decoration-underline">
                            The Bay Area Water Supply & Conservation Agency (BAWSCA) Rebate Programs (Northern CA)
                        </a>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="bg-no-repeat bg-cover bg-center lazyload h-100"
                        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                        data-bg="{{ static_asset('assets/img/rebate-study.jpg') }}">
                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" class="img-fluid lazyload invisible"
                            data-src="{{ static_asset('assets/img/rebate-study.jpg') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="three-up--area how-it-works-rebates bg-3">
        <div class="container three-up-row--container">
            <div class="row">
                <div class="col text-center">
                    <div class="fs-32 mt-5 mb-1 pt-4 lh-1-3">Application Process for a Landscape Conversion Rebate</div>
                    <div class="fs-18 mt-4  lh-1-3">Though similar in nature, each rebate programs are slightly different.
                    </div>
                    <div class="fs-18 lh-1-3 mb-3">Here we use Santa Clara Water District's program as an example to
                        describe the process.</div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12 card-container">
                    <div class="item">
                        <div class="row mt-5 mb-2 mb-lg-5 align-items-center">
                            <div class="col-lg-6 text-lg-end text-center">

                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/ap1.jpg') }}" class="img-fluid lazyload step-1">
                            </div>
                            <div class="col-lg-1 content text-center position-relative z-0">
                                <div class="step-count  d-inline-block bg-1 text-white  fs-40 text-center lh-1-1">1</div>
                                <div class="vertical-line-top d-none d-lg-block"></div>
                            </div>
                            <div class="col-lg-5 content  text-lg-start text-center">
                                <h4 class="card-title fs-18 ff-bold">
                                    Application & Pre-Inspection
                                </h4>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    First, sumbit an application online. The water company will then schedule an
                                    appointment. When the time comes, a company representative will show up at where the
                                    lawn is.
                                </p>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    He/she will check every area of lawn on your property, decide which one qualifies for
                                    receiving the rebates, and make the measurements. At the end, they will hand you a paper
                                    document indicating the areas that qualify, and their sizes, which the rebates will be
                                    based upon.
                                </p>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    You can see more details about this step in this post.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 card-container">
                    <div class="item">
                        <div class="row mt-5 mb-2 mb-lg-5 align-items-center">
                            <div class="col-lg-6 text-lg-end text-center">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/ap2.jpg') }}"
                                    class="img-fluid lazyload step-2">
                            </div>
                            <div class="col-lg-1 content text-center position-relative z-0 h-100">
                                <div class="step-count  d-inline-block bg-1 text-white  fs-40 text-center lh-1-1">2</div>
                                <div class="vertical-line-middle d-none d-lg-block"></div>
                            </div>
                            <div class="col-lg-5 content  text-lg-start text-center">
                                <h4 class="card-title fs-18 ff-bold">
                                    Online Submission
                                </h4>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                </p>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                    cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                                    architecto beatae vitae dicta sunt explicabo. Nemo enim
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 card-container">
                    <div class="item">
                        <div class="row mt-5 mb-2 mb-lg-5 align-items-center">
                            <div class="col-lg-6 text-lg-end text-center">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/ap3.jpg') }}"
                                    class="img-fluid lazyload step-3">
                            </div>
                            <div class="col-lg-1 content text-center position-relative z-0 h-100">
                                <div class="step-count  d-inline-block bg-1 text-white  fs-40 text-center lh-1-1">3</div>
                                <div class="vertical-line-middle d-none d-lg-block"></div>
                            </div>
                            <div class="col-lg-5 content  text-lg-start text-center">
                                <h4 class="card-title fs-18 ff-bold">
                                    Notice to Proceed
                                </h4>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    After the pre-inspection, if you have at least one area that qualifies for the rebate,
                                    you have a certain period of time to submit the design and complate the project, to
                                    receive the rebate. At this point, you need to submit the design and plants planned to
                                    go in the garden. After the design has been done, it can be entered in the application.
                                </p>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    After the water company reviews your design and other info, if they feel it meets the
                                    requirements, they will send you the Notice to Proceed. With the Notice, you can proceed
                                    to kick off the project, and purchase materials. You can see more details in this post.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 card-container">
                    <div class="item">
                        <div class="row mt-5 mb-2 mb-lg-5 align-items-center">
                            <div class="col-lg-6 text-lg-end text-center">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ static_asset('assets/img/ap4.jpg') }}"
                                    class="img-fluid lazyload step-4">
                            </div>
                            <div class="col-lg-1 content text-center position-relative z-0 h-100">
                                <div class="step-count  d-inline-block bg-1 text-white  fs-40 text-center lh-1-1">4</div>
                                <div class="vertical-line-bottom d-none d-lg-block"></div>
                            </div>
                            <div class="col-lg-5 content  text-lg-start text-center">
                                <h4 class="card-title fs-18 ff-bold">
                                    Post-Inspection & Receiving the Check
                                </h4>
                                <p class="card-text fs-16 mx-lg-0 mx-auto">
                                    After the conversion project is finished, log into your application online to update the
                                    status. The water company will then contact you for a post-inspection. It can be either
                                    a self-guided one, where you can submit some photos per the requirements of the rebate
                                    program, or in-person. If the inspection is deemed satisfactory, the program will inform
                                    you, and start to process a check. Usually it takes 4-8 weeks for the check to be
                                    processed and delivered.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <section class="bg-1">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5 pt-5 pb-3">
                    <div class="section-heading fs-32  px-5 text-white">Build a garden now and you may receive a rebate.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-5 pb-5">
                    <a href="" class="btn btn-primary bg-white color-2 ff-bold fs-20 btn-rounded px-5">START MY PROJECT</a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>

    </script>
@endsection
