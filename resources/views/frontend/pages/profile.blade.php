@extends('frontend.layouts.dashboard')
@section('title', 'Customer Login & Registration')

@section('content')




                    <div class="col-lg-9">
                    <form role="form" action="{{ url('customer/update-profile')  }}" method="post" class="needs-validation" novalidate="novalidate">
@csrf

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">First name</label>
                            <div class="col-lg-9">
                        <input class="form-control text-3 h-auto py-2" type="text" name="first_name" value="{{$user->first_name}}" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Last name</label>
                            <div class="col-lg-9">
                                <input class="form-control text-3 h-auto py-2" type="text" name="last_name" value="{{$user->last_name}}" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Phone</label>
                            <div class="col-lg-9">
                                <input class="form-control text-3 h-auto py-2" type="text" name="phone" value="{{$user->phone}}" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Company</label>
                            <div class="col-lg-9">
                                <input class="form-control text-3 h-auto py-2" type="text" name="company" value="{{$user->company}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Website</label>
                            <div class="col-lg-9">
                                <input class="form-control text-3 h-auto py-2" type="url" name="website" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2">Address</label>
                            <div class="col-lg-9">
                                <input class="form-control text-3 h-auto py-2" type="text" name="address" value="{{$user->address}}" placeholder="Street">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2"></label>
                            <div class="col-lg-6">
                                <input class="form-control text-3 h-auto py-2" type="text" name="city" value="" placeholder="City">
                            </div>
                            <div class="col-lg-3">
                                <input class="form-control text-3 h-auto py-2" type="text" name="state" value="" placeholder="State">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Username</label>
                            <div class="col-lg-9">
                                <input class="form-control text-3 h-auto py-2" type="text" name="username" value="" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Password</label>
                            <div class="col-lg-9">
                                <input class="form-control text-3 h-auto py-2" type="password" name="password" value="" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label line-height-9 pt-2 text-2 required">Confirm password</label>
                            <div class="col-lg-9">
                                <input class="form-control text-3 h-auto py-2" type="password" name="confirmPassword" value="" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-group col-lg-9">

                            </div>
                            <div class="form-group col-lg-3">
                                <input type="submit" value="Save" class="btn btn-light btn-modern text-color-light bg-color-grey text-color-hover-light bg-color-hover-primary text-uppercase text-3 font-weight-bold border-0 border-radius-5 btn-px-4 py-3 float-end" data-loading-text="Loading...">
                            </div>
                        </div>
                    </form>
                </div>


@endsection

@section('style')
<!-- Add any custom styles if needed -->
@endsection

@section('script')

@endsection
