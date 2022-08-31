@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Testimonial Information') }}</h5>
    </div>

    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">

                <form class="p-4" action="{{ route('testimonials.update', $testimonial->id) }}" method="POST"
                    enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">

                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{ translate('Name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name"
                                value="{{ $testimonial->name }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{ translate('Position') }}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Position') }}" id="name" name="position"
                                value="{{ $testimonial->position }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{ translate('Reviews') }}</label>
                        <div class="col-sm-9">
                            <textarea type="text" placeholder="{{ translate('Reviews') }}" name="reviews"
                                class="form-control">{{ $testimonial->reviews }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row " id="">
                        <label class="col-sm-3 col-from-label">Rating</label>
                        <div class="col-sm-9">
                            <select class="form-control aiz-selectpicker" name="rating" id="" data-live-search="false"
                                required>

                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" @if($i == $testimonial->ratings) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-6 col-from-label">{{ translate('Featured?') }}</label>
                        <div class="col-md-6">
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input type="checkbox" name="featured" value="1" @if ($testimonial->featured == 1) checked  @endif>
                                <span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Auth image') }}
                        </label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="logo" value="{{ $testimonial->logo }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{ translate('Testimonial Images') }}</label>
                        <div class="pricing-target col-lg-6 ">
                            @if (json_decode($testimonial->images, true) != null)
                                @foreach (json_decode($testimonial->images, true)['img'] as $key => $value)
                                    <div class="p-row">
                                        <div class="row gutters-5">
                                            <div class="col-md">
                                                <div class="form-group mb-3">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">
                                                            {{ translate('Choose File') }}</div>
                                                        <input type="hidden"
                                                            value="{{ json_decode($testimonial->images, true)['img'][$key] }}"
                                                            name="images[img][]" class="selected-files">
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
                                @endforeach
                            @endif
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more" data-content='

                                <div class="p-row">
                                    <div class="row gutters-5">
                                        <div class="col-md">
                                            <div class="form-group mb-3">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div
                                                            class="input-group-text bg-soft-secondary font-weight-medium">
                                                            {{ translate('Browse') }}</div>
                                                    </div>
                                                    <div class="form-control file-amount">
                                                        {{ translate('Choose File') }}</div>
                                                    <input type="hidden" value="{{ json_decode($testimonial->images, true)['img'][$key] }}" name="images[img][]" class="selected-files">
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
                                </div> ' data-target=".pricing-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
