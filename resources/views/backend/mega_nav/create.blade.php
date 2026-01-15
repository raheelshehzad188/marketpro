@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Mega Nav Item Information') }}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('mega_nav.store') }}" method="POST"
                        enctype="multipart/form-data" name="store_data">
                        @csrf

                        <!-- Select Category -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Select Category') }}</label>
                            <div class="col-md-9">
                                <x-treeview :nodes="$topLevelNodes" treeview-id="category_id" :single-select="true"
                                    treeview-type="category" />
                            </div>
                        </div>

                        <!-- Item Role: Parent or Child -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{ translate('Item Role') }}</label>
                            <div class="col-md-9">
                                <select class="form-control aiz-selectpicker" name="is_parent" id="item_role" required onchange="toggleParentSelection()">
                                    <option value="1">{{ translate('Parent') }}</option>
                                    <option value="0">{{ translate('Child') }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Select Parent Category (Visible only if Item Role is Child) -->
                        <div class="form-group row" id="parent_category_section" style="display: none;">
                            <label class="col-md-3 col-form-label">{{ translate('Select Parent Category') }}</label>
                            <div class="col-md-9">
                                <x-treeview :nodes="$topLevelNodes" treeview-id="parent_id" :single-select="true"
                                    treeview-type="category" />
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
