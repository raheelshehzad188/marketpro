@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Add New Product') }}</h5>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" action="{{ route('products.store') }}" method="POST"
            enctype="multipart/form-data" id="choice_form">
            <div class="row gutters-5">
                <div class="col-lg-12">
                    @csrf
                    <input type="hidden" name="added_by" value="admin">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Product Information') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Product Name') }} <i
                                        class="las la-language text-danger"
                                        title="{{ translate('Translatable') }}"></i></label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="name"
                                        placeholder="{{ translate('Product Name') }}"
                                        value="" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Other Name') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="other_name"
                                        placeholder="{{ translate('Other Name') }}"
                                        value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Short Name') }}</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="short_name"
                                        placeholder="{{ translate('Short Name') }}"
                                        value="" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Article Group') }} <i
                                        class="las la-language text-danger"
                                        title="{{ translate('Translatable') }}"></i></label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="article_group"
                                        placeholder="{{ translate('Article Group') }}"
                                        value="" >
                                </div>
                            </div>

                            <div class="form-group row" id="category">
                                <label class="col-lg-3 col-from-label">{{ translate('Category') }}</label>
                                <div class="col-lg-8">
                                    <select class="form-control aiz-selectpicker" multiple name="category[]"
                                        id="category_id"
                                        data-live-search="true" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}</option>
                                            @foreach ($category->childrenCategories as $childCategory)
                                                @include('categories.child_category', [
                                                    'child_category' => $childCategory,
                                                ])
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Product Images') }}</h5>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Main Image') }}
                                    <small>(300x300)</small></label>
                                <div class="col-md-8">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                {{ translate('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="thumbnail_img" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>



                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Product Spare Parts') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row gutters-5">
                                <div class="col-lg-3">
                                    <input type="text" class="form-control" value="{{ translate('Addons') }}" disabled>
                                </div>
                                <div class="col-lg-8">
                                    <select name="addons[]" id="" data-selected-text-format="count" data-live-search="true"
                                        class="form-control aiz-selectpicker" multiple
                                        data-placeholder="{{ translate('Choose Addons') }}" id="addons"
                                        onchange=" update_sku()">
                                        @foreach (\App\ProductAddon::all() as $key => $addon)
                                            <option value="{{ $addon->id }}">
                                                {{ $addon->name }} - {{ $addon->sku }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="">
                                    <p>{{ translate('Choose the spare parts of this product and then input values of each part') }}
                                    </p>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Product price + stock') }}</h5>
                        </div>
                        <div class="card-body">


                            <div id="show-hide-div">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-from-label">{{ translate('Unit price') }}</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="{{ translate('Unit price') }}" name="unit_price"
                                            class="form-control" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-from-label">{{ translate('Fake price') }}</label>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="{{ translate('Fake price') }}" name="fake_price"
                                            class="form-control" value="">
                                    </div>
                                </div>


                                <div class="form-group row" id="quantity">
                                    <label class="col-lg-3 col-from-label">{{ translate('Quantity') }}</label>
                                    <div class="col-lg-6">
                                        <input type="number" lang="en"
                                            value="" step="1"
                                            placeholder="{{ translate('Quantity') }}" name="current_stock"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-from-label">
                                        {{ translate('SKU') }}
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" placeholder="{{ translate('SKU') }}"
                                            value="" name="sku"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="sku_combination" id="sku_combination">

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{ translate('Product Description') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-from-label">{{ translate('Description') }} <i
                                        class="las la-language text-danger"
                                        title="{{ translate('Translatable') }}"></i></label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-12">
                    <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">

                        <div class="btn-group" role="group" aria-label="Second group">
                            <button type="submit" name="button" value="publish"
                                class="btn btn-success">{{ translate('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        update_sku();
    });

    $("[name=shipping_type]").on("change", function() {
        show_hide_shipping_div();
    });

    function show_hide_shipping_div() {
        var shipping_val = $("[name=shipping_type]:checked").val();

        $(".flat_rate_shipping_div").hide();

        if (shipping_val == 'flat_rate') {
            $(".flat_rate_shipping_div").show();
        }
    }

    function add_more_customer_choice_option(i, name) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{ route('products.add-more-choice-option') }}',
            data: {
                attribute_id: i
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#customer_choice_options').append('\
                                            <div class="form-group row">\
                                                <div class="col-md-3">\
                                                    <input type="hidden" name="choice_no[]" value="' + i + '">\
                                                    <input type="text" class="form-control" name="choice[]" value="' +
                    name +
                    '" placeholder="{{ translate('Choice Title') }}" readonly>\
                                                </div>\
                                                <div class="col-md-8">\
                                                    <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_' +
                    i + '[]" multiple>\
                                                        ' + obj + '\
                                                    </select>\
                                                </div>\
                                            </div>');
                AIZ.plugins.bootstrapSelect('refresh');
            }
        });


    }




    function update_sku() {
        $.ajax({
            type: "POST",
            url: '{{ route('products.addon_combination_edit') }}',
            data: $('#choice_form').serialize(),
            success: function(data) {
                $('#sku_combination').html(data);
                AIZ.uploader.previewGenerate();
                AIZ.plugins.fooTable();
                if (data.length > 1) {
                    $('#show-hide-div').hide();
                } else {
                    $('#show-hide-div').show();
                }
            }
        });
    }

</script>
@endsection
