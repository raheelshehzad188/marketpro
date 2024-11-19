@extends('backend.layouts.app')

@section('content')
    <!-- Knobby Category Import Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Knobby Category Import') }}</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <strong>{{ translate('Instructions:') }}</strong>
                <p>1. {{ translate('Download the skeleton file for Knobby Category and fill it with proper data.') }}</p>
                <p>2.
                    {{ translate('Refer to the example file to understand how the Knobby Category data must be organized.') }}
                </p>
                <p>3. {{ translate('Once you have completed the file, upload it in the form below and submit.') }}</p>
                <p>4.
                    {{ translate('After uploading, make any necessary edits to ensure all category details are correct.') }}
                </p>
                <p>
                    <a href="{{ static_asset('download/knobby_category_sample.xlsx') }}" target="_blank">
                        <button class="btn btn-primary">{{ translate('Download Knobby Category CSV') }}</button>
                    </a>
                </p>
            </div>

            <form class="form-horizontal mt-3" action="{{ route('categories.import') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
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
                    <label for="visibility" class="col-lg-3 col-from-label">Select File</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <label class="custom-file-label">
                                <input type="file" name="knobby_bulk_file" class="custom-file-input" required>
                                <span class="custom-file-name">{{ translate('Choose File') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 mt-3">
                    <button type="submit" class="btn btn-info">{{ translate('Upload') }}</button>
                </div>
            </form>

        </div>
    </div>
@endsection
