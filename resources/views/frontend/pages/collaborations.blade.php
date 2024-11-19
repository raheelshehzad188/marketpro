@extends('layouts.master')
{{-- @section('meta_description', $blog->meta_description ?? '')
@section('meta_author', $blog->author ?? '') --}}
@section('title', 'Collaborations | KAT Marketing')

@section('content')

    <section class="mainContainer">
        <section class="CollabSection" style="background-image: url({{ asset('frontend/images/collab_bnr.jpg') }});"
            data-aos-duration="800" data-aos="fade-down">
            <div class="container">
                <div class="Collabwrap text-center">
                    <h1 class="text-white">Collaborations</h1>
                    <h2 class="text-white">Putting people together for perfect partnerships</h2>
                    <div class="seprator bg-white"></div>
                    <p class="text-white">It’s well known that working together is an essential secret to success, so why
                        not do it with your business? KAT Marketing is always on the look out for great collaborations.</p>
                    <span class="white_down_arrow"><img src="{{ asset('frontend/images/white_down_arrow.png') }}"
                            alt=""></span>
                </div>
            </div>
        </section>

        <section class="katMarketingColrSectionW">
            <div class="colchesterRow" data-aos="fade-up">
                <div class="container containerWidth">
                    <div class="row flex-md-row flex-column-reverse">
                        <div class="col-md-6">
                            <div class="colchesterDes">
                                <h2 class="heading">
                                    <small>KAT MARKETING X BLACK JACKET GROUP</small>
                                    Colchester Soapbox Rally 2023
                                </h2>
                                <p>Who wouldn’t want to go racing down Colchester High Street in their very own devilish
                                    dream-mobile? KAT Marketing and Black Jacket Events were first in line when Colchester
                                    hosted its first ever soapbox rally… and it made for quite the dramatic journey. We had
                                    lots of fun collaborating with our client <a href="#">The Black Jacket Group</a>
                                    from sign-up and conception through to post event celebrations and with their
                                    engineering expertise and our grandest of story-telling skills, we were a match made in
                                    heaven. A devoted dedication to 101 Dalmatians was born… and was taken to the hearts of
                                    the people of Colchester.</p>
                                <p><strong>We'll be working together again on a new creation for 2024!</strong></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="colchesterImg">
                                <img src="{{ asset('frontend/images/colchester_img.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="katMarketingRow" data-aos="fade-up">
                <div class="container containerWidth">
                    <div class="katMarketingIframe">
                        <iframe src="https://www.youtube.com/embed/8RoDOreKYu8?si=kGvoQy6eYCZElR1H"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>

        <section class="katMarketingColrSectionW katMarketingColrSectionP position-relative">
            <div class="colchesterRow" data-aos="fade-up">
                <div class="container containerWidth">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="colchesterImg float-start">
                                <img src="{{ asset('frontend/images/kat_christmas_img.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="colchesterDes">
                                <h2 class="heading">
                                    <small>KAT MARKETING X CLIQQ</small>
                                    KAT & CliQQ Christmas
                                </h2>
                                <p>What do you do when you have a tradition of creating John Lewis-style video Christmas
                                    card and a global pandemic hits and only three people can be together at the same time?
                                    Get creative is the answer at KAT Marketing. Calling on some extra expertise from our
                                    friends at <a href="#">CliQQ Studios</a> and a few (individually) invited guests
                                    from in and around Colchester, KAT’s Christmas advert brought the festive feelgood
                                    factor in just as powerful a way as ever.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="katMarketingRow" data-aos="fade-up">
                <div class="container containerWidth">
                    <div class="katMarketingIframe">
                        <iframe src="https://www.youtube.com/embed/u4stE9PTYvU?si=5P4rsiTOLHOlgP4u"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <div class="katrec-shape2"></div>
            <div class="katrec-shape3"></div>
        </section>
        <section class="FancyChatSection" data-aos="fade-up">
            <div class="container containerWidth">
                <h2 class="heading text-center">Fancy a Chat with KAT?</h2>
                <div class="FancyChatWrap">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-fields form-fields--blck float-start w-100 position-relative">
                                <input class="form__input" type="text" placeholder="First Name" />
                                <label class="form__label">First Name (required)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-fields form-fields--blck float-start w-100 position-relative">
                                <input class="form__input" type="text" placeholder="Last Name" />
                                <label class="form__label">Last Name (required)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-fields form-fields--blck float-start w-100 position-relative">
                                <input class="form__input" type="text" placeholder="Email" />
                                <label class="form__label">Email (required)</label>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    <div class="clearfix"></div>
                </div>
            </div>
        </section>
    </section>


@endsection
@section('style')

@endsection
@section('script')
    <script src="{{ asset('frontend/js/fslightbox.js') }}" type="text/javascript"></script>


@endsection
