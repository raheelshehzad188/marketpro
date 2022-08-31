@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="align-items-center">
            <h1 class="h3">{{ translate('All Testimonials') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{ translate('Testimonials') }}</h5>
                    </div>
                    <div class="col-md-4">
                        <form class="" id="sort_testimonials" action="" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="search" name="search" @isset($sort_search)
                                    value="{{ $sort_search }}" @endisset
                                    placeholder="{{ translate('Type name & Enter') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Logo') }}</th>
                                <th class="text-right">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($testimonials as $key => $testimonial)
                                <tr>
                                    <td>{{ $key + 1 + ($testimonials->currentPage() - 1) * $testimonials->perPage() }}</td>
                                    <td>{{ $testimonial->name }}</td>
                                    <td>
                                        <img src="{{ uploaded_asset($testimonial->logo) }}" alt="{{ translate('Testimonial') }}"
                                            class="h-50px">
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                            href="{{ route('testimonials.edit', ['id' => $testimonial->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                            title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                            data-href="{{ route('testimonials.destroy', $testimonial->id) }}"
                                            title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="aiz-pagination">
                        {{ $testimonials->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Add New Testimonial') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('testimonials.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Auth Name') }}</label>
                            <input type="text" placeholder="{{ translate('Name') }}" name="name" class="form-control"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Position') }}</label>
                            <input type="text" placeholder="{{ translate('Position') }}" name="position" class="form-control"
                                >
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Reviews') }}</label>
                            <textarea  placeholder="{{ translate('Reviews') }}" name="reviews" class="form-control" ></textarea>
                        </div>
                        <div class="form-group mb-3" id="">
                            <label class="">Rating</label>
                            <select class="form-control aiz-selectpicker" name="rating" id="" data-live-search="false"
                                required>

                                @for ($i = 1; $i<= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-6 col-from-label">{{ translate('Featured?') }}</label>
                            <div class="col-md-6">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="featured" value="1">
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Auth Image') }}</label>
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="logo" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>{{ translate('Testimonial Images') }}</label>
                            <div class="pricing-target">
                                <div class="p-row">
                                    <div class="row gutters-5">
                                        <div class="col-md">
                                            <div class="form-group mb-3">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                            {{ translate('Browse') }}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                    <input type="hidden" name="images[img][]" class="selected-files">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <button type="button"
                                                    class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                    data-toggle="remove-parent" data-parent=".p-row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more" data-content='
                            <div class="p-row">
                                <div class="row gutters-5">
                                    <div class="col-md">
                                        <div class="form-group mb-3">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                        {{ translate('Browse') }}</div>
                                                </div>
                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                <input type="hidden" name="images[img][]" class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-auto">
                                        <div class="form-group">
                                            <button type="button"
                                                class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                data-toggle="remove-parent" data-parent=".p-row">
                                                <i class="las la-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>' data-target=".pricing-target">
                                {{ translate('Add More') }}
                            </button>
                        </div>
                        <div class="form-group mb-3 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function sort_testimonials(el) {
            $('#sort_testimonials').submit();
        }
    </script>
@endsection
