@extends('backend.layouts.app')

@section('content')
    <!-- Product Bulk Tags Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Product Bulk Tags') }}</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <strong>{{ translate('Instructions:') }}</strong>
                <p>1. {{ translate('Download the skeleton file and fill it with proper data.') }}</p>
                <p>2. {{ translate('You can download the example file to understand how the data must be filled.') }}</p>
                <p>3. {{ translate('Once you have filled the skeleton file, upload it using the form below and submit.') }}
                </p>
                <p>4. {{ translate('After uploading, edit the products to set their images and choices.') }}</p>
                <p> <a href="{{ static_asset('download/product_bulk_sample.xlsx') }}" target="_blank">
                        <button class="btn btn-primary">{{ translate('Download CSV') }}</button>
                    </a></p>
            </div>

            <form class="form-horizontal mt-3" action="{{ route('bulk_product_upload') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <label class="custom-file-label">
                                <input type="file" name="bulk_file" class="custom-file-input" required>
                                <span class="custom-file-name">{{ translate('Choose File') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 mt-3">
                    <button type="submit" class="btn btn-info">{{ translate('Upload CSV') }}</button>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('script')

@endsection
