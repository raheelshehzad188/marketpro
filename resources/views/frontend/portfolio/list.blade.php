@extends('frontend.layouts.app')

@section('content')


    <div class="d-block  packages-banner-area   bg-no-repeat  bg-cover bg-center lazyload"
        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
        data-bg="{{ static_asset('assets/img/portfolio-page-banner.jpg') }}">
        <div class="container-fluid ps-0 pe-0">
            <div class="row position-relative">
                <div class="col-md-12 text-white text-shadow fw-800">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/portfolio-page-banner.jpg') }}"
                        class="w-100 lazyload invisible">
                    <div class="container text-center">
                        <div class="banner-content">
                            <h1 class=" lh-1-1 px-5 w-100">Past Projects</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <section class="sub-nav portfolio mt-5">
        <div class="container">
            <div class="row text-center align-items-center">
                <div class="col mb-2">
                    <a href="javascript:void(0)" data-id="all"
                        class="ff-bold  fs-18 py-3 filter active px-2 d-inline-block">All Projects</a>
                </div>
                <div class="col  mb-2">
                    <a href="javascript:void(0)" data-id="1" class="ff-bold  fs-18 py-3 filter px-2 d-inline-block">Front
                        Yards</a>
                </div>
                <div class="col  mb-2">
                    <a href="javascript:void(0)" data-id="2" class="ff-bold  fs-18 py-3 filter  px-2 d-inline-block">Back
                        Yards</a>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <hr class="bg-dark opacity-100">
                </div>
            </div>
        </div>
    </section>


    <section class="list mt-5">
        <div class="container">
            <div class="row" id="loadData">


            </div>
        </div>
    </section>


    <section class="bg-3 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5 pt-5 pb-3">
                    <div class="section-heading fs-32  px-5">Build a Beautiful, Water Efficient Garden.</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-5 pb-5">
                    <a href="" class="btn btn-primary  ff-bold fs-20 btn-rounded px-5">START YOUR PROJECT</a>
                </div>
            </div>
        </div>
    </section>
    <form id="plistform">
        @csrf
        <input type="hidden" name="keyword" id="keywordaa" />

    </form>

@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function loadMoreData(id = 0, cat = 'all') {
            var formData = new FormData($("#plistform")[0]);
            $.ajax({
                url: '{{ route('load-portolio-data') }}?id=' + id + '&cat=' + cat, // form action url
                type: 'post', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                data: formData, // serialize form data
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    // place.append(loading_set); // change submit button text
                    //$('#load_more').html('');
                },
                success: function(data) {
                    $('#load_more_button').remove();
                    $('#loadData').append(data);
                }
            });
        }
        loadMoreData(0);
        $(document).on('click', '#load_more_button', function() {
            var id = $(this).data('id');
            var cat = $('.filter.active').data('id');
            //console.log(id);
            $('#load_more_button').html('<b>Loading...</b>');
            loadMoreData(id, cat);
        });

        $(document).on('click', '.filter', function() {
            $('#loadData').html('');
            loadMoreData(0,$(this).data('id'));
            $('.filter').removeClass('active');
            $(this).addClass('active');
        });
    </script>
@endsection
