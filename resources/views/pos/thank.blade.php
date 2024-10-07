@extends('backend.layouts.app')

@section('content')
    <div class="col-lg-10 mx-auto">

        <div class="card mar-btm" id="cart-details">
            <div class="card-body">

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Order Placed Successfully!</h4>
                    {{-- Your order number is <strong>{{$order->code}}</strong>. --}}

                    <br><br>

                    <strong> Please check your email for the confirmation.</strong>
                </div>


                <a href="{{route('poin-of-sales.index')}}" class="btn  btn-primary mt-4 mx-auto">Shop Again</a>
            </div>

        </div>

    </div>
@endsection


@section('script')
@endsection
