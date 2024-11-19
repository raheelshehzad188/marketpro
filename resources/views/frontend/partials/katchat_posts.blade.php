@foreach ($blogs as $blog)
    <div class="katChatmedia_Col col-12 col-lg-6 col-md-12">
        <div class="katChatmedia_Bx float-start w-100 h-100 d-flex flex-sm-row">
            <div class="katChatmedia_Des float-start w-100 bg-white d-flex flex-wrap flex-column position-relative">
                <small class="ft-size-15 color-pink fw-normal">{{ $blog->created_at->format('d M Y') }}</small>
                <h3 class="ft-size-22 color-black fw-bold line-height-1">
                    <a class="color-black color-pink-hover fw-bold text-decoration-none"
                        href="{{ blog_detail_url($blog) }}">{{ $blog->title }}</a>
                </h3>
                <p>{{ $blog->summary }}</p> <!-- Using summary field -->
                <a class="katshape_link" href="#">View</a>
            </div>
            <div class="katChatmediaImg bg-norepeat bg-sizecover bg-position-topcenter float-start w-100 bg-white d-flex flex-wrap w-100 h-100 position-relative"
                style="background-image: url('{{ $blog->getFirstMediaUrl('blog_feature_image') }}');">
                <a class="position-absolute w-100 h-100" href="{{ blog_detail_url($blog) }}"></a>
            </div>
        </div>
    </div>
@endforeach
