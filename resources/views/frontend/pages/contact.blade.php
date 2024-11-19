@extends('layouts.master')
{{-- @section('meta_description', $blog->meta_description ?? '')
@section('meta_author', $blog->author ?? '') --}}
@section('title', 'Contact Us')

@section('content')

    <section class="mainContainer">
        <section class="contact_video float-start w-100">
            <video autoplay="autoplay" playsinline="true" disablePictureInPicture="true" muted="muted" loop="loop">
                <source src="{{asset('frontend/video/cat_video.mp4')}}" type="video/mp4">
            </video>
        </section>
        <section class="contact_form pt-5_5 pt-md-6 pt-xxl-6 pb-5 pb-md-6 pb-xxl-6">
            <div class="container very-small-container">
                <div class="contact_heading float-start w-100 text-center mb-3 pb-3 mb-lg-5 pb-lg-5">
                    <h1 class="ft-size-50 ft-size-md-38 color-blue fw-black letter-spacing-p4 line-height-1">How Can We
                        Help?</h1>
                    <span class="step_divider d-block mx-auto mt-3 mt-lg-5"><img width="50"
                            src="images/foot-step-pink.png" alt="" /></span>
                </div>
                <div class="contact_form_row">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-fields form-fields--blck float-start w-100 position-relative">
                                <input class="form__input" type="text" placeholder="First Name" />
                                <label class="form__label">First Name (required)</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-fields form-fields--blck float-start w-100 position-relative">
                                <input class="form__input" type="text" placeholder="Last Name" />
                                <label class="form__label">Last Name (required)</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-fields form-fields--blck float-start w-100 position-relative">
                                <input class="form__input" type="text" placeholder="Email" />
                                <label class="form__label">Email (required)</label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-fields form-fields--blck float-start w-100 position-relative">
                                <input class="form__input" type="text" placeholder="Phone" />
                                <label class="form__label">Phone (required)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-fields form-fields--blck float-start w-100 position-relative">
                                <textarea class="form__input" placeholder="How can we help?"></textarea>
                                <label class="form__label form__label-textarea">How Can We Help?</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-fields form-fields--checbox float-start w-100 position-relative">
                                <label for="input_4.1" class="control control-checkbox">
                                    Sign up for our newsletter
                                    <input type="checkbox" name="subscribe" value="1" id="input_4.1">
                                    <div class="control_indicator"></div>
                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button
                                class="btn btn--icon btn--icon-right bubble-btn color-black btn--auto-width submit_button"
                                type="button">
                                <span class="bubble-btn__inner">
                                    <span class="bubble-btn__bubbles">
                                        <span class="bubble-btn__bubble"></span>
                                        <span class="bubble-btn__bubble"></span>
                                        <span class="bubble-btn__bubble"></span>
                                        <span class="bubble-btn__bubble"></span>
                                    </span>
                                </span>Request A Call
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
@section('style')

@endsection
@section('script')
    <script></script>


@endsection
