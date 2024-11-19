@extends('backend.layouts.app')
@section('content')

    <div class="row">
        <div class="col-xl-10 mx-auto">
            <h6 class="fw-600">{{ translate('Home Page Settings') }}</h6>


            {{-- Hero Slider --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Hero Slider') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Images & Links') }}</label>
                            <div class="hero-slider-target">
                                <input type="hidden" name="types[]" value="hero_slider_images">
                                <input type="hidden" name="types[]" value="hero_slider_links">

                                @if (get_setting('hero_slider_images') != null)
                                    @foreach (json_decode(get_setting('hero_slider_images'), true) as $key => $value)
                                        <div class="p-row">
                                            <div class="row gutters-5">
                                                <!-- Image Upload -->
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
                                                                {{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="types[]" value="hero_slider_images">
                                                            <input type="hidden" name="hero_slider_images[]"
                                                                class="selected-files"
                                                                value="{{ json_decode(get_setting('hero_slider_images'), true)[$key] }}">
                                                        </div>
                                                        <div class="file-preview box sm"></div>
                                                    </div>
                                                </div>

                                                <!-- Link Input -->
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]" value="hero_slider_links">
                                                        <input type="text" class="form-control" placeholder="http://"
                                                            name="hero_slider_links[]"
                                                            value="{{ json_decode(get_setting('hero_slider_links'), true)[$key] }}">
                                                    </div>
                                                </div>

                                                <!-- Remove Button -->
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
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Add New Button -->
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                data-content='
                        <div class="p-row">
                            <div class="row gutters-5">
                                <!-- Image Upload -->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="types[]" value="hero_slider_images">
                                            <input type="hidden" name="hero_slider_images[]" class="selected-files" value="">
                                        </div>
                                        <div class="file-preview box sm"></div>
                                    </div>
                                </div>

                                <!-- Link Input -->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="hero_slider_links">
                                        <input type="text" class="form-control" placeholder="http://" name="hero_slider_links[]" value="">
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>'
                                data-target=".hero-slider-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>

                        <!-- Update Button -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>


            {{-- Advert Banner --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Advert Banner') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Banner Image & Link') }}</label>
                            <div class="advert-banner-target">
                                <input type="hidden" name="types[]" value="advert_banner_image">
                                <input type="hidden" name="types[]" value="advert_banner_link">

                                @if (get_setting('advert_banner_image') != null)
                                    @foreach (json_decode(get_setting('advert_banner_image'), true) as $key => $value)
                                        <div class="p-row">
                                            <div class="row gutters-5">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <div class="input-group" data-toggle="aizuploader"
                                                            data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div
                                                                    class="input-group-text bg-soft-secondary font-weight-medium">
                                                                    {{ translate('Browse') }}
                                                                </div>
                                                            </div>
                                                            <div class="form-control file-amount">
                                                                {{ translate('Choose File') }}
                                                            </div>
                                                            <input type="hidden" name="types[]"
                                                                value="advert_banner_image">
                                                            <input type="hidden" name="advert_banner_image[]"
                                                                class="selected-files"
                                                                value="{{ json_decode(get_setting('advert_banner_image'), true)[$key] }}">
                                                        </div>
                                                        <div class="file-preview box sm"></div>
                                                    </div>
                                                </div>

                                                <!-- Banner Link Input -->
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]" value="advert_banner_link">
                                                        <input type="text" class="form-control" placeholder="http://"
                                                            name="advert_banner_link[]"
                                                            value="{{ json_decode(get_setting('advert_banner_link'), true)[$key] }}">
                                                    </div>
                                                </div>

                                                <!-- Remove Button -->
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
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Add New Button -->
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                data-content='
                    <div class="p-row">
                        <div class="row gutters-5">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="types[]" value="advert_banner_image">
                                        <input type="hidden" name="advert_banner_image[]" class="selected-files" value="">
                                    </div>
                                    <div class="file-preview box sm"></div>
                                </div>
                            </div>

                            <!-- Banner Link Input -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input type="hidden" name="types[]" value="advert_banner_link">
                                    <input type="text" class="form-control" placeholder="http://" name="advert_banner_link[]" value="">
                                </div>
                            </div>

                            <!-- Remove Button -->
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                        <i class="las la-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>'
                                data-target=".advert-banner-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Top Category Boxes --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Top Category Boxes') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Category Boxes') }}</label>
                            <div class="top-category-boxes-target">
                                <input type="hidden" name="types[]" value="top_category_images">
                                <input type="hidden" name="types[]" value="top_category_names">
                                <input type="hidden" name="types[]" value="top_category_links">

                                @if (get_setting('top_category_images') != null)
                                    @foreach (json_decode(get_setting('top_category_images'), true) as $key => $value)
                                        <div class="p-row">
                                            <div class="row gutters-5">
                                                <!-- Image Upload -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="input-group" data-toggle="aizuploader"
                                                            data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div
                                                                    class="input-group-text bg-soft-secondary font-weight-medium">
                                                                    {{ translate('Browse') }}</div>
                                                            </div>
                                                            <div class="form-control file-amount">
                                                                {{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="types[]"
                                                                value="top_category_images">
                                                            <input type="hidden" name="top_category_images[]"
                                                                class="selected-files"
                                                                value="{{ json_decode(get_setting('top_category_images'), true)[$key] }}">
                                                        </div>
                                                        <div class="file-preview box sm"></div>
                                                    </div>
                                                </div>

                                                <!-- Category Name -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]" value="top_category_names">
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ translate('Category Name') }}"
                                                            name="top_category_names[]"
                                                            value="{{ json_decode(get_setting('top_category_names'), true)[$key] }}">
                                                    </div>
                                                </div>

                                                <!-- Category Link -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]" value="top_category_links">
                                                        <input type="text" class="form-control" placeholder="http://"
                                                            name="top_category_links[]"
                                                            value="{{ json_decode(get_setting('top_category_links'), true)[$key] }}">
                                                    </div>
                                                </div>

                                                <!-- Remove Button -->
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
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Add New Button -->
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                data-content='
                        <div class="p-row">
                            <div class="row gutters-5">
                                <!-- Image Upload -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="types[]" value="top_category_images">
                                            <input type="hidden" name="top_category_images[]" class="selected-files" value="">
                                        </div>
                                        <div class="file-preview box sm"></div>
                                    </div>
                                </div>

                                <!-- Category Name -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="top_category_names">
                                        <input type="text" class="form-control" placeholder="{{ translate('Category Name') }}" name="top_category_names[]" value="">
                                    </div>
                                </div>

                                <!-- Category Link -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="top_category_links">
                                        <input type="text" class="form-control" placeholder="http://" name="top_category_links[]" value="">
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>'
                                data-target=".top-category-boxes-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>

                        <!-- Update Button -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>





            {{-- Additional Category Boxes --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Additional Category Boxes') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Additional Category Boxes') }}</label>
                            <div class="additional-category-boxes-target">
                                <input type="hidden" name="types[]" value="additional_category_images">
                                <input type="hidden" name="types[]" value="additional_category_names">
                                <input type="hidden" name="types[]" value="additional_category_links">

                                @if (get_setting('additional_category_images') != null)
                                    @foreach (json_decode(get_setting('additional_category_images'), true) as $key => $value)
                                        <div class="p-row">
                                            <div class="row gutters-5">
                                                <!-- Image Upload -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="input-group" data-toggle="aizuploader"
                                                            data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div
                                                                    class="input-group-text bg-soft-secondary font-weight-medium">
                                                                    {{ translate('Browse') }}</div>
                                                            </div>
                                                            <div class="form-control file-amount">
                                                                {{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="types[]"
                                                                value="additional_category_images">
                                                            <input type="hidden" name="additional_category_images[]"
                                                                class="selected-files"
                                                                value="{{ json_decode(get_setting('additional_category_images'), true)[$key] }}">
                                                        </div>
                                                        <div class="file-preview box sm"></div>
                                                    </div>
                                                </div>

                                                <!-- Category Name -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]"
                                                            value="additional_category_names">
                                                        <input type="text" class="form-control"
                                                            placeholder="{{ translate('Category Name') }}"
                                                            name="additional_category_names[]"
                                                            value="{{ json_decode(get_setting('additional_category_names'), true)[$key] }}">
                                                    </div>
                                                </div>

                                                <!-- Category Link -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]"
                                                            value="additional_category_links">
                                                        <input type="text" class="form-control" placeholder="http://"
                                                            name="additional_category_links[]"
                                                            value="{{ json_decode(get_setting('additional_category_links'), true)[$key] }}">
                                                    </div>
                                                </div>

                                                <!-- Remove Button -->
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
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Add New Button -->
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                data-content='
                        <div class="p-row">
                            <div class="row gutters-5">
                                <!-- Image Upload -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="types[]" value="additional_category_images">
                                            <input type="hidden" name="additional_category_images[]" class="selected-files" value="">
                                        </div>
                                        <div class="file-preview box sm"></div>
                                    </div>
                                </div>

                                <!-- Category Name -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="additional_category_names">
                                        <input type="text" class="form-control" placeholder="{{ translate('Category Name') }}" name="additional_category_names[]" value="">
                                    </div>
                                </div>

                                <!-- Category Link -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="additional_category_links">
                                        <input type="text" class="form-control" placeholder="http://" name="additional_category_links[]" value="">
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>'
                                data-target=".additional-category-boxes-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>

                        <!-- Update Button -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>



            {{-- Bottom Banners --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Bottom Banners') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Banner Images & Links') }}</label>
                            <div class="bottom-banners-target">
                                <input type="hidden" name="types[]" value="bottom_banner_images">
                                <input type="hidden" name="types[]" value="bottom_banner_links">

                                @if (get_setting('bottom_banner_images') != null)
                                    @foreach (json_decode(get_setting('bottom_banner_images'), true) as $key => $value)
                                        <div class="p-row">
                                            <div class="row gutters-5">
                                                <!-- Image Upload -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="input-group" data-toggle="aizuploader"
                                                            data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div
                                                                    class="input-group-text bg-soft-secondary font-weight-medium">
                                                                    {{ translate('Browse') }}</div>
                                                            </div>
                                                            <div class="form-control file-amount">
                                                                {{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="types[]"
                                                                value="bottom_banner_images">
                                                            <input type="hidden" name="bottom_banner_images[]"
                                                                class="selected-files"
                                                                value="{{ json_decode(get_setting('bottom_banner_images'), true)[$key] }}">
                                                        </div>
                                                        <div class="file-preview box sm"></div>
                                                    </div>
                                                </div>

                                                <!-- Banner Link -->
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <input type="hidden" name="types[]" value="bottom_banner_links">
                                                        <input type="text" class="form-control" placeholder="http://"
                                                            name="bottom_banner_links[]"
                                                            value="{{ json_decode(get_setting('bottom_banner_links'), true)[$key] }}">
                                                    </div>
                                                </div>

                                                <!-- Remove Button -->
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
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Add New Button -->
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                data-content='
                        <div class="p-row">
                            <div class="row gutters-5">
                                <!-- Image Upload -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="types[]" value="bottom_banner_images">
                                            <input type="hidden" name="bottom_banner_images[]" class="selected-files" value="">
                                        </div>
                                        <div class="file-preview box sm"></div>
                                    </div>
                                </div>

                                <!-- Banner Link -->
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="hidden" name="types[]" value="bottom_banner_links">
                                        <input type="text" class="form-control" placeholder="http://" name="bottom_banner_links[]" value="">
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>'
                                data-target=".bottom-banners-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>

                        <!-- Update Button -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            AIZ.plugins.bootstrapSelect('refresh');
        });
    </script>
@endsection
