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
                        <th data-breakpoints="sm">{{ translate('Parent Category') }}</th>
                        <th width="10%" class="text-right">{{ translate('Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($megaNavItems as $key => $megaNav)
                        <tr>
                            <td>{{ $key + 1 + ($megaNavItems->currentPage() - 1) * $megaNavItems->perPage() }}</td>
                            <td>{{ $megaNav->category->name }}</td>
                            <td>
                                @php
                                    $parent = \App\Category::find($megaNav->parent_id);
                                @endphp
                                @if ($parent)
                                    {{ $parent->name }}
                                @else
                                    <span class="badge badge-inline badge-soft-success">{{ translate('Parent') }}</span>
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
@endsection
