@extends('backend.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ static_asset('assets/simple-image-zoom/css/style.css?v=1') }} " type="text/css"
        media="screen" />
    <link rel="stylesheet" href="{{ static_asset('assets/simple-image-zoom/lib/css/ap-image-zoom.css') }} " type="text/css"
        media="screen" />
    <section class="gry-bg py-4 profile">
        <div class="container-fluid">

            <!-- Mobile View Toggle Button -->
            <div class="d-lg-none">
                <button id="mobileToggleBtn" class="btn btn-secondary btn-sm mb-2">
                    <i class="las la-bars"></i> Menu
                </button>
            </div>
            @csrf
            <div class="row gutters-10">
                <div class="col-lg-4 mobile-slide-panel" id="mobileSlidePanel">

                    <div class="card">
                        <div class="card-header d-block">
                            <div class="row">
                                <div class="col-6">
                                    <h5>MOTO</h5>
                                </div>
                                <div class="col-6">
                                    <button id="closeSlideBtn" class="float-right d-block d-md-none">Close</button>

                                </div>
                            </div>
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
                            <div class="aiz-pos-product-list right">
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
    <div class="overlay" id="overlay"></div>
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

@section('style')
    <style>
        /* Default style for the overlay - not displayed */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
        }

        /* Media query for mobile devices */
        @media (max-width: 1024px) {

            /* Adjusting for Bootstrap's large (lg) breakpoint */
            .mobile-slide-panel {
                position: fixed;
                width: 90%;
                /* Width of the slide panel */
                max-width: 450px;
                /* Maximum width */
                left: -100%;
                /* Start off-screen */
                top: 0;
                bottom: 0;
                z-index: 1050;
                /* Above most items */
                transition: left 0.3s;
                /* Smooth slide-in transition */
                overflow-y: auto;
                /* Scrollable if content is long */
            }

            .mobile-slide-panel.active {
                left: -10px;
                /* Slide in */
            }

            /* Adjust this value based on your design's breakpoints */
            .overlay {
                display: none;
                /* Initially hidden */
            }

            .overlay.active {
                display: block;
                /* Shown when active, only on mobile devices */
            }

            .jstree-closed i.jstree-icon.jstree-ocl::before {
                content: '\f0fe';
                background: transparent !important;
                font-family: 'Line Awesome Free';
                font-style: normal;
                font-size: 24px;
            }

            .jstree-closed i.jstree-icon.jstree-ocl {
                background: transparent;
            }

            .jstree-open>i.jstree-icon.jstree-ocl::before {
                content: "\f146";
                font-family: 'Line Awesome Free';
                font-style: normal;
                font-size: 24px;
            }

            .jstree-open i.jstree-icon.jstree-ocl {
                background: transparent;
            }

            i.jstree-icon.jstree-themeicon.fa.fa-folder.icon-lg.jstree-themeicon-custom {
                display: none !important;
            }

            .jstree-default-responsive .jstree-anchor {
                /* background: no-repeat; */
                box-shadow: none;
            }


            .jstree-default-responsive .jstree-node {
                margin: 0 0 0 10px;
            }

            .aiz-pos-product-list.right {
                overflow: visible !important;
                height: 100%;
                max-height: 100%;
            }

            .aiz-pos-product-list.c-scrollbar-light {
                height: 100%;
                min-height: 100vh;
                max-height: 100%;
            }

            #mobileSlidePanel .card-body {
                padding: 20px 10px 10px 10px;
            }

            .right .addon-scroll {
                overflow: visible !important;
                height: auto !important;
            }

            .table-responsive {
                position: relative;
            }

            .scroll-indicator {
                position: sticky;
                top: 10%;
                right: 10px;
                /* Position the arrow near the right edge of the viewport */
                font-size: 14px;
                /* Adjust size as needed */
                color: red;
                /* Adjust color as needed */
                animation: bounceArrow 1.5s ease-in-out infinite;
                z-index: 2;
                /* Ensure it's above the table content */
            }

            /* .scroll-indicator i {
                            font-size: 20px;
                        } */

            @keyframes bounceArrow {

                0%,
                100% {
                    transform: translateY(-50%) translateX(0px);
                }

                25% {
                    transform: translateY(-50%) translateX(10px);
                    /* Move right */
                }

                75% {
                    transform: translateY(-50%) translateX(-10px);
                    /* Move left */
                }
            }

            /* Ensure the scroll indicator doesn't go beyond the table */
            .table-responsive::after {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                width: 30px;
                /* Width of sticky area */
                height: 100%;
                pointer-events: none;
            }

            /* Style for the horizontal scrollbar */
            .table-responsive::-webkit-scrollbar {
                height: 8px;
            }

            .table-responsive::-webkit-scrollbar-thumb {
                background: #888;
                border-radius: 4px;
            }

            .table-responsive::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .table-responsive-container {
                position: relative;
                overflow: hidden;
                /* This hides the shadow when it's not needed */
            }

            .table-responsive {
                overflow-x: auto;
            }

            .table-responsive-container::after {
                content: '';
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                width: 20px;
                /* Width of the shadow */
                background: linear-gradient(to left, rgba(0, 0, 0, 0.2), transparent);
                pointer-events: none;
                z-index: 2;
            }

            .related-products-list {
            height: 200px;
            /* Adjust as needed */
        }


        }

        /* related products */
        .related-products {
            position: relative;
        }

        .related-products-list {
            height: 300px;
            /* Adjust as needed */
            overflow-y: hidden;
            display: flex;
            flex-direction: column;
        }

        .related-product-item {
            margin: 10px 0;
        }

        .scroll-btn {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            cursor: pointer;
        }

        .scroll-up {
            top: -20px;
        }

        .scroll-down {
            bottom: -20px;
        }

        button.scroll-btn {
    border: none;
    box-shadow: 2px 2px 8px #00000075;
    color: grey;
    font-size: 23px;
    text-align: center;
    background: #ffffff73;
    padding: 0;
    height: 28px;
    line-height: 0;
    border-radius: 100%;
    width: 28px;
}
    </style>
