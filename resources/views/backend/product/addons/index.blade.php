@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="align-items-center">
            <h1 class="h3">{{ translate('All Product Addons') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{ translate('Product Addons') }}</h5>
                    </div>
                    <div class="col-md-4">
                        <form class="" id="sort_product_addons" action="" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="search" name="search"
                                    @isset($sort_search) value="{{ $sort_search }}" @endisset
                                    placeholder="{{ translate('Type name & Enter') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Article Number') }}</th>
                                <th>{{ translate('Amount') }}</th>
                                <th class="text-right">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_addons as $key => $product_addon)
                                <tr>
                                    <td>{{ $key + 1 + ($product_addons->currentPage() - 1) * $product_addons->perPage() }}
                                    </td>
                                    <td>{{ $product_addon->name }}</td>
                                    <td>{{ $product_addon->sku }}</td>

                                    <td>
                                        {{ single_price($product_addon->unit_price) }}
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                            href="{{ route('product-addons.edit', ['id' => $product_addon->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                            title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                            data-href="{{ route('product-addons.destroy', $product_addon->id) }}"
                                            title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="aiz-pagination">
                        {{ $product_addons->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Add New Product Addon') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('product-addons.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Product Name') }}</label>
                            <input type="text" placeholder="{{ translate('Product Name') }}" name="product_name"
                                class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Other Name') }}</label>
                            <input type="text" placeholder="{{ translate('Other Name') }}" name="other_name"
                                class="form-control" >
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Short Name') }}</label>
                            <input type="text" placeholder="{{ translate('Short Name') }}" name="short_name"
                                class="form-control" >
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Article Group') }}</label>
                            <input type="text" placeholder="{{ translate('Article Group') }}" name="article_group"
                                class="form-control" >
                        </div>


                        <div class="form-group mb-3">
                            <label>Price</label>
                            <input type="number" lang="en" min="0" value="0" step="0.01"
                                placeholder="{{ translate('Price') }}" name="unit_price" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Fake Price</label>
                            <input type="number" lang="en" min="0" value="0" step="0.01"
                                placeholder="{{ translate('Fake Price') }}" name="fake_price" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>Stock</label>
                            <input type="number" lang="en" value="" step="1" placeholder="{{ translate('Quantity') }}"
                                name="current_stock" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label>SKU</label>
                            <input type="text" placeholder="{{ translate('SKU') }}" value="" name="sku"
                                class="form-control">
                        </div>




                        <div class="form-group mb-3 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
        function sort_product_addons(el) {
            $('#sort_product_addons').submit();
        }
    </script>
@endsection
