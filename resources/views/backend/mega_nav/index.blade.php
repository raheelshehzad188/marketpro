@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('All Mega Nav Items') }}</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('mega_nav.create') }}" class="btn btn-primary">
                    <span>{{ translate('Add New Mega Nav Item') }}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-block d-md-flex">
            <h5 class="mb-0 h6">{{ translate('Mega Nav Items') }}</h5>
            <form id="sort_mega_nav" action="" method="GET" class="d-flex flex-wrap">
                <!-- Nav Type Filter -->
                <div class="form-group mb-0 mr-2">
                    <select class="form-control aiz-selectpicker" name="nav_type" onchange="this.form.submit()">
                        <option value="">{{ translate('Select Nav Type') }}</option>
                        <option value="cross_gear" {{ request('nav_type') == 'cross_gear' ? 'selected' : '' }}>
                            {{ translate('Cross Gear') }}
                        </option>
                        <option value="cross_parts" {{ request('nav_type') == 'cross_parts' ? 'selected' : '' }}>
                            {{ translate('Cross Parts') }}
                        </option>
                    </select>
                </div>

                <!-- Shop Filter -->
                <div class="form-group mb-0 mr-2">
                    <select class="form-control aiz-selectpicker" name="shop_id" onchange="this.form.submit()">
                        <option value="">{{ translate('Select Shop') }}</option>
                        @foreach (App\Models\Shop::all() as $shop)
                            <option value="{{ $shop->id }}" {{ request('shop_id') == $shop->id ? 'selected' : '' }}>
                                {{ $shop->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Parent Filter -->
                <div class="form-group mb-0">
                    <select class="form-control aiz-selectpicker" name="parent_id" onchange="this.form.submit()">
                        <option value="">{{ translate('Select Parent Category') }}</option>
                        @foreach (App\Category::where('parent_id', 0)->get() as $parent)
                            <option value="{{ $parent->id }}" {{ request('parent_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Search Input -->
                <div class="form-group mb-0 ml-2" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search"
                           @isset($sort_search) value="{{ $sort_search }}" @endisset
                           placeholder="{{ translate('Type name & Enter') }}">
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th data-breakpoints="lg">#</th>
                        <th>{{ translate('Name') }}</th>
                        <th>{{ translate('Nav Type') }}</th>
                        <th data-breakpoints="sm">{{ translate('Parent Category') }}</th>
                        <th data-breakpoints="sm">{{ translate('Visibility') }}</th>
                        <th width="10%" class="text-right">{{ translate('Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($megaNavItems as $key => $megaNav)
                        <tr>
                            <td>{{ $key + 1 + ($megaNavItems->currentPage() - 1) * $megaNavItems->perPage() }}</td>
                            <td>{{ $megaNav->category->name }}</td>
                            <td>{{ ucfirst($megaNav->nav_type) }}</td>
                            <td>
                                @php
                                    $parent = \App\Category::find($megaNav->parent_id);
                                @endphp
                                @if ($parent)
                                    {{ $parent->name }}
                                @else
                                    —
                                @endif
                            </td>
                            <td>
                                @if (!empty($megaNav->visibility))
                                    @foreach ($megaNav->visibility as $shopId)
                                        @php
                                            $shop = \App\Models\Shop::find($shopId);
                                        @endphp
                                        @if ($shop)
                                            <span class="badge badge-inline badge-soft-info">{{ $shop->name }}</span>
                                        @endif
                                    @endforeach
                                @else
                                    <span class="badge badge-inline badge-soft-success">
                                        {{ translate('All Shops') }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                   href="{{ route('mega_nav.edit', ['id' => $megaNav->id]) }}"
                                   title="{{ translate('Edit') }}">
                                   <i class="las la-edit"></i>
                                </a>

                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                   data-href="{{ route('mega_nav.destroy', $megaNav->id) }}"
                                   title="{{ translate('Delete') }}">
                                   <i class="las la-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $megaNavItems->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function update_visibility(el) {
            let visibility = el.checked ? 1 : 0;
            $.post('{{ route('mega_nav.updateVisibility') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                visibility: visibility
            }, function(data) {
                if (data.success) {
                    AIZ.plugins.notify('success', '{{ translate('Visibility updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
