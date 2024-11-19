@extends('layouts.master')

@section('meta_description', $blog->meta_description ?? '')
@section('meta_author', $blog->author ?? '')
@section('title', $blog->title)

@section('content')
    <section class="mainContainer">
        <section class="marketing_future_detail py-5">
            <div class="container d-grid gap-4">
                <div class="float-start w-100 d-grid gap-4" data-aos="fade-down" data-aos-duration="1500">
                    <h1 class="ft-size-40 ft-size-md-34 ft-size-mb-24 line-height-1 color-pink fw-black text-center">{{ $blog->title }}</h1>
                    <span class="wavy_line_svg mx-auto float-start w-100 text-center">
                        <svg width="87" height="10" viewBox="0 0 87 10" version="1"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 2c7 0 7 6 14 6 8 0 8-6 15-6s7 6 15 6c7 0 7-6 14-6s7 6 14 6c8 0 8-6 15-6"
                                  stroke-width="4" fill="none" fill-rule="evenodd" class="WavyLineBreak--yellow"></path>
                        </svg>
                    </span>
                    <span class="ft-size-15 color-black2 float-start w-100 text-center">{{ $blog->created_at->format('d M Y') }}</span>
                </div>

                <!-- Feature Image -->
                <img data-aos="fade-down" data-aos-duration="1200" src="{{ $blog->getFirstMediaUrl('blog_banner')  }}" alt="{{ $blog->title }}" />

                <!-- Blog Content -->
                <div class="blog-content" data-aos="fade-up" data-aos-duration="1200">
                    {!! $blog->description !!} <!-- Using RichEditor content with HTML formatting -->
                </div>
            </div>
        </section>
    </section>
@endsection
@section('style')
<style>
    .blog-content p{
        padding-bottom:25px;
    }
</style>
@endsection
@section('script')
    <script>

    </script>


@endsection
