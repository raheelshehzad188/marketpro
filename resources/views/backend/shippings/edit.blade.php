@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{ translate('Shipping Information') }}</h5>
</div>
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('shippings.update', $shipping->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Name') }} <i class="las la-language text-danger" title="{{ translate('Translatable') }}"></i></label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{ $shipping->name }}" class="form-control" placeholder="{{ translate('Name') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Cost') }}</label>
                        <div class="col-md-9">
                            <input type="number" name="cost" value="{{ $shipping->cost }}" class="form-control" placeholder="{{ translate('Cost') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Country') }}</label>
                        <div class="col-md-9">
                            <select name="country_id" class="aiz-selectpicker w-100"  data-live-search="true">
                                <option value="">{{ translate('Select Country') }}</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $shipping->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{ translate('Visibility') }}</label>
                        <div class="col-md-9">
                            <select name="visibility[]" class="aiz-selectpicker w-100" multiple data-live-search="true">
                                @foreach(App\Models\Shop::all() as $shop)
                                    <option value="{{ $shop->id }}" {{ in_array($shop->id, $visibilityShopIds) ? 'selected' : '' }}>{{ $shop->name }}</option>
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
</div>
@endsection
