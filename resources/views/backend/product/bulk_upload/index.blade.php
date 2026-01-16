@extends('backend.layouts.app')

@section('content')
    <!-- Enhanced Product Bulk Upload with Images Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Product Bulk Upload with Images') }}</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-success">
                <strong>{{ translate('Enhanced Features:') }}</strong>
                <ul class="mb-0">
                    <li>{{ translate('Automatically downloads images from URLs') }}</li>
                    <li>{{ translate('Creates categories automatically if they don\'t exist') }}</li>
                    <li>{{ translate('Creates brands automatically if they don\'t exist') }}</li>
                    <li>{{ translate('Links products to categories and brands') }}</li>
                </ul>
            </div>
            <div class="alert alert-info">
                <strong>{{ translate('Instructions:') }}</strong>
                <p>1. {{ translate('Download the sample Excel file below.') }}</p>
                <p>2. {{ translate('Fill in the required columns: name, sku, price, image_url, category, brand, description') }}</p>
                <p>3. {{ translate('Image URLs will be automatically downloaded and saved.') }}</p>
                <p>4. {{ translate('Categories and brands will be created automatically if they don\'t exist.') }}</p>
                <p class="mt-2">
                    <a href="{{ route('product_bulk_upload.download_sample') }}" target="_blank">
                        <button class="btn btn-primary btn-sm">
                            <i class="las la-download"></i> {{ translate('Download Sample Excel File') }}
                        </button>
                    </a>
                </p>
            </div>

            <form class="form-horizontal mt-3" action="{{ route('bulk_product_upload_with_images') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label">{{ translate('Excel File') }}</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <label class="custom-file-label">
                                <input type="file" name="bulk_file" class="custom-file-input" required accept=".xlsx,.xls,.csv">
                                <span class="custom-file-name">{{ translate('Choose File') }}</span>
                            </label>
                            <small class="form-text text-muted">{{ translate('Supported formats: .xlsx, .xls, .csv') }}</small>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 mt-3">
                    <button type="submit" class="btn btn-info">
                        <i class="las la-upload"></i> {{ translate('Upload Products') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Old Products Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Delete Old Products') }}</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-warning">
                <strong>{{ translate('Warning:') }}</strong>
                <p>{{ translate('This action will permanently delete products and cannot be undone.') }}</p>
                <p>{{ translate('Make sure you have a backup before proceeding.') }}</p>
            </div>

            <form class="form-horizontal mt-3" action="{{ route('product_bulk_upload.delete_old_products') }}" method="POST"
                onsubmit="return confirm('{{ translate('Are you sure you want to delete old products? This action cannot be undone!') }}');">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-from-label">{{ translate('Delete Options') }}</label>
                    <div class="col-sm-9">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="delete_option" id="delete_old" value="30_days" checked>
                            <label class="form-check-label" for="delete_old">
                                {{ translate('Delete products older than 30 days') }}
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="delete_option" id="delete_before_date" value="before_date">
                            <label class="form-check-label" for="delete_before_date">
                                {{ translate('Delete products before date:') }}
                            </label>
                            <input type="date" name="date" class="form-control mt-2" style="max-width: 200px;" id="date_input" disabled>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="delete_option" id="delete_all_products" value="all">
                            <label class="form-check-label text-danger" for="delete_all_products">
                                <strong>{{ translate('Delete ALL products') }}</strong>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 mt-3">
                    <button type="submit" class="btn btn-danger">
                        <i class="las la-trash"></i> {{ translate('Delete Old Products') }}
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteOptions = document.querySelectorAll('input[name="delete_option"]');
        const dateInput = document.getElementById('date_input');
        
        deleteOptions.forEach(option => {
            option.addEventListener('change', function() {
                if (this.value === 'before_date') {
                    dateInput.disabled = false;
                    dateInput.required = true;
                } else {
                    dateInput.disabled = true;
                    dateInput.required = false;
                }
            });
        });
    });
</script>
@endsection
