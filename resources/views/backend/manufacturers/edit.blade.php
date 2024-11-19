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
            <h1 class="h3">{{ translate('Edit Manufacturer') }}</h1>
        </div>
    </div>

    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('manufacturers.update', $manufacturer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{ translate('Manufacturer Name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Manufacturer Name') }}" id="name" name="name"
                                value="{{ $manufacturer->name }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
