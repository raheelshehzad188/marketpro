@extends('frontend.layouts.app')

@section('content')
    <section class="pt-5 bg-6">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="row aiz-steps arrow-divider">
                        <div class="col active">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600 text-dark">Garden Types</h3>
                            </div>
                        </div>

                        <div class="col">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600  text-dark">Plant Types</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600 text-dark">See Your Results</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="step-form bg-6 pt-sm-5 pt-3  pb-sm-5 pb-3">
        <div class="container">
            <form id="register-form" class="start_quiz" method="GET" action="" autocomplete="off">
                @csrf
                <div class="text-center">
                    <div class="row">
                        <div class="col-lg-8 mb-5 mx-auto">
                            <div class="fs-36 fw-500">Create an Account</div>
                            <div class="fs-20 fw-500">You're almost there! Create an account to save your result and find
                                out your garden style.</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="First Name" class="form-control border-0 fs-22" type="text"
                                name="first_name">
                        </div>
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="Last Name" class="form-control border-0 fs-22" type="text" name="last_name">
                        </div>
                        @if (isset($cart->email) && !empty($cart->email))
                            {{-- <div class="col-12 col-md-7 mx-auto mb-5">
                                <input placeholder="Email" value="{{ $cart->email }}" class="form-control border-0 fs-22"
                                    type="email" name="email">
                            </div> --}}
                            <div class="col-12 col-md-7 mx-auto mb-5">
                                <input placeholder="Email" class="form-control border-0 fs-22" type="email" name="email">
                            </div>
                        @else
                            <div class="col-12 col-md-7 mx-auto mb-5">
                                <input placeholder="Email" class="form-control border-0 fs-22" type="email" name="email">
                            </div>
                        @endif
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="Phone (optional)" class="form-control border-0 fs-22" type="text" name="phone">
                        </div>
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="Password" class="form-control border-0 fs-22" type="password"
                                name="password">
                        </div>
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="Confirm Password" class="form-control border-0 fs-22" type="password"
                                name="password_confirmation">
                        </div>



                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-center mx-auto final_step_buttons">
                        <button type="button" onclick="submit_register(this)"
                            class="btn btn-primary btn-rounded fs-18 fw-500 ff-bold text-uppercase px-5">Submit <i
                                class="las la-spinner la-spin la-1x actBtn-loader" style="display: none"></i></button>
                    </div>

                    <div class="col-md-12 text-center mx-auto final_step_buttons mt-2">
                        <div class="fs-16">Already have an account? <a href="{{ route('user.login') }}">Log in
                                here.</a></div>
                    </div>

                </div>

            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function submit_register(elm) {
            $(elm).prop('disabled', true);
            $('.actBtn-loader').show();
            $.ajax({
                type: "POST",
                url: '{{ route('register') }}',
                data: $('#register-form').serializeArray(),
                success: function(data) {
                    window.location.replace(data.redirect);
                },
                error: function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            AIZ.plugins.notify('danger', error[0]);
                        });
                    }
                    $(elm).prop('disabled', false);
                    $('.actBtn-loader').hide();
                }
            });
        }


        $(document).ready(function() {

        });
    </script>
@endsection
