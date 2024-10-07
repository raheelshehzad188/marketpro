@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Category Information') }}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('categories.store') }}" method="POST"
                        enctype="multipart/form-data" name="store_data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Name') }}</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="visibility" class="col-lg-3 col-from-label">Visibility</label>
                            <div class="col-lg-9">
                                <select class="aiz-selectpicker w-100" id="visibility" name="visibility[]" multiple>
                                    @foreach (App\Models\Shop::all() as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Parent Category') }}</label>
                            <div class="col-md-9">
                                <x-treeview :nodes="$topLevelNodes" treeview-id="parent_id" :single-select="true"
                                    treeview-type="category" />
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
                                    <input type="hidden" name="icon" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
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

    <div class="row mt-5 pt-5">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Sync Product Parts') }}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('categories.copy') }}" method="POST"
                        enctype="multipart/form-data" name="copy_data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label fw-500">{{ translate('Source') }}</label>
                            <div class="col-md-9">
                                <x-treeview :nodes="$topLevelNodes" treeview-id="source_products" treeview-type="product"
                                    :single-select="true" />


                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label fw-500">{{ translate('Target') }}</label>
                            <div class="col-md-9">
                                <x-treeview :nodes="$topLevelNodes" treeview-id="target_products" treeview-type="product"
                                    :single-select="true" />



                            </div>
                        </div>



                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Copy') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 pt-5">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Sync Categories') }} with (Product Link)</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('categories_all.copy') }}" method="POST"
                        enctype="multipart/form-data" name="copy_data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label fw-500">{{ translate('Source') }}</label>
                            <div class="col-md-9">
                                <x-treeview :nodes="$topLevelNodes" treeview-id="source_category" treeview-type="category"
                                    :single-select="true" />



                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label fw-500">{{ translate('Target') }}</label>
                            <div class="col-md-9">
                                <x-treeview :nodes="$topLevelNodes" treeview-id="target_category" treeview-type="category"
                                    :single-select="true" />
                            </div>
                        </div>



                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Copy Categories') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="row mt-5 pt-5">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Sync Categories') }} with (Product Version)</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('categories_all.copy.product_version') }}"
                        method="POST" enctype="multipart/form-data" name="copy_data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label fw-500">{{ translate('Source') }}</label>
                            <div class="col-md-9">
                                <x-treeview :nodes="$topLevelNodes" treeview-id="source_category1" treeview-type="category"
                                    :single-select="true" />
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 col-form-label fw-500">{{ translate('Target') }}</label>
                            <div class="col-md-9">
                                <x-treeview :nodes="$topLevelNodes" treeview-id="target_category1" treeview-type="category"
                                    :single-select="true" />
                            </div>
                        </div>



                        <div class="form-group mb-0 text-right">
                            <button type="submit"
                                class="btn btn-primary">{{ translate('Copy Categories and Products') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function loadProducts(id, target) {
            var target_elem = $('.' + target);

            $.get('{{ route('categories.get_products') }}', {
                id: id,
                target: target,
                noCache: Math.random()
            }, function(data) {
                target_elem.html('');
                target_elem.html(data);
            });
        }
    </script>
@endsection
