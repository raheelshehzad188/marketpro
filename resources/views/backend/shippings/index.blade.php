@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">{{ translate('All Shipping Methods') }}</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('shippings.create') }}" class="btn btn-primary">
                <span>{{ translate('Add New Shipping') }}</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">{{ translate('Shippings') }}</h5>
        <form id="sort_shippings" action="" method="GET">
            <div class="box-inline pad-rgt pull-left">
                <div style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th data-breakpoints="lg">#</th>
                    <th>{{ translate('Name') }}</th>
                    <th data-breakpoints="sm">{{ translate('Cost') }}</th>
                    <th data-breakpoints="sm">{{ translate('Country') }}</th>
                    <th data-breakpoints="sm">{{ translate('Visibility') }}</th>
                    <th width="10%" class="text-right">{{ translate('Options') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shippings as $key => $shipping)
                    <tr>
                        <td>{{ $key + 1 + ($shippings->currentPage() - 1) * $shippings->perPage() }}</td>
                        <td>{{ $shipping->name }}</td>
                        <td>{{ $shipping->cost }}</td>
                        <td>{{ $shipping->country_id == 0 ? translate('All Countries') : $shipping->country->name }}</td>
                        <td>
                            @if (!empty($shipping->visibilityShops))
                                @foreach ($shipping->visibilityShops as $shopId => $shopName)
                                    <span class="badge badge-inline badge-{{ $badgeClasses[$shopId] ?? 'soft-info' }}">{{ $shopName }}</span>
                                @endforeach
                            @else
                                <span class="badge badge-inline badge-soft-success">
                                    {{ translate('All Shops') }}
                                </span>
                            @endif
                        </td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('shippings.edit', $shipping->id) }}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('shippings.destroy', $shipping->id) }}" title="{{ translate('Delete') }}">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $shippings->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
