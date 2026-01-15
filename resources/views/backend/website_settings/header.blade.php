@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">{{ translate('Website Header') }}</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Header Setting') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{ translate('Header Logo') }}</label>
                            <div class="col-md-8">
                                <div class=" input-group " data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="types[]" value="header_logo">
                                    <input type="hidden" name="header_logo" class="selected-files"
                                        value="{{ get_setting('header_logo') }}">
                                </div>
                                <div class="file-preview"></div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Header Menu Management --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Header Menu Items') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="types[]" value="header_menu_items">
                        
                        @php
                            $headerMenuItems = get_setting('header_menu_items');
                            $menuItems = [];
                            if (!empty($headerMenuItems)) {
                                $menuItems = json_decode($headerMenuItems, true);
                            }
                            if (empty($menuItems) || !is_array($menuItems)) {
                                $menuItems = [
                                    [
                                        'label' => 'Home',
                                        'link' => route('home'),
                                        'badge' => '',
                                        'children' => []
                                    ],
                                    [
                                        'label' => 'Shop',
                                        'link' => route('products.listing'),
                                        'badge' => '',
                                        'children' => []
                                    ]
                                ];
                            }
                        @endphp
                        
                        <div class="header-menu-items">
                            @foreach($menuItems as $index => $item)
                                <div class="menu-item-wrapper mb-4 p-3 border rounded" data-index="{{ $index }}">
                                    <div class="row gutters-5">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="fw-600">{{ translate('Menu Label') }}</label>
                                                <input type="text" class="form-control menu-label" value="{{ $item['label'] ?? '' }}" placeholder="{{ translate('Menu Label') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="fw-600">{{ translate('Menu Link') }}</label>
                                                <input type="text" class="form-control menu-link" value="{{ $item['link'] ?? '' }}" placeholder="http:// or route">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="fw-600">{{ translate('Badge (Optional)') }}</label>
                                                <input type="text" class="form-control menu-badge" value="{{ $item['badge'] ?? '' }}" placeholder="{{ translate('New, Hot, etc.') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="fw-600 d-block">&nbsp;</label>
                                                <button type="button" class="btn btn-icon btn-circle btn-sm btn-soft-danger remove-menu-item" data-toggle="remove-parent" data-parent=".menu-item-wrapper">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        {{-- Submenu Items --}}
                                        <div class="col-12 mt-3">
                                            <label class="fw-600 mb-2">{{ translate('Submenu Items') }}</label>
                                            <div class="submenu-items border-top pt-3">
                                                @if(!empty($item['children']) && is_array($item['children']))
                                                    @foreach($item['children'] as $childIndex => $child)
                                                        <div class="row gutters-5 mb-2 submenu-item">
                                                            <div class="col-5">
                                                                <input type="text" class="form-control submenu-label" placeholder="{{ translate('Submenu Label') }}" value="{{ $child['label'] ?? '' }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="text" class="form-control submenu-link" placeholder="http:// or route" value="{{ $child['link'] ?? '' }}">
                                                            </div>
                                                            <div class="col-1">
                                                                <button type="button" class="btn btn-icon btn-circle btn-sm btn-soft-danger remove-submenu" data-toggle="remove-parent" data-parent=".submenu-item">
                                                                    <i class="las la-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-soft-secondary btn-sm mt-2 add-submenu-btn">
                                                <i class="las la-plus"></i> {{ translate('Add Submenu Item') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <button type="button" class="btn btn-soft-primary btn-sm mt-3" id="add-menu-item">
                            <i class="las la-plus"></i> {{ translate('Add New Menu Item') }}
                        </button>
                        
                        <input type="hidden" name="header_menu_items" id="header_menu_items_json" value="{{ $headerMenuItems }}">
                        
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">{{ translate('Update Menu') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        // Add new menu item
        $('#add-menu-item').on('click', function() {
            var newMenuItem = `
                <div class="menu-item-wrapper mb-4 p-3 border rounded">
                    <div class="row gutters-5">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="fw-600">{{ translate('Menu Label') }}</label>
                                <input type="text" class="form-control menu-label" value="" placeholder="{{ translate('Menu Label') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="fw-600">{{ translate('Menu Link') }}</label>
                                <input type="text" class="form-control menu-link" value="" placeholder="http:// or route">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="fw-600">{{ translate('Badge (Optional)') }}</label>
                                <input type="text" class="form-control menu-badge" value="" placeholder="{{ translate('New, Hot, etc.') }}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="fw-600 d-block">&nbsp;</label>
                                <button type="button" class="btn btn-icon btn-circle btn-sm btn-soft-danger remove-menu-item" data-toggle="remove-parent" data-parent=".menu-item-wrapper">
                                    <i class="las la-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="fw-600 mb-2">{{ translate('Submenu Items') }}</label>
                            <div class="submenu-items border-top pt-3">
                            </div>
                            <button type="button" class="btn btn-soft-secondary btn-sm mt-2 add-submenu-btn">
                                <i class="las la-plus"></i> {{ translate('Add Submenu Item') }}
                            </button>
                        </div>
                    </div>
                </div>
            `;
            $('.header-menu-items').append(newMenuItem);
        });

        // Add submenu item
        $(document).on('click', '.add-submenu-btn', function() {
            var submenuRow = `
                <div class="row gutters-5 mb-2 submenu-item">
                    <div class="col-5">
                        <input type="text" class="form-control submenu-label" placeholder="{{ translate('Submenu Label') }}" value="">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control submenu-link" placeholder="http:// or route" value="">
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn btn-icon btn-circle btn-sm btn-soft-danger remove-submenu" data-toggle="remove-parent" data-parent=".submenu-item">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                </div>
            `;
            $(this).closest('.menu-item-wrapper').find('.submenu-items').append(submenuRow);
        });

        // Update header menu JSON before form submit
        $('form').on('submit', function(e) {
            var menuItems = [];
            
            $('.menu-item-wrapper').each(function() {
                var label = $(this).find('.menu-label').val();
                var link = $(this).find('.menu-link').val();
                var badge = $(this).find('.menu-badge').val();
                
                if (label && link) {
                    var menuItem = {
                        'label': label,
                        'link': link,
                        'badge': badge || '',
                        'children': []
                    };
                    
                    // Get submenu items
                    $(this).find('.submenu-item').each(function() {
                        var subLabel = $(this).find('.submenu-label').val();
                        var subLink = $(this).find('.submenu-link').val();
                        if (subLabel && subLink) {
                            menuItem.children.push({
                                'label': subLabel,
                                'link': subLink
                            });
                        }
                    });
                    
                    menuItems.push(menuItem);
                }
            });
            
            $('#header_menu_items_json').val(JSON.stringify(menuItems));
        });
    });
</script>
@endsection
