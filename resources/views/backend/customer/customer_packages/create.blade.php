@extends('backend.layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Create New Package') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('customer_packages.store') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="name">{{ translate('Package Name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="name">{{ translate('Sub Title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="ONLINE CONSULT" id="name" name="sub_title"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="name">{{ translate('Sub sub Title') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="< 150 sq ft." id="name" name="sub_sub_title"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="name">{{ translate('Locations') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="All Locations" id="name" name="locations"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label" for="name">{{ translate('Amount') }}</label>
                            <div class="col-sm-9">
                                <input type="number" lang="en" min="0" step="0.01" placeholder="{{ translate('Amount') }}"
                                    id="amount" name="amount" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Package logo') }}
                                <small>(327x219)</small>
                            </label>

                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="logo" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Main Image') }}
                                <small>(100x570)</small>
                            </label>

                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="main_image" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>{{ translate('Feature List') }}</label>
                            </div>
                            <div class="col-md-9">
                                <div class="feature_list">
                                    <div class="row gutters-5">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="feature_list[]" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <button type="button"
                                                    class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                    data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                    data-content='
                                        <div class="row gutters-5">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="feature_list[]" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button"
                                                        class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                        data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>' data-target=".feature_list">
                                    {{ translate('Add New List') }}
                                </button>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-3"> <label>{{ translate('Include List') }}</label></div>
                            <div class="col-md-9">
                                <div class="include_list">
                                    <div class="row gutters-5">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="include_list[]" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-auto">
                                            <div class="form-group">
                                                <button type="button"
                                                    class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                    data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                    data-content='
                                            <div class="row gutters-5">
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="include_list[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-auto">
                                                    <div class="form-group">
                                                        <button type="button"
                                                            class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                            data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>' data-target=".include_list">
                                    {{ translate('Add New Include Item') }}
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
    </div>

@endsection
