@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0 h6">{{translate('Terms & Conditions Management')}}</h1>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label">{{translate('Terms & Conditions Content')}} <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="types[]" value="terms_and_conditions">
                            <textarea class="aiz-text-editor form-control" 
                                data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                                data-min-height="400" 
                                name="terms_and_conditions" 
                                placeholder="{{ translate('Enter Terms & Conditions content here...') }}"
                                required>{{ get_setting('terms_and_conditions', '') }}</textarea>
                            <small class="form-text text-muted">{{ translate('This content will be displayed on the Terms & Conditions page and linked from the checkout page.') }}</small>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update Terms & Conditions') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

