@php
    // Get navigation menu from admin settings (header_menu_items)
    $headerMenuItems = get_setting('header_menu_items');
    $primaryNavigation = [];
    
    if (!empty($headerMenuItems)) {
        $primaryNavigation = json_decode($headerMenuItems, true);
    }
    
    // If no menu items found, try MegaNav as fallback
    if (empty($primaryNavigation) || !is_array($primaryNavigation)) {
        $megaNavItems = \App\Models\MegaNav::where('is_parent', 1)
            ->with(['category', 'children' => function($query) {
                $query->orderBy('id', 'asc');
            }, 'children.category'])
            ->orderBy('id', 'asc')
            ->get();
        
        if ($megaNavItems->count() > 0) {
            foreach ($megaNavItems as $megaNav) {
                $category = $megaNav->category;
                if ($category && $category->published == 1) {
                    $menuItem = [
                        'label' => $category->name,
                        'link' => route('products.listing', ['category' => $category->slug]),
                    ];
                    
                    $children = $megaNav->children;
                    if ($children->count() > 0) {
                        $menuItem['children'] = [];
                        foreach ($children as $child) {
                            $childCategory = $child->category;
                            if ($childCategory && $childCategory->published == 1) {
                                $menuItem['children'][] = [
                                    'label' => $childCategory->name,
                                    'link' => route('products.listing', ['category' => $childCategory->slug]),
                                ];
                            }
                        }
                    }
                    
                    $primaryNavigation[] = $menuItem;
                }
            }
        }
    }
    
    // If still no menu items, use default menu
    if (empty($primaryNavigation)) {
        $primaryNavigation = [
            [
                'label' => 'Home',
                'link' => route('home'),
            ],
            [
                'label' => 'Shop',
                'link' => route('products.listing'),
            ],
            [
                'label' => 'Contact Us',
                'link' => url('/contact'),
            ]
        ];
    }
    
    $currentRoute = Route::currentRouteName();
@endphp

<!-- Nav Menu Start -->
<ul class="nav-menu flex-align {{ $class ?? '' }}">
    @foreach ($primaryNavigation as $item)
        @php
            $hasChildren = !empty($item['children']) && is_array($item['children']);
            $isActive = false;
            if (isset($item['link'])) {
                $itemRoute = parse_url($item['link'], PHP_URL_PATH);
                $currentPath = request()->path();
                $isActive = ($itemRoute == '/' . $currentPath || $itemRoute == $currentPath);
            }
        @endphp
        <li class="nav-menu__item {{ $hasChildren ? 'on-hover-item has-submenu' : '' }} {{ $isActive ? 'activePage' : '' }}">
            @if (isset($item['badge']) && !empty($item['badge']))
                <span class="badge-notification bg-warning-600 text-white text-sm py-2 px-8 rounded-4">{{ $item['badge'] }}</span>
            @endif
            
            @if ($hasChildren)
                <a href="javascript:void(0)" class="nav-menu__link text-heading-two">{{ $item['label'] }}</a>
                <ul class="on-hover-dropdown common-dropdown nav-submenu scroll-sm">
                    @foreach ($item['children'] as $child)
                        <li class="common-dropdown__item nav-submenu__item">
                            <a href="{{ $child['link'] }}" class="common-dropdown__link nav-submenu__link text-heading-two hover-bg-neutral-100">
                                {{ $child['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <a href="{{ $item['link'] ?? '#' }}" class="nav-menu__link text-heading-two">{{ $item['label'] }}</a>
            @endif
        </li>
    @endforeach
</ul>
<!-- Nav Menu End -->

