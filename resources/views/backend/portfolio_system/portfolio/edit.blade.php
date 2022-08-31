@extends('backend.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Portfolio Information') }}</h5>
                </div>
                <div class="card-body">
                    <form id="add_form" class="form-horizontal" action="{{ route('portfolio.update', $portfolio->id) }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">
                                {{ translate('Portfolio Title') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input type="text" placeholder="{{ translate('Portfolio Title') }}"
                                    onkeyup="makeSlug(this.value)" id="title" name="title" value="{{ $portfolio->title }}"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row" id="category">
                            <label class="col-md-3 col-from-label">
                                {{ translate('Category') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="category_id" id="category_id"
                                    data-live-search="true" required @if ($portfolio->category != null)
                                    data-selected="{{ $portfolio->category->id }}"
                                    @endif
                                    >
                                    <option>--</option>
                                    @foreach ($portfolio_categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Slug') }}</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="{{ translate('Slug') }}" name="slug" id="slug"
                                    value="{{ $portfolio->slug }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">
                                {{ translate('Feature Image') }}
                            </label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}
                                        </div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" value="{{ $portfolio->feature_image }}" name="feature_image" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">
                                {{ translate('Banner') }}

                            </label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}
                                        </div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="banner" class="selected-files"
                                        value="{{ $portfolio->banner }}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">
                                {{ translate('Short Description') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <textarea name="short_description" rows="5"
                                    class="form-control">{{ $portfolio->short_description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">
                                {{ translate('Description') }}
                            </label>
                            <div class="col-md-9">
                                <textarea class="aiz-text-editor"
                                    name="description">{{ $portfolio->description }}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{ translate('Examples') }}</label>
                            <div class="example-target col-md-9">
                                @if (json_decode($portfolio->example, true) != null)
                                @foreach (json_decode($portfolio->example, true)['image'] as $key => $value)
                                <div class="p-row">
                                    <div class="row gutters-5">
                                        <div class="col-md">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                        {{ translate('Browse') }}</div>
                                                </div>
                                                <div class="form-control file-amount">{{ translate('Choose File') }}
                                                </div>
                                                <input type="hidden" value="{{json_decode($portfolio->example, true)['image'][$key]}}" name="example[image][]" class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">
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

                                    <div class="row gutters-5">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Before"
                                                    name="example[before][]" value="{{json_decode($portfolio->example, true)['before'][$key]}}">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <textarea type="text" class="form-control" placeholder=""
                                                    name="example[before_description][]">{{json_decode($portfolio->example, true)['before_description'][$key]}}</textarea>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row gutters-5">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="After"
                                                    name="example[after][]" value="{{json_decode($portfolio->example, true)['after'][$key]}}">
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <textarea type="text" class="form-control" placeholder=""
                                                    name="example[after_description][]">{{json_decode($portfolio->example, true)['after_description'][$key]}}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                    data-content='  <div class="p-row">
                                            <div class="row gutters-5">
                                                <div class="col-md">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}
                                                        </div>
                                                        <input type="hidden" name="example[image][]" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
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

                                            <div class="row gutters-5">
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Before"
                                                            name="example[before][]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <textarea type="text" class="form-control" placeholder=""
                                                            name="example[before_description][]"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row gutters-5">
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="After"
                                                            name="example[after][]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <textarea type="text" class="form-control" placeholder=""
                                                            name="example[after_description][]"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>' data-target=".example-target">
                                    {{ translate('Add New Example') }}
                                </button>
                            </div>
                        </div>




                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{ translate('More Images') }}</label>
                            <div class="more_images-target col-md-9">
                                @if (json_decode($portfolio->more_images, true) != null)
                                @foreach (json_decode($portfolio->more_images, true)['image'] as $key => $value)
                                <div class="p-row">
                                    <div class="row gutters-5">
                                        <div class="col-md">
                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                        {{ translate('Browse') }}</div>
                                                </div>
                                                <div class="form-control file-amount">{{ translate('Choose File') }}
                                                </div>
                                                <input type="hidden" value="{{json_decode($portfolio->more_images, true)['image'][$key]}}" name="more_images[image][]" class="selected-files">
                                            </div>
                                            <div class="file-preview box sm">
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

                                    <div class="row gutters-5">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Caption"
                                                    name="more_images[caption][]" value="{{json_decode($portfolio->more_images, true)['caption'][$key]}}">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                    data-content=' <div class="p-row">
                                            <div class="row gutters-5">
                                                <div class="col-md">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}
                                                        </div>
                                                        <input type="hidden" name="more_images[image][]" class="selected-files">
                                                    </div>
                                                    <div class="file-preview box sm">
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

                                            <div class="row gutters-5">
                                                <div class="col-md">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Caption"
                                                            name="more_images[caption][]" value="">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>' data-target=".more_images-target">
                                    {{ translate('Add New Images') }}
                                </button>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Meta Title') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="meta_title"
                                    value="{{ $portfolio->meta_title }}" placeholder="{{ translate('Meta Title') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">
                                {{ translate('Meta Image') }}
                                <small>(200x200)+</small>
                            </label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}
                                        </div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="meta_img" class="selected-files"
                                        value="{{ $portfolio->meta_img }}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Meta Description') }}</label>
                            <div class="col-md-9">
                                <textarea name="meta_description" rows="5"
                                    class="form-control">{{ $portfolio->meta_description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">
                                {{ translate('Meta Keywords') }}
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                    value="{{ $portfolio->meta_keywords }}"
                                    placeholder="{{ translate('Meta Keywords') }}">
                            </div>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">
                                {{ translate('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function makeSlug(val) {
            let str = val;
            let output = str.replace(/\s+/g, '-').toLowerCase();
            $('#slug').val(output);
        }
    </script>
@endsection
