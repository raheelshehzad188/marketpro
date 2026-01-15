@php
    $breadcrumbTitle = $breadcrumbTitle ?? 'Shop Details';
    $breadcrumbItems = $breadcrumbItems ?? [];
@endphp
<!-- ========================= Breadcrumb Start =============================== -->
<div class="breadcrumb mb-0 py-26 bg-color-one">
    <div class="container container-lg">
        <div class="breadcrumb-wrapper flex-between flex-wrap gap-16">
            <h6 class="mb-0">{{ $breadcrumbTitle }}</h6>
            <ul class="flex-align gap-8 flex-wrap">
                <li class="text-sm">
                    <a href="{{ route('home') }}" class="text-main-600 flex-align gap-8">
                        <i class="ph ph-house"></i>
                        Home
                    </a>
                </li>
                @foreach($breadcrumbItems as $item)
                    <li class="flex-align text-gray-500">
                        <i class="ph ph-caret-right"></i>
                    </li>
                    <li class="text-sm">
                        @if(isset($item['url']))
                            <a href="{{ $item['url'] }}" class="text-main-600 flex-align gap-8">
                                {{ $item['label'] }}
                            </a>
                        @else
                            <span class="text-neutral-600">{{ $item['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- ========================= Breadcrumb End =============================== -->