@endsection
@section('script')
    <script src="//code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.11/jquery.mousewheel.min.js"></script>
    <script src="{{ static_asset('assets/simple-image-zoom/lib/js/ap-image-zoom.js') }} "></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    <script type="text/javascript">
        var ajax_loader =
            ' <div class="text-center w-100"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div></div>'
        var products = null;



        $(document).ready(function() {
            // Input keypress event for triggering filterProducts on Enter key press
            $(document).on('keypress', 'input', function(e) {
                if (e.which === 13) {
                    filterProducts();
                }
            });

            // Toggling classes on the container
            $('#container').removeClass('mainnav-lg').addClass('mainnav-sm');

            // Click event delegation for product cards
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

            // Initial category loading
            loadCategories(0);

            // jsTree initialization and event handling
            $("#kt_docs_jstree_ajax").on("changed.jstree", function(e, data) {
                if (data.selected.length) {
                    var type = data.node.a_attr.type;
                    var id = data.node.a_attr.id;
                    $('input[name=keyword]').val('');
                    switch (type) {
                        case 'category':
                            loadCategories(id);
                            break;
                        case 'product':
                            loadProducts(id);
                            break;
                        default:
                            loadProduct(id);
                    }
                }
            }).jstree({
                "core": {
                    "themes": {
                        "responsive": true
                    },
                    "check_callback": false,
                    "data": {
                        "url": function(node) {
                            return '{{ route('pos.get_tree') }}';
                        },
                        "data": function(node) {
                            return {
                                'parent': node.id
                            };
                        }
                    }
                },
                "types": {
                    "default": {
                        "icon": "las la-folder"
                    },
                    "file": {
                        "icon": "las la-file-alt"
                    }
                },
                "plugins": ["dnd", "types"]
            });
        });


        //end
        // Function to simulate opening of jsTree
        function open_jstree(id) {
            $('#cat_' + id + ' > i').click();
        }

        // Common function to perform AJAX requests
        function loadContent(url, params, successCallback) {
            $('#product-list').html(ajax_loader);
            $.get(url, params, successCallback);
        }

        // Function to load products
        function loadProducts(id) {
            open_jstree(id);
            loadContent('{{ route('pos.get_products') }}', {
                id: id,
                noCache: Math.random()
            }, function(data) {
                $('#product-list').html(data);
            });
        }

        // Function to filter products
        function filterProducts() {
            var keyword = $('input[name=keyword]').val();
            loadContent('{{ route('pos.search_product') }}', {
                keyword: keyword,
                noCache: Math.random()
            }, function(data) {
                $('#product-list').html(data);
            });
        }

        // Function to filter products
        function filterProductsKeyword(keyword) {
            loadContent('{{ route('pos.search_product') }}', {
                keyword: keyword,
                noCache: Math.random()
            }, function(data) {
                $('#product-list').html(data);
            });
        }

        // Function to load categories
        function loadCategories(id) {
            open_jstree(id);
            loadContent('{{ route('pos.get_categories') }}', {
                id: id,
                noCache: Math.random()
            }, function(data) {
                $('#product-list').html(data);
            });
        }

        // Function to load a specific product
        function loadProduct(id) {
            closeSidebar();
            var keyword = $('input[name=keyword]').val();
            loadContent('{{ route('pos.get_product') }}', {
                keyword: keyword,
                id: id,
                noCache: Math.random()
            }, function(data) {
                $('#product-list').html(data);
            });
        }

        // Function to load more products
        function loadMoreProduct() {
            if (products != null && products.links.next != null) {
                $.get(products.links.next, {}, function(data) {
                    products = data;
                    setProductList(data);
                });
            }
        }

        // Function to set the product list
        function setProductList(data) {
            data.data.forEach(product => {
                $('#product-list').append(`
                        <div class="col-3">
                            <div class="card bg-light c-pointer mb-2 product-card" data-id="${product.id}">
                                <span class="absolute-top-left bg-dark text-white px-1">${product.price}</span>
                                <img src="${product.thumbnail_image}" class="card-img-top img-fit h-100px mw-100 mx-auto" >
                                <div class="card-body p-2">
                                    <div class="text-truncate-2 small">${product.name}</div>
                                </div>
                            </div>
                        </div>
                    `);
            });

            $('#load-more').find('.text-center').html(data.links.next ? 'Load More' : 'Nothing more found');
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

    <script>
        document.getElementById('mobileToggleBtn').addEventListener('click', function() {
            var panel = document.getElementById('mobileSlidePanel');
            var overlay = document.getElementById('overlay');
            panel.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        // Optional: Close menu when overlay is clicked

        document.getElementById('overlay').addEventListener('click', function() {
            this.classList.remove('active');
            document.getElementById('mobileSlidePanel').classList.remove('active');
        });
        document.getElementById('closeSlideBtn').addEventListener('click', function() {
            document.getElementById('mobileSlidePanel').classList.remove('active');
            document.getElementById('overlay').classList.remove('active');
        });

        var startX, startY, deltaX, deltaY;

        var sidebar = document.getElementById('mobileSlidePanel'); // Your sidebar element
        var overlay = document.getElementById('overlay'); // Your overlay element

        function handleTouchStart(e) {
            startX = e.touches[0].pageX;
            startY = e.touches[0].pageY;
        }

        function handleTouchMove(e) {
            deltaX = e.touches[0].pageX - startX;
            deltaY = e.touches[0].pageY - startY;
        }

        // function handleTouchEnd(e) {
        //     // Check for a left swipe
        //     if (Math.abs(deltaX) > Math.abs(deltaY) && deltaX < 0) {
        //         closeSidebar();
        //     }

        //     // Reset deltaX and deltaY
        //     deltaX = deltaY = 0;
        // }

        [sidebar, overlay].forEach(element => {
            element.addEventListener('touchstart', handleTouchStart);
            element.addEventListener('touchmove', handleTouchMove);
            element.addEventListener('touchend', handleTouchEnd);
        });

        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }

        var swipeThreshold = 30; // Pixels

        function handleTouchEnd(e) {
            // Check for a left swipe and that it's long enough
            if (Math.abs(deltaX) > Math.abs(deltaY) && deltaX < 0 && Math.abs(deltaX) > swipeThreshold) {
                closeSidebar();
            }

            deltaX = deltaY = 0;
        }
    </script>
@endsection
