@extends('frontend.layouts.master')
{{-- @section('meta_description', $blog->meta_description ?? '')
@section('meta_author', $blog->author ?? '') --}}
@section('title', 'Home')
@section('content')
    <div role="main" class="main">
        <div role="main" class="main">
            <section class="page-header ">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col">
                            <div class="row">
                                <div class="col-md-12 align-self-center order-1">
                                    <ul
                                        class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">Cross parts </a></li>
                                        <li><a href="#"> Chassis</a></li>
                                        <li><a href="#"> Brake pedals</a></li>
                                    </ul>
                                    <h2 class="page-title">Helmets</h2>
                                    <div class="top-categories">
                                        <ul>
                                            <li><a href="#">Cross helmets</a></li>
                                            <li><a href="#">Accessories Helmets</a></li>
                                        </ul>
                                    </div>
                                    <div class="filters">

                                        <button class="btn btn-filter" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasWithBothOptions"
                                            aria-controls="offcanvasWithBothOptions"> Filter <i
                                                class="fa-solid fa-align-left"></i></button>


                                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1"
                                            id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                                            <div class="offcanvas-header">
                                                <h5 class="offcanvas-title font-weight-bold letter-space-2"
                                                    id="offcanvasWithBothOptionsLabel">Filter</h5>
                                                <button type="button" class="btn-close text-reset"
                                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>

                                            </div>
                                            <div class="offcanvas-body">



                                                <div class="accordion accordion-flush filter-items"
                                                    id="accordionFlushExample">


                                                    <div id="tree">

                                                    </div>


                                                </div>

                                                <div class="bottom-offcanv">
                                                    <div class="filter-result"> 303 products - 2 active filters</div>
                                                    <div class="filter-rest"><button class="btn-reset">Rest</button></div>
                                                    <div class="filter-submmit">
                                                        <button class="btn-submit">Use & close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
            </section>
            <!-- Home Products Start-->
            <section class="product-listing">
                <div class="container">
                    <div class="masonry-loader masonry-loader-loaded">
                        <div class="row products product-thumb-info-list" data-plugin-masonry=""
                            data-plugin-options="{'layoutMode': 'fitRows'}">

                            @foreach (range(1, 8) as $i)
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="product mb-0">
                                        <div class="product-thumb-info border-0 mb-3">
                                            <a href="shop-product-sidebar-left.html">
                                                <div class="product-thumb-info-image">
                                                    <img alt="Product {{ $i }}" class="img-fluid" src="{{ asset('frontend/img/srs-images/product' . $i . '.png') }}">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <h3
                                                    class="text-3-5 font-weight-medium font-alternative text-transform-none line-height-3 mb-0 text-center">
                                                    <a href="shop-product-sidebar-right.html"
                                                        class="text-color-dark text-color-hover-primary product-title">
                                                        Product Title {{ $i }}
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                        <p class="price text-5 mb-3">
                                            <span class="sale text-color-dark font-weight-semi-bold">25,50kr</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
            @include('frontend.partials.instagram')
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('frontend/js/bstreeview.js') }}"></script>
    <script>
        $(function() {

            var json = [{
                    text: "TYRES",
                    nodes: [{
                            text: "GIBSON TECH 6.2 Rear Enduro FIM Soft",
                            nodes: [{
                                    text: "Inner"
                                },
                                {
                                    text: "Inner"
                                }
                            ]
                        },
                        {
                            text: "GIBSON TECH 9.1 Front Tyre",
                            nodes: [{
                                    text: "Inner"
                                },
                                {
                                    text: "Inner"
                                }
                            ]
                        },
                        {
                            text: "GIBSON TECH 7.1 Rear enduro tyre",
                            nodes: [{
                                    text: "Inner"
                                },
                                {
                                    text: "Inner"
                                }
                            ]
                        },
                        {
                            text: "GIBSON MX 5.1 Rear Tyre",
                            nodes: [{
                                    text: "Inner GIBSON MX 5.1 Rear Tyre"
                                },
                                {
                                    text: "Inner GIBSON MX 5.1 Rear Tyre"
                                }
                            ]
                        },
                        {
                            text: "GIBSON MX 4.1 Rear Tyre",
                            nodes: [{
                                    text: " Inner GIBSON MX 4.1 Rear Tyre"
                                },
                                {
                                    text: " Inner GIBSON MX 4.1 Rear Tyre"
                                }
                            ]
                        },
                        {
                            text: "Gibson® MX 3.1 Rear Tyre",
                            nodes: [{
                                    text: "Inner Gibson® MX 3.1 Rear Tyre"
                                },
                                {
                                    text: "Inner Gibson® MX 3.1 Rear Tyre"
                                }
                            ]
                        },
                        {
                            text: "GIBSON TECH 6.1 Enduro FIM Rear",
                            nodes: [{
                                    text: "Inner GIBSON TECH 6.1 Enduro FIM Rear"
                                },
                                {
                                    text: "Inner GIBSON TECH 6.1 Enduro FIM Rear"
                                }
                            ]
                        },
                        {
                            text: "Gibson® MX 1.1 Front tyre",
                            nodes: [{
                                    text: "Inner Gibson® MX 1.1 Front tyre"
                                },
                                {
                                    text: "Inner Gibson® MX 1.1 Front tyre"
                                }
                            ]
                        },

                        {
                            text: "Others"
                        }
                    ]
                },
                {
                    text: "TM ORIGINAL SPAREPARTS",
                    nodes: [{
                            text: "Inner"
                        },
                        {
                            text: "Inner"
                        }
                    ]
                },
                {
                    text: "VROOAM OIL",
                    nodes: [{
                            text: "Inner"
                        },
                        {
                            text: "Inner"
                        }
                    ]
                },
                {
                    text: "SCALVINI PIPES AND SILENCERS",
                    nodes: [{
                            text: "Inner"
                        },
                        {
                            text: "Inner"
                        }
                    ]
                },
                {
                    text: "GIBSON TYRES",
                    nodes: [{
                            text: "Inner"
                        },
                        {
                            text: "Inner"
                        }
                    ]
                },
                {
                    text: "MECA SYSTEM PROTECTORS",
                    nodes: [{
                            text: "Inner"
                        },
                        {
                            text: "Inner"
                        }
                    ]
                    //class: "text-info",
                    //  href: "https://google.com"
                }
            ];

            $('#tree').bstreeview({
                data: json,
                expandIcon: 'fa fa-minus fa-fw',
                collapseIcon: 'fa fa-plus fa-fw',
                indent: 1.25,
                parentsMarginLeft: '1.25rem',
                openNodeLinkOnNewTab: true
            });
        });
    </script>
@endsection
