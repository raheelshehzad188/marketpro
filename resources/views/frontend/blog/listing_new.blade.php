@extends('frontend.layouts.app')

@section('content')
    <div class="d-block  packages-banner-area   bg-no-repeat  bg-cover bg-center lazyload"
        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
        data-bg="{{ static_asset('assets/img/blogs-banner.jpg') }}">
        <div class="container-fluid ps-0 pe-0">
            <div class="row position-relative">
                <div class="col-md-12 text-white text-shadow fw-800">
                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ static_asset('assets/img/blogs-banner.jpg') }}" class="w-100 lazyload invisible">
                    <div class="container text-center">
                        <div class="banner-content">
                            <h1 class=" lh-1-1 px-5 w-100">Guides, Stories & Resources</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <section class="my-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-4 sidebar order-2 order-md-1">
                    <div class="row">
                        <div class="col">
                            <form method="GET" action="{{ route('blogs') }}">
                                <div class="input-group mb-3 search">

                                    <input type="text" class="form-control" name="search" value="{{ $search }}"
                                        placeholder="Search" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit"><i
                                                class="las la-search"></i></button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="fs-17 after mb-2 mt-4 fw-600">RECENT POSTS</div>

                            <ul class="p-3">
                                @foreach ($recent_posts as $recent_post)
                                    <li class="color-2 fs-17 lh-1-3 mb-2"><a
                                            href="{{ url('blog') . '/' . $recent_post->slug }}">{{ $recent_post->title }}</a>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="fs-17 after mb-2 mt-4 fw-600">CATEGORIES</div>
                            <ul class="p-3">
                                @foreach ($blog_categories as $blog_category)
                                    <li class="color-2 fs-17 lh-1-3 mb-2"><a
                                            href="{{ route('blogs') }}?category={{ $blog_category->slug }}"
                                            class="fs-18">{{ $blog_category->category_name }}
                                            ({{ $blog_category->posts->count() }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 order-1">


                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-12 mb-4 mb-md-5">
                                <a href="{{ url('blog') . '/' . $blog->slug }}"
                                    class="d-block shadow bg-no-repeat  bg-cover bg-center lazyload"
                                    style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                    data-bg="{{ uploaded_asset($blog->banner) }}">
                                    <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ static_asset('assets/img/blog-post.jpg') }}"
                                        class="img-fluid invisible lazyload">
                                </a>
                                <a href="{{ url('blog') . '/' . $blog->slug }}"
                                    class="text-dark fs-28 lh-1-2 mt-3 d-block">{{ $blog->title }}</a>
                                <div class="fs-16 mt-2">{{ $blog->short_description }}</div>
                                <a href="{{ url('blog') . '/' . $blog->slug }}"
                                    class="ff-bold mt-3 d-block fs-16">Continue
                                    Reading ></a>
                            </div>
                        @endforeach

                    </div>

                    <div class="aiz-pagination aiz-pagination-center mt-4">
                        {{ $blogs->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="bg-1">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-5 pt-5 pb-3">
                    <div class="section-heading fs-32  px-5 text-white">Build a garden now and you may receive a rebate.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-5 pb-5">
                    <a href="{{ route('start_project') }}"
                        class="btn btn-primary bg-white color-2 ff-bold fs-20 btn-rounded px-5">START MY PROJECT</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>

    </script>
@endsection
