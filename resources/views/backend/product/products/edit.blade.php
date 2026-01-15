@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h1 class="mb-0 h6">{{ translate('Edit Product') }}</h1>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" action="{{ route('products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data" id="choice_form">
            <div class="row gutters-5">
                <div class="col-lg-12">
                    <input name="_method" type="hidden" value="POST">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                    
                    <!-- Product Information -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Product Information') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Product Name') }} <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="name"
                                        placeholder="{{ translate('Product Name') }}"
                                        value="{{ $product->getTranslation('name', $lang) }}" required>
                                </div>
                            </div>

                            <div class="form-group row" id="category">
                                <label class="col-lg-3 col-from-label">{{ translate('Category') }} <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <select class="form-control aiz-selectpicker" name="category_id" id="category_id" data-live-search="true" required>
                                        <option value="">{{ translate('Select Category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                            @foreach ($category->childrenCategories as $childCategory)
                                                <option value="{{ $childCategory->id }}" {{ $product->category_id == $childCategory->id ? 'selected' : '' }}>
                                                    &nbsp;&nbsp;{{ $childCategory->name }}
                                                </option>
                                                @if($childCategory->categories)
                                                    @foreach ($childCategory->categories as $subChildCategory)
                                                        <option value="{{ $subChildCategory->id }}" {{ $product->category_id == $subChildCategory->id ? 'selected' : '' }}>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $subChildCategory->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Brand') }}</label>
                                <div class="col-lg-8">
                                    <select class="form-control aiz-selectpicker" name="brand_id" data-live-search="true">
                                        <option value="">{{ translate('Select Brand') }}</option>
                                        @foreach (\App\Models\Brand::all() as $brand)
                                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Images -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Product Images') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">{{ translate('Main Image') }}
                                    <small>(300x300)</small></label>
                                <div class="col-md-8">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                {{ translate('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="thumbnail_img" value="{{ $product->thumbnail_img }}"
                                            class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Price & Stock -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Product Price & Stock') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Unit Price') }} <span class="text-danger">*</span></label>
                                <div class="col-lg-6">
                                    <input type="number" step="0.01" placeholder="{{ translate('Unit price') }}"
                                        name="unit_price" class="form-control" value="{{ $product->unit_price }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Quantity') }}</label>
                                <div class="col-lg-6">
                                    <input type="number" lang="en" value="{{ $product->current_stock }}"
                                        step="1" placeholder="{{ translate('Quantity') }}"
                                        name="current_stock" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">{{ translate('SKU') }}</label>
                                <div class="col-md-6">
                                    <input type="text" placeholder="{{ translate('SKU') }}"
                                        value="{{ $product->sku }}" name="sku" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Product Description') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Description') }}</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="description" rows="5" placeholder="{{ translate('Product Description') }}">{{ $product->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Settings -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('SEO Settings') }}</h5>
                        </div>
                        <div class="card-body">
                                <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Meta Title') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="meta_title"
                                        placeholder="{{ translate('Meta Title') }}" value="{{ $product->meta_title ?? '' }}">
                                    <small class="text-muted">{{ translate('Recommended: 50-60 characters') }}</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Meta Description') }}</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" name="meta_description" rows="3"
                                        placeholder="{{ translate('Meta Description') }}">{{ $product->meta_description ?? '' }}</textarea>
                                    <small class="text-muted">{{ translate('Recommended: 150-160 characters') }}</small>
                                </div>
                                    </div>

                                <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Meta Keywords') }}</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" name="meta_keywords" rows="2"
                                        placeholder="{{ translate('Keyword, Keyword') }}">{{ $product->meta_keywords ?? '' }}</textarea>
                                    <small class="text-muted">{{ translate('Separate with comma') }}</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Slug') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="slug"
                                        placeholder="{{ translate('Product Slug (URL)') }}" value="{{ $product->slug ?? '' }}">
                                    <small class="text-muted">{{ translate('Leave empty to auto-generate from product name') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3 text-right">
                        <button type="submit" name="button"
                            class="btn btn-info">{{ translate('Update Product') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    @include('backend.product.products.script')
@endsection
