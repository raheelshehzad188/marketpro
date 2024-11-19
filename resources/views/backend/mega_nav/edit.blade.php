@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Edit Mega Nav Item') }}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('mega_nav.update', $megaNav->id) }}" method="POST"
                        enctype="multipart/form-data" name="edit_data">
                        @csrf
                        @method('PATCH')

                        <!-- Select Category -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Select Category') }}</label>
                            <div class="col-md-9">
                                <x-treeview
                                    :nodes="$topLevelNodes"
                                    treeview-id="category_id"
                                    :single-select="true"
                                    treeview-type="category"
                                    :selectedCategories="$selectCategoryId"
                                    :selectedCategoryNames="$selectCategoryName" />
                            </div>
                        </div>

                        <!-- Nav Type -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Nav Type') }}</label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="nav_type" required>
                                    <option value="cross_gear" {{ $megaNav->nav_type == 'cross_gear' ? 'selected' : '' }}>
                                        {{ translate('Cross Gear') }}
                                    </option>
                                    <option value="cross_parts" {{ $megaNav->nav_type == 'cross_parts' ? 'selected' : '' }}>
                                        {{ translate('Cross Parts') }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Item Role: Parent or Child -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Item Role') }}</label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="is_parent" id="item_role" required onchange="toggleParentSelection()">
                                    <option value="1" {{ $megaNav->is_parent ? 'selected' : '' }}>{{ translate('Parent') }}</option>
                                    <option value="0" {{ !$megaNav->is_parent ? 'selected' : '' }}>{{ translate('Child') }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Select Parent Category (Visible only if Item Role is Child) -->
                        <div class="form-group row" id="parent_category_section" style="display: {{ $megaNav->is_parent ? 'none' : 'flex' }};">
                            <label class="col-md-3 col-form-label">{{ translate('Select Parent Category') }}</label>
                            <div class="col-md-9">
                                <x-treeview
                                    :nodes="$topLevelNodes"
                                    treeview-id="parent_id"
                                    :single-select="true"
                                    treeview-type="category"
                                    :selectedCategories="$selectParentCategoryId"
                                    :selectedCategoryNames="$selectParentCategoryName" />
                            </div>
                        </div>

                        <!-- Visibility -->
                        <div class="form-group row">
                            <label for="visibility" class="col-lg-3 col-form-label">{{ translate('Visibility') }}</label>
                            <div class="col-lg-9">
                                <select class="aiz-selectpicker w-100" id="visibility" name="visibility[]" multiple>
                                    @foreach (App\Models\Shop::all() as $shop)
                                        <option value="{{ $shop->id }}"
                                            {{ in_array($shop->id, $visibilityShopIds) ? 'selected' : '' }}>
                                            {{ $shop->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Icon -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Icon') }}
                                <small>({{ translate('32x32') }})</small></label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="icon" class="selected-files" value="{{ $megaNav->icon }}">
                                </div>
                                <div class="file-preview box sm">
                                    @if($megaNav->icon)
                                        <img src="{{ uploaded_asset($megaNav->icon) }}" alt="{{ translate('icon') }}" class="img-thumbnail">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Toggle parent category selection based on item role (Parent or Child)
        function toggleParentSelection() {
            var itemRole = document.getElementById("item_role").value;
            var parentCategorySection = document.getElementById("parent_category_section");

            if (itemRole == "0") { // Child
                parentCategorySection.style.display = "flex";
            } else { // Parent
                parentCategorySection.style.display = "none";
            }
        }
    </script>
@endsection
