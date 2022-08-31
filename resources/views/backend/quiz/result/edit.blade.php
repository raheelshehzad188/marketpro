@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Result Information') }}</h5>
    </div>

    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">

                <form class="p-4" action="{{ route('results.update', $result->id) }}" method="POST"
                    enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">

                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">Garden Type 1</label>
                        <div class="col-lg-8">
                            <select class="form-control aiz-selectpicker" name="garden1"
                                data-live-search="true">

                                @foreach (\App\Garden::all() as $value)
                                    <option value="{{ $value->id }}" @if ($result->type1 == $value->id) selected @endif>
                                        {{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">Garden Type 2</label>
                        <div class="col-lg-8">
                            <select class="form-control aiz-selectpicker" name="garden2"
                                data-live-search="true">

                                @foreach (\App\Garden::all() as $value)
                                    <option value="{{ $value->id }}" @if ($result->type2 == $value->id) selected @endif>
                                        {{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">Garden Type 3</label>
                        <div class="col-lg-8">
                            <select class="form-control aiz-selectpicker" name="garden3"
                                data-live-search="true">

                                @foreach (\App\Garden::all() as $value)
                                    <option value="{{ $value->id }}" @if ($result->type3 == $value->id) selected @endif>
                                        {{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Image') }} </label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="logo" value="{{ $result->logo }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('More Images') }}</label>
                        <div class="col-md-8">
                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="more_images" value="{{ $result->more_images }}"
                                    class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label">{{ translate('Description') }}</label>
                        <div class="col-lg-8">
                            <textarea name="description" rows="8"
                                class="form-control">{{ $result->description }}</textarea>
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
