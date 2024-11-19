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

            <?php include 'widgets/product-list.php'; ?>







            @include('frontend.partials.instagram')

        </div>





    </div>
@endsection
@section('script')
@endsection
