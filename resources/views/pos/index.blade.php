@extends('backend.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ static_asset('assets/simple-image-zoom/css/style.css?v=1') }} " type="text/css"
        media="screen" />
    <link rel="stylesheet" href="{{ static_asset('assets/simple-image-zoom/lib/css/ap-image-zoom.css') }} " type="text/css"
        media="screen" />
    <section class="gry-bg py-4 profile">
        <div class="container-fluid">

            @csrf
            <div class="row gutters-10">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header d-block">
                            <h5>MOTO</h5>
                        </div>
                        <div class="card-body">
                            <div class="aiz-pos-product-list c-scrollbar-light">


                                <div id="kt_docs_jstree_ajax"></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row gutters-5 mb-3">
                                <div class="col-md-8 mb-2 mb-md-0">
                                    <div class="form-group mb-0">
                                        <input class="form-control form-control-lg" type="text" name="keyword"
                                            placeholder="Search by article number?">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary btn-block fs-18" type="button"
                                        onclick="filterProducts()">Search</button>
                                </div>

                            </div>
                            <div class="aiz-pos-product-list c-scrollbar-light">
                                <div class="row gutters-5" id="product-list">

                                </div>
                                {{-- <div id="load-more">
                                        <p class="text-center fs-14 fw-600 p-2 bg-soft-primary c-pointer"
                                            onclick="loadMoreProduct()">Load More</p>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

@section('modal')
    <!-- Address Modal -->
    <div id="new-customer" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">{{ translate('Shipping Address') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="shipping_address">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-styled btn-base-3" data-dismiss="modal"
                        id="close-button">{{ translate('Close') }}</button>
                    <button type="button" class="btn btn-primary btn-styled btn-base-1"
                        data-dismiss="modal">{{ translate('Confirm') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- new address modal -->
    <div id="new-address-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">{{ translate('Shipping Address') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form class="form-horizontal" action="{{ route('addresses.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="customer_id" id="set_customer_id" value="">
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="address">{{ translate('Address') }}</label>
                                <div class="col-sm-10">
                                    <textarea placeholder="{{ translate('Address') }}" id="address" name="address" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="email">{{ translate('Country') }}</label>
                                <div class="col-sm-10">
                                    <select name="country" id="country" class="form-control aiz-selectpicker" required
                                        data-placeholder="{{ translate('Select country') }}">
                                        @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="city">{{ translate('City') }}</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="{{ translate('City') }}" id="city"
                                        name="city" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label"
                                    for="postal_code">{{ translate('Postal code') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" placeholder="{{ translate('Postal code') }}"
                                        id="postal_code" name="postal_code" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-2 control-label" for="phone">{{ translate('Phone') }}</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" placeholder="{{ translate('Phone') }}"
                                        id="phone" name="phone" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-styled btn-base-3"
                            data-dismiss="modal">{{ translate('Close') }}</button>
                        <button type="submit"
                            class="btn btn-primary btn-styled btn-base-1">{{ translate('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="product-variation" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg">
            <div class="modal-content" id="variants">

            </div>
        </div>
    </div>

    <div id="order-confirm" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom">
            <div class="modal-content" id="variants">
                <div class="modal-header bord-btm">
                    <h4 class="modal-title h6">{{ translate('Order Confirmation') }}</h4>
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>{{ translate('Are you sure to confirm this order?') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-styled btn-base-3"
                        data-dismiss="modal">{{ translate('Close') }}</button>
                    <button type="button" onclick="submitOrder('cash')"
                        class="btn btn-styled btn-base-1 btn-primary">{{ translate('Comfirm Order') }}</button>
                </div>
            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection


@section('script')
    <script src="//code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.11/jquery.mousewheel.min.js"></script>
    <script src="{{ static_asset('assets/simple-image-zoom/lib/js/ap-image-zoom.js') }} "></script>
    <script type="text/javascript">
        var ajax_loader =
            ' <div class="text-center w-100"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div></div>'
        var products = null;


        $(document).ready(function() {
            $('input').keypress(function(e) {
                if (e.which == 13) {
                    filterProducts();
                }
            });


            $('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
            $('#product-list').on('click', '.product-card', function() {
                var id = $(this).data('id');
                $.get('{{ route('variants') }}', {
                    id: id
                }, function(data) {
                    if (data == 0) {
                        addToCart(id, null, 1);
                    } else {
                        $('#variants').html(data);
                        $('#product-variation').modal('show');
                    }
                });
            });


            loadCategories(0);


            $("#kt_docs_jstree_ajax")
                .on("changed.jstree", function(e, data) {
                    if (data.selected.length) {
                        // data.instance.get_node(data.selected[0]).text);
                        if (data.node.a_attr.type == 'category') {
                            $('input[name=keyword]').val('');
                            loadCategories(data.node.a_attr.id);
                        } else if (data.node.a_attr.type == 'product') {
                            $('input[name=keyword]').val('');
                            loadProducts(data.node.a_attr.id);
                        } else {
                            $('input[name=keyword]').val('');
                            loadProduct(data.node.a_attr.id);
                        }

                    }
                })
                .jstree({
                    "core": {
                        "themes": {
                            "responsive": true
                        },
                        // so that create works
                        "check_callback": false,
                        'data': {
                            'url': function(node) {
                                return '{{ route('pos.get_tree') }}'; // Demo API endpoint -- Replace this URL with your set endpoint
                            },
                            'data': function(node) {
                                return {
                                    'parent': node.id
                                };

                            }
                        }
                    },
                    "types": {
                        "default": {
                            "icon": "fa fa-folder text-primary"
                        },
                        "file": {
                            "icon": "fa fa-file  text-primary"
                        }
                    },
                    "plugins": ["dnd", "types"]
                });
        });


        function open_jstree(id) {
            $('#cat_' + id + ' > i').click();
            //console.log(id)
        }

        function loadProducts(id) {

            open_jstree(id);
            $('#product-list').html(ajax_loader);
            $.get('{{ route('pos.get_products') }}', {
                id: id,
                noCache: Math.random()
            }, function(data) {
                $('#product-list').html('');
                $('#product-list').html(data);
            });
        }

        function filterProducts() {
            var keyword = $('input[name=keyword]').val();
            $('#product-list').html(ajax_loader);
            $.get('{{ route('pos.search_product') }}', {
                keyword: keyword,
                noCache: Math.random()
            }, function(data) {
                $('#product-list').html('');
                $('#product-list').html(data);

            });
        }

        function loadCategories(id) {
            open_jstree(id);
            $('#product-list').html(ajax_loader);
            $.get('{{ route('pos.get_categories') }}', {
                id: id,
                noCache: Math.random()
            }, function(data) {
                $('#product-list').html('');
                $('#product-list').html(data);
            });
        }

        function loadProduct(id) {
            var keyword = $('input[name=keyword]').val();
            $('#product-list').html(ajax_loader);
            $.get('{{ route('pos.get_product') }}', {
                keyword: keyword,
                id: id,
                noCache: Math.random()
            }, function(data) {
                $('#product-list').html('');
                $('#product-list').html(data);
            });
        }



        function loadMoreProduct() {
            if (products != null && products.links.next != null) {
                $.get(products.links.next, {}, function(data) {
                    products = data;
                    setProductList(data);
                });
            }
        }

        function setProductList(data) {
            for (var i = 0; i < data.data.length; i++) {
                $('#product-list').append('<div class="col-3">' +
                    '<div class="card bg-light c-pointer mb-2 product-card" data-id="' + data.data[i].id + '" >' +
                    '<span class="absolute-top-left bg-dark text-white px-1">' + data.data[i].price + '</span>' +
                    '<img src="' + data.data[i].thumbnail_image +
                    '" class="card-img-top img-fit h-100px mw-100 mx-auto" >' +
                    '<div class="card-body p-2">' +
                    '<div class="text-truncate-2 small">' + data.data[i].name + '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
            }
            if (data.links.next != null) {
                $('#load-more').find('.text-center').html('Load More');
            } else {
                $('#load-more').find('.text-center').html('Nothing more found');
            }
            $('[data-toggle="tooltip"]').tooltip();
        }

        function removeFromCart(key) {
            $.post('{{ route('pos.removeFromCart') }}', {
                _token: '{{ csrf_token() }}',
                key: key
            }, function(data) {
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function addToCart(elm, product_id, addon, type) {
            $(elm).prop('disabled', true);
            $('.actBtn-loader' + product_id + addon).show();
            $('.actBtn-bag' + product_id + addon).hide();
            var quantity = $('#qty_' + product_id + '_' + addon).val();

            $.post('{{ route('pos.addToCart') }}', {
                _token: '{{ csrf_token() }}',
                product_id: product_id,
                addon: addon,
                type: type,
                quantity: quantity
            }, function(data) {
                $(elm).prop('disabled', false);
                $('.actBtn-loader' + product_id + addon).hide();
                $('.actBtn-bag' + product_id + addon).show();
                AIZ.plugins.notify('success', 'Successfully added to cart!');
            }).fail(function(err) {
                if (err.status == 422) { // when status code is 422, it's a validation issue
                    // display errors on each form field
                    $.each(err.responseJSON.errors, function(i, error) {
                        AIZ.plugins.notify('danger', error[0]);
                    });
                }
                $(elm).prop('disabled', false);
                $('.actBtn-loader' + product_id + addon).hide();
                $('.actBtn-bag' + product_id + addon).show();
            });
        }


        function addVariantProductToCart(id) {
            var variant = $('input[name=variant]:checked').val();
            addToCart(id, variant, 1);
        }

        function updateQuantity(key) {
            $.post('{{ route('pos.updateQuantity') }}', {
                _token: '{{ csrf_token() }}',
                key: key,
                quantity: $('#qty-' + key).val()
            }, function(data) {
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function setDiscount() {
            var discount = $('input[name=discount]').val();
            $.post('{{ route('pos.setDiscount') }}', {
                _token: '{{ csrf_token() }}',
                discount: discount
            }, function(data) {
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function setShipping() {
            var shipping = $('input[name=shipping]:checked').val();
            $.post('{{ route('pos.setShipping') }}', {
                _token: '{{ csrf_token() }}',
                shipping: shipping
            }, function(data) {
                $('#cart-details').html(data);
                $('#product-variation').modal('hide');
            });
        }

        function getShippingAddress() {

            $.post('{{ route('pos.getShippingAddress') }}', {
                _token: '{{ csrf_token() }}',
                id: $('select[name=user_id]').val()
            }, function(data) {
                $('#shipping_address').html(data);
            });
        }

        function add_new_address() {
            var customer_id = $('#customer_id').val();
            $('#set_customer_id').val(customer_id);
            $('#new-address-modal').modal('show');
            $("#close-button").click();
        }

        function submitOrder(payment_type) {
            var user_id = $('select[name=user_id]').val();
            var name = $('input[name=name]').val();
            var email = $('input[name=email]').val();
            var address = $('textarea[name=address]').val();
            var country = $('select[name=country]').val();
            var city = $('input[name=city]').val();
            var postal_code = $('input[name=postal_code]').val();
            var phone = $('input[name=phone]').val();
            var shipping = $('input[name=shipping]:checked').val();
            var discount = $('input[name=discount]').val();
            var address = $('input[name=address_id]:checked').val();

            $.post('{{ route('pos.order_place') }}', {
                _token: '{{ csrf_token() }}',
                user_id: user_id,
                name: name,
                email: email,
                address: address,
                country: country,
                city: city,
                postal_code: postal_code,
                phone: phone,
                shipping_address: address,
                payment_type: payment_type,
                shipping: shipping,
                discount: discount
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Order Completed Successfully.') }}');
                    location.reload();
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
