@extends('layouts.master')
{{-- @section('meta_description', $blog->meta_description ?? '')
@section('meta_author', $blog->author ?? '') --}}
@section('title', 'Contact Us')

@section('content')

    <section class="mainContainer">
        <section class="about_bnt" data-aos-duration="800" data-aos="fade-down">
            <img class="w-100" src="{{ asset('frontend/images/summer_photoshot_bnr.jpg') }}" alt="">
        </section>
        <section class="cretve_mrktn_sec pt-6 pb-6">
            <div class="container">
                <div class="cretve_mrktn_Wrap d-grid m-auto text-center">
                    <h1 class="ft-size-50 ft-size-md-38 color-black2 fw-black letter-spacing-p4 m-auto position-relative">
                        KAT Marketing <br /> Summer Photoshoot</h1>
                    <h2 class="ft-size-25 ft-size-md-22 line-height-5 color-pink fw-bold m-auto letter-spacing-2">Here are
                        some of the images from our summer photoshoot as we celebrate our 15th Anniversary in business at
                        KAT. </h2>
                </div>
            </div>
        </section>

        <section class="anniversary-section">
            <div class="container">
                <div class="project_seciton_title">
                    <div class="content">
                        <div class="grid">
                            <div class="grid__item">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/58ec32a236ed2e5d184f582.jpg') }}">
                                    <div class="box__shadow pink"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/c81edd6cee5b72b1c00f565.png') }}" />
                                </a>
                            </div>
                            <div class="grid__item">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/6ab66246fedde3b281e0583.jpg') }}">
                                    <div class="box__shadow yellow"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/bb6d0ae414dc46c8f796566.png') }}" />
                                </a>
                            </div>
                            <div class="grid__item">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/ceb6e5cc152a07edb33f584.jpg') }}">
                                    <div class="box__shadow yellow"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/78c6776cea744f830518567.png') }}" />
                                </a>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="grid__item">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/2d62d935331d6ad54479586.jpg') }}">
                                    <div class="box__shadow yellow"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/b5871e2cc309c87a91de569.png') }}" />
                                </a>
                            </div>
                            <div class="grid__item" href="javascript:void(0)">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/f64bb06ed90e03757eb0587.jpg') }}">
                                    <div class="box__shadow pink"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/1876ccb878856daaf4ce570.png') }}" />
                                </a>
                            </div>
                            <div class="grid__item">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/2750088be7c29f3288db588.jpg') }}">
                                    <div class="box__shadow yellow"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/2aa1daef38e9b3c8f6d9571.png') }}" />
                                </a>
                            </div>
                            <div class="grid__item" href="javascript:void(0)">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/9a791f17ffba45e04b8e589.jpg') }}">
                                    <div class="box__shadow pink"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/7c00539c303832b75788572.png') }}" />
                                </a>
                            </div>
                            <div class="grid__item">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/012c11a6509841544792585.jpg') }}">
                                    <div class="box__shadow yellow"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/4e8b3c0003d5f72252b3573.png') }}" />
                                </a>
                            </div>
                            <div class="grid__item">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/a5d22cca3cc8553464fa590.jpg') }}">
                                    <div class="box__shadow pink"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/46296f7d504a434b9a6e574.png') }}" />
                                </a>
                            </div>
                            <div class="grid__item">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/97bfd3df0f8fad314464591.jpg') }}">
                                    <div class="box__shadow yellow"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/ef345be769326228618d575.png') }}" />
                                </a>
                            </div>
                            <div class="grid__item">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/1705417eeed9e77965c4592.jpg') }}">
                                    <div class="box__shadow pink"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/f939c284bf69fbe015d1579.png') }}" />
                                </a>
                            </div>
                            <div class="grid__item">
                                <div class="box">
                                    <div class="box__shadow yellow"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/424014ef9715dde34314580.png') }}" />
                                </div>
                            </div>
                            <div class="grid__item">
                                <a class="box" data-fslightbox data-type="image"
                                    href="{{ asset('frontend/images/79c9b6eb36adb52a2acb593.jpg') }}">
                                    <div class="box__shadow yellow"></div>
                                    <img class="box__img"
                                        src="{{ asset('frontend/images/97269f09b5fe05ecd999581.png') }}" />
                                </a>
                            </div>
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
<script src="{{ asset('frontend/js/fslightbox.js') }}" type="text/javascript"></script>


@endsection
