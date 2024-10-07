@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Category Information') }}</h5>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body p-0">
                    <form class="p-4" action="{{ route('categories.update', $category->id) }}" method="POST"
                        enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Name') }} <i
                                    class="las la-language text-danger" title="{{ translate('Translatable') }}"></i></label>
                            <div class="col-md-9">
                                <input type="text" name="name" value="{{ $category->name }}" class="form-control"
                                    id="name" placeholder="{{ translate('Name') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="visibility" class="col-lg-3 col-from-label">{{ translate('Visibility') }}</label>
                            <div class="col-lg-9">
                                <select class="aiz-selectpicker w-100" id="visibility" name="visibility[]" multiple>
                                    @foreach (App\Models\Shop::all() as $shop)
                                        <option value="{{ $shop->id }}"
                                            {{ in_array($shop->id, $visibilityShopIds) ? 'selected' : '' }}>
                                            {{ $shop->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Parent Category') }}</label>
                            <div class="col-md-9">
                                <x-treeview :nodes="$topLevelNodes" treeview-id="parent_id" :selectedCategories="$selectCategoryId" :selectedCategoryNames="$selectCategoryName"
                                    treeview-type="category" :single-select="true" />

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Icon') }}
                                <small>({{ translate('32x32') }})</small></label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="icon" class="selected-files"
                                        value="{{ $category->icon }}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-from-label">{{ translate('Create Date') }}</label>
                            <div class="col-lg-8">
                                <input type="date" class="form-control" name="created_at"
                                    placeholder="{{ translate('Create Date') }}"
                                    value="{{ date('Y-m-d', strtotime($category->created_at)) }}">
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
