@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Product Addon Information') }}</h5>
    </div>

    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">

                <form class="p-4" action="{{ route('product-addons.update', $product_addon->id) }}"
                    method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{ translate('Name') }} <i
                                class="las la-language text-danger" title="{{ translate('Translatable') }}"></i></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Name') }}" id="name" name="product_name"
                                value="{{ $product_addon->name }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{ translate('Other Name') }}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Other Name') }}" id="name" name="other_name"
                                value="{{ $product_addon->other_name }}" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{ translate('Short Name') }} <i
                                class="las la-language text-danger" title="{{ translate('Translatable') }}"></i></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Short Name') }}" id="name" name="short_name"
                                value="{{ $product_addon->short_name }}" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{ translate('Article Group') }} <i
                                class="las la-language text-danger" title="{{ translate('Translatable') }}"></i></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{ translate('Article Group') }}" id="name" name="article_group"
                                value="{{ $product_addon->article_group }}" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{ translate('Unit price') }}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{ translate('Unit price') }}" name="unit_price"
                                class="form-control" value="{{ $product_addon->unit_price }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{ translate('Fake price') }}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{ translate('Fake price') }}" name="fake_price"
                                class="form-control" value="{{ $product_addon->fake_price }}" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{ translate('Quantity') }}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{ translate('Quantity') }}" name="current_stock"
                                class="form-control" value="{{ $product_addon->qty }}" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{ translate('SKU') }}</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="{{ translate('SKU') }}" name="sku"
                                class="form-control" value="{{ $product_addon->sku }}" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="visibility" class="col-lg-3 col-from-label">{{ translate('Visibility') }}</label>
                        <div class="col-lg-8">
                            <select class="aiz-selectpicker w-100" id="visibility" name="visibility[]" multiple>
                                @foreach (App\Models\Shop::all() as $shop)
                                    <option value="{{ $shop->id }}" {{ in_array($shop->id, $visibilityShopIds) ? 'selected' : '' }}>
                                        {{ $shop->name }}
                                    </option>
                                @endforeach
                            </select>
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
