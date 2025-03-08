@extends('frontend.layouts.master')
{{-- @section('meta_description', $blog->meta_description ?? '')
@section('meta_author', $blog->author ?? '') --}}
@section('title', 'Check Out')

@section('content')

    <div role="main" class="main shop pb-4">

        <div class="container">
            <div class="row margin-50">
                <div class="col-md-12 align-self-center order-1">
                    <ul class="breadcrumb d-block appear-animation animated fadeIn appear-animation-visible">
                        <li><a href="#">Home</a></li>
                        <li><a href="#"> Product</a></li>
                        <li><a href="#"> Cart</a></li>
                    </ul>


                </div>
            </div>


            <div class="row margin-50">
                <center><img src="{{ asset('frontend/img/srs-images/Thankyou.png')}}" width="auto" class="img-fluid"></center>
            </div>

            <div class="row margin-50">
                <center>
                    <p class="thank-you-text">
                        Your order has been placed successfully. Order Code: <strong>#{{ $order->code }}</strong>
                    </p>
                </center>
            </div>
            <div class="row">
                <center>
                    <a href="{{ route('home') }}" class="bk-home">Back To Home</a>
                </center>
            </div>

        </div>




    </div>
@endsection
@section('style')

@endsection
@section('script')


@endsection
