@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">{{ translate('Edit Page Information') }}</h1>
            </div>
        </div>
    </div>
    <div class="card">
        <form class="p-4" action="{{ route('custom-pages.update', $page->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="lang" value="{{ $lang }}">

            <div class="card-header px-0">
                <h6 class="fw-600 mb-0">{{ translate('Page Content') }}</h6>
            </div>
            <div class="card-body px-0">
                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ translate('Title') }} <span
                            class="text-danger">*</span> <i class="las la-language text-danger"
                            title="{{ translate('Translatable') }}"></i></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ translate('Title') }}" name="title"
                            value="{{ $page->getTranslation('title', $lang) }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="signinSrEmail">{{ translate('Banner Image') }}
                    </label>
                    <div class="col-md-10">
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    {{ translate('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="banner" value="{{ $page->banner }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ translate('Link') }} <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <div class="input-group d-block d-md-flex">
                            @if ($page->type == 'custom_page')
                                <div class="input-group-prepend"><span
                                        class="input-group-text flex-grow-1">{{ route('home') }}/</span></div>
                                <input type="text" class="form-control w-100 w-md-auto"
                                    placeholder="{{ translate('Slug') }}" name="slug" value="{{ $page->slug }}">
                            @else
                                <input class="form-control w-100 w-md-auto"
                                    value="{{ route('home') }}/{{ $page->slug }}" disabled>
                            @endif
                        </div>
                        <small class="form-text text-muted">{{ translate('Use character, number, hypen only') }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ translate('Add Content') }} <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="aiz-text-editor form-control" placeholder="{{ translate('Content..') }}"
                            data-buttons='[["font", ["bold", "underline", "italic", "clear"]],["para", ["ul", "ol", "paragraph"]],["style", ["style"]],["color", ["color"]],["table", ["table"]],["insert", ["link", "picture", "video"]],["view", ["fullscreen", "codeview", "undo", "redo"]]]'
                            data-min-height="300" name="content">@php echo $page->getTranslation('content',$lang); @endphp</textarea>
                    </div>
                </div>
            </div>

            <div class="card-header px-0">
                <h6 class="fw-600 mb-0">{{ translate('Seo Fields') }}</h6>
            </div>
            <div class="card-body px-0">

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ translate('Meta Title') }}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="{{ translate('Title') }}"
                            name="meta_title" value="{{ $page->meta_title }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ translate('Meta Description') }}</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="{{ translate('Description') }}"
                            name="meta_description">
                          @php
                              echo $page->meta_description;
                          @endphp
                         </textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ translate('Keywords') }}</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" placeholder="{{ translate('Keyword, Keyword') }}"
                            name="keywords">
                          @php
                              echo $page->keywords;
                          @endphp
                         </textarea>
                        <small class="text-muted">{{ translate('Separate with coma') }}</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-from-label" for="name">{{ translate('Meta Image') }}</label>
                    <div class="col-sm-10">
                        <div class="input-group " data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    {{ translate('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="meta_image" class="selected-files"
                                value="{{ $page->meta_image }}">
                        </div>
                        <div class="file-preview">
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ translate('Update Page') }}</button>
                </div>
            </div>
        </form>
    </div>

    @if ($page->id == 7)
        <h6 class="fw-600 mt-4 mb-3">{{ translate('Page Template Settings') }}</h6>
        {{-- Home Slider --}}
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Design Steps') }}</h6>
            </div>
            <div class="card-body">

                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{ translate('Photos & Links') }}</label>
                        <div class="design-steps7-target">
                            <input type="hidden" name="types[]" value="design_steps7_images">
                            <input type="hidden" name="types[]" value="design_steps7_title">
                            <input type="hidden" name="types[]" value="design_steps7_desc">
                            @if (get_setting('design_steps7_images') != null)
                                @foreach (json_decode(get_setting('design_steps7_images'), true) as $key => $value)
                                    <div class="p-row">
                                        <div class="row gutters-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">
                                                            {{ translate('Choose File') }}
                                                        </div>
                                                        <input type="hidden" name="types[]" value="design_steps7_images">
                                                        <input type="hidden" name="design_steps7_images[]"
                                                            class="selected-files"
                                                            value="{{ json_decode(get_setting('design_steps7_images'), true)[$key] }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="design_steps7_title">
                                                    <input type="text" class="form-control" placeholder="Title"
                                                        name="design_steps7_title[]"
                                                        value="{{ json_decode(get_setting('design_steps7_title'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button"
                                                        class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                        data-toggle="remove-parent" data-parent=".p-row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters-5">

                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="design_steps7_desc">
                                                    <input type="text" class="form-control" placeholder="Overview"
                                                        name="design_steps7_desc[]"
                                                        value="{{ json_decode(get_setting('design_steps7_desc'), true)[$key] }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more" data-content='
               <div class="p-row">
                                        <div class="row gutters-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="design_steps7_images">
                                                        <input type="hidden" name="design_steps7_images[]" class="selected-files" value="">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="design_steps7_title">
                                                    <input type="text" class="form-control" placeholder="Title" name="design_steps7_title[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters-5">

                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="design_steps7_desc">
                                                    <input type="text" class="form-control" placeholder="Overview" name="design_steps7_desc[]" value="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>' data-target=".design-steps7-target">
                            {{ translate('Add New') }}
                        </button>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update Section') }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif


    @if ($page->id == 8)
        <h6 class="fw-600 mt-4 mb-3">{{ translate('Page Template Settings') }}</h6>
        {{-- Home Slider --}}
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('We Also Provide') }}</h6>
            </div>
            <div class="card-body">

                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{ translate('Photos & Links') }}</label>
                        <div class="also-provide8-target">
                            <input type="hidden" name="types[]" value="also_provide8_images">
                            <input type="hidden" name="types[]" value="also_provide8_title">
                            <input type="hidden" name="types[]" value="also_provide8_desc">
                            <input type="hidden" name="types[]" value="also_provide8_price">
                            @if (get_setting('also_provide8_images') != null)
                                @foreach (json_decode(get_setting('also_provide8_images'), true) as $key => $value)
                                    <div class="p-row">
                                        <div class="row gutters-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader"
                                                        data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">
                                                            {{ translate('Choose File') }}
                                                        </div>
                                                        <input type="hidden" name="types[]" value="also_provide8_images">
                                                        <input type="hidden" name="also_provide8_images[]"
                                                            class="selected-files"
                                                            value="{{ json_decode(get_setting('also_provide8_images'), true)[$key] }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="also_provide8_title">
                                                    <input type="text" class="form-control" placeholder="Title"
                                                        name="also_provide8_title[]"
                                                        value="{{ json_decode(get_setting('also_provide8_title'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button"
                                                        class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                        data-toggle="remove-parent" data-parent=".p-row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters-5">

                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="also_provide8_desc">
                                                    <input type="text" class="form-control" placeholder="Overview"
                                                        name="also_provide8_desc[]"
                                                        value="{{ json_decode(get_setting('also_provide8_desc'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="also_provide8_price">
                                                    <input type="text" class="form-control" placeholder="Price"
                                                        name="also_provide8_price[]"
                                                        value="{{ json_decode(get_setting('also_provide8_price'), true)[$key] }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more" data-content='
                                                <div class="p-row">
                                                <div class="row gutters-5">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                                </div>
                                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                                <input type="hidden" name="types[]" value="also_provide8_images">
                                                                <input type="hidden" name="also_provide8_images[]" class="selected-files" value="">
                                                            </div>
                                                            <div class="file-preview box sm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[]" value="also_provide8_title">
                                                            <input type="text" class="form-control" placeholder="Title" name="also_provide8_title[]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-auto">
                                                        <div class="form-group">
                                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                                                <i class="las la-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row gutters-5">

                                                    <div class="col-md">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[]" value="also_provide8_desc">
                                                            <input type="text" class="form-control" placeholder="Overview" name="also_provide8_desc[]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <input type="hidden" name="types[]" value="also_provide8_price">
                                                            <input type="text" class="form-control" placeholder="Price"
                                                                name="also_provide8_price[]"
                                                                value="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>' data-target=".also-provide8-target">
                            {{ translate('Add New') }}
                        </button>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update Section') }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif


    {{-- style quiz --}}
    @if ($page->id == 11)
        <h6 class="fw-600 mt-4 mb-3">{{ translate('Page Template Settings') }}</h6>
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Template Content') }}</h6>
            </div>
            <div class="card-body">

                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{ translate('Photos & Links') }}</label>
                        <div class="template-content11-target">
                            <input type="hidden" name="types[]" value="template_content11_images">
                            <input type="hidden" name="types[]" value="template_content11_title">
                            <input type="hidden" name="types[]" value="template_content11_desc">
                            @if (get_setting('template_content11_images') != null)
                                @foreach (json_decode(get_setting('template_content11_images'), true) as $key => $value)
                                    <div class="p-row">
                                        <div class="row gutters-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader"
                                                        data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">
                                                            {{ translate('Choose File') }}
                                                        </div>
                                                        <input type="hidden" name="types[]"
                                                            value="template_content11_images">
                                                        <input type="hidden" name="template_content11_images[]"
                                                            class="selected-files"
                                                            value="{{ json_decode(get_setting('template_content11_images'), true)[$key] }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="template_content11_title">
                                                    <input type="text" class="form-control" placeholder="Title"
                                                        name="template_content11_title[]"
                                                        value="{{ json_decode(get_setting('template_content11_title'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button"
                                                        class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                        data-toggle="remove-parent" data-parent=".p-row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters-5">

                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="template_content11_desc">
                                                    <input type="text" class="form-control" placeholder="Overview"
                                                        name="template_content11_desc[]"
                                                        value="{{ json_decode(get_setting('template_content11_desc'), true)[$key] }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more" data-content='
               <div class="p-row">
                                        <div class="row gutters-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="template_content11_images">
                                                        <input type="hidden" name="template_content11_images[]" class="selected-files" value="">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="template_content11_title">
                                                    <input type="text" class="form-control" placeholder="Title" name="template_content11_title[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters-5">

                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="template_content11_desc">
                                                    <input type="text" class="form-control" placeholder="Overview" name="template_content11_desc[]" value="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>' data-target=".template-content11-target">
                            {{ translate('Add New') }}
                        </button>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update Section') }}</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Home Slider --}}
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Poplar Designs') }}</h6>
            </div>
            <div class="card-body">

                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>{{ translate('Photos & Links') }}</label>
                        <div class="poplar-design11-target">
                            <input type="hidden" name="types[]" value="poplar_design11_images">
                            <input type="hidden" name="types[]" value="poplar_design11_title">
                            <input type="hidden" name="types[]" value="poplar_design11_desc">
                            @if (get_setting('poplar_design11_images') != null)
                                @foreach (json_decode(get_setting('poplar_design11_images'), true) as $key => $value)
                                    <div class="p-row">
                                        <div class="row gutters-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader"
                                                        data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">
                                                            {{ translate('Choose File') }}
                                                        </div>
                                                        <input type="hidden" name="types[]"
                                                            value="poplar_design11_images">
                                                        <input type="hidden" name="poplar_design11_images[]"
                                                            class="selected-files"
                                                            value="{{ json_decode(get_setting('poplar_design11_images'), true)[$key] }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="poplar_design11_title">
                                                    <input type="text" class="form-control" placeholder="Title"
                                                        name="poplar_design11_title[]"
                                                        value="{{ json_decode(get_setting('poplar_design11_title'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button"
                                                        class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                        data-toggle="remove-parent" data-parent=".p-row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters-5">

                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="poplar_design11_desc">
                                                    <input type="text" class="form-control" placeholder="Overview"
                                                        name="poplar_design11_desc[]"
                                                        value="{{ json_decode(get_setting('poplar_design11_desc'), true)[$key] }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more" data-content='
               <div class="p-row">
                                        <div class="row gutters-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="poplar_design11_images">
                                                        <input type="hidden" name="poplar_design11_images[]" class="selected-files" value="">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="poplar_design11_title">
                                                    <input type="text" class="form-control" placeholder="Title" name="poplar_design11_title[]" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters-5">

                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="poplar_design11_desc">
                                                    <input type="text" class="form-control" placeholder="Overview" name="poplar_design11_desc[]" value="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>' data-target=".poplar-design11-target">
                            {{ translate('Add New') }}
                        </button>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update Section') }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

@endsection
