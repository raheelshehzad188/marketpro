@extends('frontend.layouts.app')

@section('content')




    <section class="step-form bg-6 pt-sm-5 pt-3  pb-sm-5 pb-3">
        <div class="container">
            <form id="login-form" class="start_quiz" method="GET" action="" autocomplete="off">
                @csrf
                <div class="text-center">
                    <div class="row">
                        <div class="col-lg-8 mb-5 mx-auto">
                            <div class="fs-36 fw-500">Hey there!</div>
                            <div class="fs-20 fw-500">Sign in to access your account and find out your garden style.</div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="Email" class="form-control border-0 fs-22" type="email" name="email">
                        </div>
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="Password" class="form-control border-0 fs-22" type="password"
                                name="password">
                        </div>


                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-center mx-auto final_step_buttons">
                        <button type="button" onclick="submit_login(this)"
                            class="btn btn-primary btn-rounded fs-18 fw-500 ff-bold text-uppercase px-5">Submit <i
                                class="las la-spinner la-spin la-1x actBtn-loader" style="display: none"></i></button>
                    </div>

                    {{-- <div class="col-md-12 text-center mx-auto final_step_buttons mt-2">
                        <div class="fs-16">Don't have an account yet? <a href="{{route('user.registration')}}"> Create Account.</a></div>
                    </div> --}}

                </div>

            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function submit_login(elm) {
            $(elm).prop('disabled', true);
            $('.actBtn-loader').show();
            $.ajax({
                type: "POST",
                url: '{{ route('login') }}',
                data: $('#login-form').serializeArray(),
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
