<!-- ================================ Newsletter new section Start ================================== -->
@php
$newsletterImage = get_setting('home_newsletter_image');
$newsletterTitle = get_setting('home_newsletter_title', 'Stay home & get your daily needs from our shop');
$newsletterSubtitle = get_setting('home_newsletter_subtitle', 'I agree that my submitted data is being collected and stored.');
@endphp
<section class="newsletter-new">
    <div class="container container-lg">
        <div class="py-20 px-80-px bg-neutral-100 rounded-12 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap gap-32">
            <div class="max-w-700">
                <h3 class="mb-30">{{ $newsletterTitle }}</h3>
                <form action="#" class="d-flex gap-8 flex-wrap flex-sm-nowrap">
                    <input type="text" class="form-control bg-white px-20 shadow-none py-16 rounded placeholder-text-14 flex-grow-1" placeholder="Enter your mail">
                    <button type="submit" class="btn py-20 px-32 bg-success-600 flex-shrink-0 hover-bg-success-700 flex-grow-1">Subscribe now</button>
                </form>
                <p class="text-heading text-sm mt-20 fw-medium">{{ $newsletterSubtitle }}</p>
            </div>
            <div class="d-lg-block d-none">
                @if($newsletterImage)
                    <img src="{{ uploaded_asset($newsletterImage) }}" alt="Thumbnail">
                @else
                    <img src="{{ static_asset('frontend/img/thumbs/newsletter-img.png') }}" alt="Thumbnail">
                @endif
            </div>
        </div>
    </div>
</section>
<!-- ================================ Newsletter new section End ================================== -->

