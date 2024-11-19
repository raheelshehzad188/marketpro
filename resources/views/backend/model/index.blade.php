@extends('backend.layouts.app')

@section('content')

    <!-- Flash Messages -->
    @if (session()->has('flash_notification'))
        @foreach (session('flash_notification') as $message)
            <div class="alert alert-{{ $message['level'] }} alert-dismissible fade show" role="alert">
                {{ $message['message'] }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="align-items-center">
            <h1 class="h3">{{ translate('All Models') }}</h1>
        </div>
    </div>

    <div class="row">
        <!-- Model List -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{ translate('Model List') }}</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Name') }}</th>
                                <th class="text-right">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($models as $key => $model)
                                <tr>
                                    <td>{{ $key + 1 + ($models->currentPage() - 1) * $models->perPage() }}</td>
                                    <td>{{ $model->name }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                            href="{{ route('model-names.edit', $model->id) }}"
                                            title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a data-href="{{ route('model-names.destroy', $model->id) }}" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                            title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="aiz-pagination">
                        {{ $models->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Add New Model Form -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Add New Model') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('model-names.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Model Name') }}</label>
                            <input type="text" placeholder="{{ translate('Model Name') }}" name="name"
                                class="form-control" required>
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
