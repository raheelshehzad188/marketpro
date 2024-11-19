@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">{{ translate('Website Pages') }}</h1>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="mb-0 fw-600">{{ translate('All Pages') }}</h6>
            <a href="{{ route('custom-pages.create') }}" class="btn btn-primary">{{ translate('Add New Page') }}</a>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th data-breakpoints="lg">#</th>
                        <th>{{ translate('Name') }}</th>
                        <th data-breakpoints="sm">{{ translate('Visibility') }}</th>
                        <th data-breakpoints="md">{{ translate('URL') }}</th>
                        <th class="text-right">{{ translate('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Page::with('visibility')->get() as $key => $page)
                        <tr>
                            <td>{{ $key + 2 }}</td>

                            @if ($page->type == 'home_page')
                                <td><a href="{{ route('custom-pages.show_custom_page', $page->id) }}"
                                        class="text-reset">{{ translate($page->title) }}</a></td>
                                <td>{{ url('/') }}</td>
                            @else
                                <td><a href="{{ route('custom-pages.show_custom_page', $page->id) }}"
                                        class="text-reset">{{ $page->title }}</a></td>
                                <td>{{ url('/') }}/{{ $page->slug }}</td>
                            @endif


                            <td>
                                @if ($page->visibility && $page->visibility->isNotEmpty())
                                    @foreach ($page->visibility as $shop)
                                        <span class="badge badge-inline badge-soft-info">{{ $shop->name }}</span>
                                    @endforeach
                                @else
                                    <span class="badge badge-inline badge-soft-success">
                                        {{ translate('All Shops') }}
                                    </span>
                                @endif
                            </td>




                            <td class="text-right">
                                @if ($page->type == 'home_page')
                                    <a href="{{ route('custom-pages.edit', ['id' => $page->id, 'lang' => env('DEFAULT_LANGUAGE'), 'page' => 'home']) }}"
                                        class="btn btn-icon btn-circle btn-sm btn-soft-primary" title="Edit">
                                        <i class="las la-pen"></i>
                                    </a>
                                @else
                                    <a href="{{ route('custom-pages.edit', ['id' => $page->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                        class="btn btn-icon btn-circle btn-sm btn-soft-primary" title="Edit">
                                        <i class="las la-pen"></i>
                                    </a>
                                @endif
                                @if ($page->type == 'custom_page')
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        data-href="{{ route('custom-pages.destroy', $page->id) }} "
                                        title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
