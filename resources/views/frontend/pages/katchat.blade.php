@extends('layouts.master')
@section('meta_description', '')
@section('meta_author', '')
@section('title', '')

@section('content')
    <section class="mainContainer">

        <section class="hme_katChat_sec katChat_sec2 position-relative" data-aos="fade-up">
            <!-- <div class="full_bg position-absolute top-0 start-0 w-100 h-100 overflow-hidden" id="katboax_particle"></div> -->
            <div class="container d-grid">
                <div class="hme_katChat_Hdng float-start w-100 text-center">
                    <h2 class="ft-size-50 ft-size-md-38 color-black fw-black letter-spacing-p4 transform-capitalize"><b
                            class="fw-black color-pink">KAT</b> CHAT</h2>
                </div>
                <div class="hme_katChatBoxes float-start w-100">

                    <!-- Initial Listing of Posts -->
                    <div class="row katChatBoxes--row" id="blogContainer">
                        @foreach ($blogs as $blog)
                            <div class="katChatmedia_Col col-12 col-lg-6 col-md-12">
                                <div class="katChatmedia_Bx float-start w-100 h-100 d-flex flex-sm-row">
                                    <div
                                        class="katChatmedia_Des float-start w-100 bg-white d-flex flex-wrap flex-column position-relative">
                                        <small
                                            class="ft-size-15 color-pink fw-normal">{{ $blog->created_at->format('d M Y') }}</small>
                                        <h3 class="ft-size-22 color-black fw-bold line-height-1">
                                            <a class="color-black color-pink-hover fw-bold text-decoration-none"
                                                href="{{ blog_detail_url($blog) }}">{{ $blog->title }}</a>
                                        </h3>
                                        <p>{{ $blog->summary }}</p>
                                        <a class="katshape_link" href="#">View</a>
                                    </div>
                                    <div class="katChatmediaImg bg-norepeat bg-sizecover bg-position-topcenter float-start w-100 bg-white d-flex flex-wrap w-100 h-100 position-relative"
                                        style="background-image: url('{{ $blog->getFirstMediaUrl('blog_feature_image') }}');">
                                        <a class="position-absolute w-100 h-100" href="{{ blog_detail_url($blog) }}"></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-center" id="load_more">
                    <button id="load_more_button"
                        class="btn btn--icon btn--icon-right bubble-btn color-black btn--auto-width" type="button">
                        <span class="bubble-btn__inner">
                            <span class="bubble-btn__bubbles">
                                <span class="bubble-btn__bubble"></span>
                                <span class="bubble-btn__bubble"></span>
                                <span class="bubble-btn__bubble"></span>
                                <span class="bubble-btn__bubble"></span>
                            </span>
                        </span>Load More <i class="fas fa-sync"></i>
                    </button>
                </div>


            </div>
        </section>
    </section>

@endsection
@section('script')
    <script>
        let skip = {{ $blogs->count() }};
        let loadMoreUrl = "{{ route('katchat.load_more') }}"; // Use route name

        document.getElementById('load_more_button').addEventListener('click', function() {
            const loadMoreButton = this;
            loadMoreButton.disabled = true; // Disable button while loading
            loadMoreButton.innerHTML =
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`; // Show loading text

            fetch(`${loadMoreUrl}?skip=${skip}`)
                .then(response => response.json())
                .then(data => {
                    // Append HTML if data is returned
                    if (data.html) {
                        document.getElementById('blogContainer').insertAdjacentHTML('beforeend', data.html);
                        skip = data.nextSkip; // Update skip count
                    }

                    // Check if there are more posts to load
                    if (!data.hasMore) {
                        // Hide the load more button if no more items to load
                        loadMoreButton.style.display = 'none';
                    } else {
                        // Re-enable button and reset text if more items are available
                        loadMoreButton.disabled = false;
                        loadMoreButton.innerHTML = `Load More <i class="fas fa-sync"></i>`;
                    }
                })
                .catch(error => {
                    console.error('Error loading more posts:', error);
                    loadMoreButton.disabled = false; // Re-enable button on error
                    loadMoreButton.innerHTML = `Load More <i class="fas fa-sync"></i>`;
                });
        });
    </script>


@endsection
