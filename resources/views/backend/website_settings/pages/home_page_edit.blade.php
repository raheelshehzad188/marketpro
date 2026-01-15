@extends('backend.layouts.app')
@section('content')

    <div class="row">
        <div class="col-xl-10 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-600 mb-0">{{ translate('Home Page Settings') }}</h6>
                <form action="{{ route('business_settings.load_home_dummy_data') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-info btn-sm" onclick="return confirm('{{ translate('This will replace all existing home page data with dummy data. Are you sure?') }}')">
                        <i class="las la-download"></i> {{ translate('Load Dummy Data') }}
                    </button>
                </form>
            </div>


            {{-- Hero Slider --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Hero Slider') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Hero Slider Slides') }}</label>
                            <div class="hero-slider-target">
                                <input type="hidden" name="types[]" value="hero_slider_images">
                                <input type="hidden" name="types[]" value="hero_slider_top_heading">
                                <input type="hidden" name="types[]" value="hero_slider_main_heading">
                                <input type="hidden" name="types[]" value="hero_slider_button_text">
                                <input type="hidden" name="types[]" value="hero_slider_button_link">
                                <input type="hidden" name="types[]" value="hero_slider_starting_price">

                                @if (get_setting('hero_slider_images') != null)
                                    @foreach (json_decode(get_setting('hero_slider_images'), true) as $key => $value)
                                        <div class="p-row mb-3 border rounded p-3">
                                            <div class="row gutters-5">
                                                <!-- Slide Image Upload -->
                                                <div class="col-md-12 mb-2">
                                                    <label class="fw-600">{{ translate('Slide Image') }}</label>
                                                    <div class="form-group">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">
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

                                                <!-- Top Heading -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Top Heading') }}</label>
                                                        <input type="hidden" name="types[]" value="hero_slider_top_heading">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Top Heading') }}"
                                                            name="hero_slider_top_heading[]"
                                                            value="{{ json_decode(get_setting('hero_slider_top_heading'), true)[$key] ?? '' }}">
                                                    </div>
                                                </div>

                                                <!-- Main Heading -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Main Heading') }}</label>
                                                        <input type="hidden" name="types[]" value="hero_slider_main_heading">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Main Heading') }}"
                                                            name="hero_slider_main_heading[]"
                                                            value="{{ json_decode(get_setting('hero_slider_main_heading'), true)[$key] ?? '' }}">
                                                    </div>
                                                </div>

                                                <!-- Button Text -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Button Text') }}</label>
                                                        <input type="hidden" name="types[]" value="hero_slider_button_text">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Button Text') }}"
                                                            name="hero_slider_button_text[]"
                                                            value="{{ json_decode(get_setting('hero_slider_button_text'), true)[$key] ?? 'Explore Shop' }}">
                                                    </div>
                                                </div>

                                                <!-- Button Link -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Button Link') }}</label>
                                                        <input type="hidden" name="types[]" value="hero_slider_button_link">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Button Link') }}"
                                                            name="hero_slider_button_link[]"
                                                            value="{{ json_decode(get_setting('hero_slider_button_link'), true)[$key] ?? '' }}">
                                                    </div>
                                                </div>

                                                <!-- Starting Price -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Starting Price') }}</label>
                                                        <input type="hidden" name="types[]" value="hero_slider_starting_price">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Starting Price') }}"
                                                            name="hero_slider_starting_price[]"
                                                            value="{{ json_decode(get_setting('hero_slider_starting_price'), true)[$key] ?? '' }}">
                                                    </div>
                                                </div>

                                                <!-- Remove Button -->
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label class="fw-600 d-block">&nbsp;</label>
                                                        <button type="button"
                                                            class="btn btn-icon btn-circle btn-sm btn-soft-danger"
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
                        <div class="p-row mb-3 border rounded p-3">
                            <div class="row gutters-5">
                                <!-- Slide Image Upload -->
                                <div class="col-md-12 mb-2">
                                    <label class="fw-600">{{ translate('Slide Image') }}</label>
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

                                <!-- Top Heading -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Top Heading') }}</label>
                                        <input type="hidden" name="types[]" value="hero_slider_top_heading">
                                        <input type="text" class="form-control" placeholder="{{ translate('Top Heading') }}" name="hero_slider_top_heading[]" value="">
                                    </div>
                                </div>

                                <!-- Main Heading -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Main Heading') }}</label>
                                        <input type="hidden" name="types[]" value="hero_slider_main_heading">
                                        <input type="text" class="form-control" placeholder="{{ translate('Main Heading') }}" name="hero_slider_main_heading[]" value="">
                                    </div>
                        </div>

                                <!-- Button Text -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Button Text') }}</label>
                                        <input type="hidden" name="types[]" value="hero_slider_button_text">
                                        <input type="text" class="form-control" placeholder="{{ translate('Button Text') }}" name="hero_slider_button_text[]" value="Explore Shop">
                                    </div>
                                </div>

                                <!-- Button Link -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Button Link') }}</label>
                                        <input type="hidden" name="types[]" value="hero_slider_button_link">
                                        <input type="text" class="form-control" placeholder="{{ translate('Button Link') }}" name="hero_slider_button_link[]" value="">
                                    </div>
                                </div>

                                <!-- Starting Price -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Starting Price') }}</label>
                                        <input type="hidden" name="types[]" value="hero_slider_starting_price">
                                        <input type="text" class="form-control" placeholder="{{ translate('Starting Price') }}" name="hero_slider_starting_price[]" value="">
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label class="fw-600 d-block">&nbsp;</label>
                                        <button type="button" class="btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>'
                                data-target=".hero-slider-target">
                                {{ translate('Add New Slide') }}
                            </button>
                        </div>

                        <!-- Update Button -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Marketing Banners --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Marketing Banners') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Marketing Banners') }}</label>
                            <div class="marketing-banners-target">
                                <input type="hidden" name="types[]" value="marketing_banner_images">
                                <input type="hidden" name="types[]" value="marketing_banner_labels">
                                <input type="hidden" name="types[]" value="marketing_banner_button_text">
                                <input type="hidden" name="types[]" value="marketing_banner_button_url">
                                <input type="hidden" name="types[]" value="marketing_banner_starting_price">

                                @if (get_setting('marketing_banner_images') != null)
                                    @foreach (json_decode(get_setting('marketing_banner_images'), true) as $key => $value)
                                        <div class="p-row mb-3 border rounded p-3">
                                            <div class="row gutters-5">
                                                <!-- Banner Image Upload -->
                                                <div class="col-md-12 mb-2">
                                                    <label class="fw-600">{{ translate('Banner Image') }}</label>
                                                    <div class="form-group">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                                    {{ translate('Browse') }}</div>
                                                            </div>
                                                            <div class="form-control file-amount">
                                                                {{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="types[]" value="marketing_banner_images">
                                                            <input type="hidden" name="marketing_banner_images[]"
                                                                class="selected-files"
                                                                value="{{ json_decode(get_setting('marketing_banner_images'), true)[$key] }}">
                                                        </div>
                                                        <div class="file-preview box sm"></div>
                                                    </div>
                                                </div>

                                                <!-- Label -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Label') }}</label>
                                                        <input type="hidden" name="types[]" value="marketing_banner_labels">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Label') }}"
                                                            name="marketing_banner_labels[]"
                                                            value="{{ json_decode(get_setting('marketing_banner_labels'), true)[$key] ?? '' }}">
                                                    </div>
                                                </div>

                                                <!-- Button Text -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Button Text') }}</label>
                                                        <input type="hidden" name="types[]" value="marketing_banner_button_text">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Button Text') }}"
                                                            name="marketing_banner_button_text[]"
                                                            value="{{ json_decode(get_setting('marketing_banner_button_text'), true)[$key] ?? 'Shop Now' }}">
                                                    </div>
                                                </div>

                                                <!-- Button URL -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Button URL') }}</label>
                                                        <input type="hidden" name="types[]" value="marketing_banner_button_url">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Button URL') }}"
                                                            name="marketing_banner_button_url[]"
                                                            value="{{ json_decode(get_setting('marketing_banner_button_url'), true)[$key] ?? '' }}">
                                                    </div>
                                                </div>

                                                <!-- Starting Price -->
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Starting Price') }}</label>
                                                        <input type="hidden" name="types[]" value="marketing_banner_starting_price">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Starting Price') }}"
                                                            name="marketing_banner_starting_price[]"
                                                            value="{{ json_decode(get_setting('marketing_banner_starting_price'), true)[$key] ?? '' }}">
                                                    </div>
                                                </div>

                                                <!-- Remove Button -->
                                                <div class="col-md-auto">
                                                    <div class="form-group">
                                                        <label class="fw-600 d-block">&nbsp;</label>
                                                        <button type="button"
                                                            class="btn btn-icon btn-circle btn-sm btn-soft-danger"
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
                        <div class="p-row mb-3 border rounded p-3">
                            <div class="row gutters-5">
                                <!-- Banner Image Upload -->
                                <div class="col-md-12 mb-2">
                                    <label class="fw-600">{{ translate('Banner Image') }}</label>
                                    <div class="form-group">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="types[]" value="marketing_banner_images">
                                            <input type="hidden" name="marketing_banner_images[]" class="selected-files" value="">
                                        </div>
                                        <div class="file-preview box sm"></div>
                                    </div>
                                </div>

                                <!-- Label -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Label') }}</label>
                                        <input type="hidden" name="types[]" value="marketing_banner_labels">
                                        <input type="text" class="form-control" placeholder="{{ translate('Label') }}" name="marketing_banner_labels[]" value="">
                            </div>
                        </div>

                                <!-- Button Text -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Button Text') }}</label>
                                        <input type="hidden" name="types[]" value="marketing_banner_button_text">
                                        <input type="text" class="form-control" placeholder="{{ translate('Button Text') }}" name="marketing_banner_button_text[]" value="Shop Now">
                                    </div>
                                </div>

                                <!-- Button URL -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Button URL') }}</label>
                                        <input type="hidden" name="types[]" value="marketing_banner_button_url">
                                        <input type="text" class="form-control" placeholder="{{ translate('Button URL') }}" name="marketing_banner_button_url[]" value="">
                                    </div>
                                </div>

                                <!-- Starting Price -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Starting Price') }}</label>
                                        <input type="hidden" name="types[]" value="marketing_banner_starting_price">
                                        <input type="text" class="form-control" placeholder="{{ translate('Starting Price') }}" name="marketing_banner_starting_price[]" value="">
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <label class="fw-600 d-block">&nbsp;</label>
                                        <button type="button" class="btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>'
                                data-target=".marketing-banners-target">
                                {{ translate('Add New Banner') }}
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

            {{-- Promotional Banners --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Promotional Banners') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Promotional Banners') }}</label>
                            <div class="promotional-banners-target">
                                <input type="hidden" name="types[]" value="home_promotional_images">
                                <input type="hidden" name="types[]" value="home_promotional_titles">
                                <input type="hidden" name="types[]" value="home_promotional_prices">
                                <input type="hidden" name="types[]" value="home_promotional_links">

                                @if (get_setting('home_promotional_images') != null)
                                    @foreach (json_decode(get_setting('home_promotional_images'), true) as $key => $value)
                                        <div class="p-row mb-3 border rounded p-3">
                                            <div class="row gutters-5">
                                                <!-- Banner Image Upload -->
                                                <div class="col-md-12 mb-2">
                                                    <label class="fw-600">{{ translate('Banner Image') }}</label>
                                                    <div class="form-group">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                                    {{ translate('Browse') }}</div>
                                                            </div>
                                                            <div class="form-control file-amount">
                                                                {{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="types[]" value="home_promotional_images">
                                                            <input type="hidden" name="home_promotional_images[]"
                                                                class="selected-files"
                                                                value="{{ json_decode(get_setting('home_promotional_images'), true)[$key] }}">
                                                        </div>
                                                        <div class="file-preview box sm"></div>
                                                    </div>
                                                </div>

                                                <!-- Title -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Title') }}</label>
                                                        <input type="hidden" name="types[]" value="home_promotional_titles">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Title') }}"
                                                            name="home_promotional_titles[]"
                                                            value="{{ json_decode(get_setting('home_promotional_titles'), true)[$key] ?? '' }}">
                                                    </div>
                                                </div>

                                                <!-- Price -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Price') }}</label>
                                                        <input type="hidden" name="types[]" value="home_promotional_prices">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Price (e.g., $60.99)') }}"
                                                            name="home_promotional_prices[]"
                                                            value="{{ json_decode(get_setting('home_promotional_prices'), true)[$key] ?? '' }}">
                                                    </div>
                                                </div>

                                                <!-- Link -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="fw-600">{{ translate('Link') }}</label>
                                                        <input type="hidden" name="types[]" value="home_promotional_links">
                                                        <input type="text" class="form-control" placeholder="{{ translate('Link URL') }}"
                                                            name="home_promotional_links[]"
                                                            value="{{ json_decode(get_setting('home_promotional_links'), true)[$key] ?? '' }}">
                                                    </div>
                                                </div>

                                                <!-- Remove Button -->
                                                <div class="col-md-auto">
                                                    <div class="form-group">
                                                        <label class="fw-600 d-block">&nbsp;</label>
                                                        <button type="button"
                                                            class="btn btn-icon btn-circle btn-sm btn-soft-danger"
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
                        <div class="p-row mb-3 border rounded p-3">
                            <div class="row gutters-5">
                                <!-- Banner Image Upload -->
                                <div class="col-md-12 mb-2">
                                    <label class="fw-600">{{ translate('Banner Image') }}</label>
                                    <div class="form-group">
                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                            </div>
                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                            <input type="hidden" name="types[]" value="home_promotional_images">
                                            <input type="hidden" name="home_promotional_images[]" class="selected-files" value="">
                                        </div>
                                        <div class="file-preview box sm"></div>
                                    </div>
                                </div>

                                <!-- Title -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Title') }}</label>
                                        <input type="hidden" name="types[]" value="home_promotional_titles">
                                        <input type="text" class="form-control" placeholder="{{ translate('Title') }}" name="home_promotional_titles[]" value="">
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Price') }}</label>
                                        <input type="hidden" name="types[]" value="home_promotional_prices">
                                        <input type="text" class="form-control" placeholder="{{ translate('Price (e.g., $60.99)') }}" name="home_promotional_prices[]" value="">
                                    </div>
                                </div>

                                <!-- Link -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="fw-600">{{ translate('Link') }}</label>
                                        <input type="hidden" name="types[]" value="home_promotional_links">
                                        <input type="text" class="form-control" placeholder="{{ translate('Link URL') }}" name="home_promotional_links[]" value="">
                                    </div>
                                </div>

                                <!-- Remove Button -->
                                <div class="col-md-auto">
                                    <div class="form-group">
                                        <label class="fw-600 d-block">&nbsp;</label>
                                        <button type="button" class="btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".p-row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>'
                                data-target=".promotional-banners-target">
                                {{ translate('Add New Banner') }}
                            </button>
                        </div>

                        <!-- Update Button -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Newsletter Section --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Newsletter Section') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label">{{ translate('Newsletter Image') }}</label>
                            <div class="col-sm-10">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="types[]" value="home_newsletter_image">
                                    <input type="hidden" name="home_newsletter_image" class="selected-files" value="{{ get_setting('home_newsletter_image') }}">
                                </div>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label">{{ translate('Newsletter Title') }}</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="types[]" value="home_newsletter_title">
                                <input type="text" class="form-control" name="home_newsletter_title" value="{{ get_setting('home_newsletter_title') }}" placeholder="{{ translate('Newsletter Title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-from-label">{{ translate('Newsletter Subtitle') }}</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="types[]" value="home_newsletter_subtitle">
                                <textarea class="form-control" name="home_newsletter_subtitle" rows="3" placeholder="{{ translate('Newsletter Subtitle') }}">{{ get_setting('home_newsletter_subtitle') }}</textarea>
                            </div>
                        </div>
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
