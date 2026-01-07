@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{ translate('All products') }}</h1>
            </div>
            <div class="col text-right">
                <a href="{{ route('products.create') }}" class="btn btn-circle btn-info">
                    <span>{{ translate('Add New Product') }}</span>
                </a>
            </div>
        </div>
    </div>
    <br>

    <div class="card">
        <form class="" id="sort_products" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">{{ translate('All Product') }}</h5>
                </div>
                <div class="dropdown mb-2 mb-md-0">
                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ translate('Bulk Action') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" onclick="bulk_delete()">
                            {{ translate('Delete selection') }}</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control form-control-sm" id="search"
                            name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="{{ translate('Type & Enter') }}">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="featuredOnly" name="featured" value="1"
                            @if (request('featured') == '1') checked @endif>
                        <label class="form-check-label" for="featuredOnly">{{ translate('Show Featured Only') }}</label>
                    </div>
                </div>

                <div class="col-md-2">
                    <input type="submit" class="btn btn-sm btn-primary" value="Search">
                </div>
                <div class="col-auto">
                    <button type="button" id="advancedFilterToggle" class="btn btn-sm btn-secondary">Show Category
                        Filter
                        @if (!empty($categoryIds))
                            ({{ count($categoryIds) }} )
                        @endif
                    </button>
                </div>

            </div>
            <div id="advancedFilters" class="row" style="display:none;">

                <div class="col-md-11 mx-auto mt-4">
                    <div class="form-group row" id="category">
                        <label class="col-auto col-from-label fs-14 fw-500">Select one or more categories</label>
                        <div class="col-lg-8">

                            <x-treeview :nodes="$topLevelNodes" treeview-id="treeview1" :selectedCategories="$categoryIds" :selectedCategoryNames="$selectedCategoryNames"
                                treeview-type="category" />
                        </div>
                    </div>
                </div>
                <!-- Add more filters as needed -->
            </div>


            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-group">
                                    <div class="aiz-checkbox-inline">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" class="check-all">
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <!--<th data-breakpoints="lg">#</th>-->
                            <th>{{ translate('Name') }}</th>
                            <th data-breakpoints="sm">{{ translate('Visibility') }}</th>
                            {{-- <th data-breakpoints="md">{{translate('Total Stock')}}</th> --}}
                            {{-- <th data-breakpoints="lg">{{translate('Todays Deal')}}</th> --}}
                            <th data-breakpoints="sm">{{ translate('Published') }}</th>
                            <th data-breakpoints="sm">{{ translate('Featured') }}</th>
                            <th data-breakpoints="sm" class="text-right">{{ translate('Options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <!--<td>{{ $key + 1 + ($products->currentPage() - 1) * $products->perPage() }}</td>-->
                                <td>
                                    <div class="form-group d-inline-block">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" class="check-one" name="id[]"
                                                value="{{ $product->id }}">
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="row gutters-5 w-200px w-md-300px mw-100">

                                        <div class="col">
                                            <span
                                                class="text-muted text-truncate-2">{{ $product->getTranslation('name') }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if (!empty($product->visibilityShops))
                                        @foreach ($product->visibilityShops as $shop)
                                            <span class="badge badge-inline badge-soft-info">{{ $shop }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge badge-inline badge-soft-success">
                                            {{ translate('All Shops') }}
                                        </span>
                                    @endif
                                </td>



                                <td>
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input onchange="update_published(this)" value="{{ $product->id }}"
                                            type="checkbox" <?php if ($product->published == 1) {
                                                echo 'checked';
                                            } ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>

                                <td>
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input onchange="update_featured(this)" value="{{ $product->id }}" type="checkbox"
                                            <?php if ($product->featured == 1) {
                                                echo 'checked';
                                            } ?>>
                                        <span class="slider round"></span>
                                    </label>
                                </td>

                                <td class="text-right">


                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                        href="{{ route('products.admin.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                        title="{{ translate('Edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>


                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        data-href="{{ route('products.destroy', $product->id) }}"
                                        title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </form>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
        $('#featuredOnly').on('change', function() {
            $('#sort_products').submit();
        });


        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        $(document).ready(function() {
            $('#advancedFilterToggle').click(function() {
                $('#advancedFilters').slideToggle('fast');
            });
        });




        function update_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Published products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }



        function sort_products(el) {
            $('#sort_products').submit();
        }

        function bulk_delete() {
            var data = new FormData($('#sort_products')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-product-delete') }}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }

        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Featured products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
