@extends('frontend.layouts.master')
@section('title', $name)
@section('content')
    <div role="main" class="main">
        <div role="main" class="main">
            <section class="page-header ">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col">
                            <div class="row">
                                <div class="col-md-12 align-self-center order-1" id="breedcum"">
                                <ul class="breadcrumb d-block">
                                    <li><a href="javascript:void(0)" onclick="loadCategories(0)">Home</a></li>
                                </ul>
                                <h2 class="page-title">{{ $name }}</h2>
                            </div>
                        </div></div>

                                    <div class="filters">
                                        <button class="btn btn-filter" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasWithBothOptions"
                                            aria-controls="offcanvasWithBothOptions"> Filter <i
                                                class="fa-solid fa-align-left"></i></button>
                                    </div>

                                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1"
                                            id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                                            <div class="offcanvas-header">
                                                <h5 class="offcanvas-title font-weight-bold letter-space-2"
                                                    id="offcanvasWithBothOptionsLabel">Filter</h5>
                                                <button type="button" class="btn-close text-reset"
                                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body">

                                                <div id="tree">
                                                    <!-- bstreeview populated via AJAX -->
                                                </div>

                                                <div class="bottom-offcanv">
                                                    <div class="filter-result"><span id="product-count"></span> products
                                                    </div>
                                                    <div class="filter-rest"><button class="btn-reset"
                                                            onclick="resetFilters()">Reset</button></div>
                                                    <div class="filter-submmit">
                                                        <button class="btn-submit" data-bs-dismiss="offcanvas">Use &
                                                            close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
            </section>

            <!-- Product listing section -->
            <section class="product-listing" id="main-content-section">
                <div class="container">
                    <div class="masonry-loader masonry-loader-loaded">
                        <div class="row products product-thumb-info-list" id="product-list">
                            <!-- Categories or Products will be loaded here via AJAX -->
                        </div>
                    </div>
                </div>
            </section>

            <!-- Product detail section (initially hidden) -->
            <section class="product-detail-section" id="product-detail-section" style="display: none;">
                <!-- Product detail partial will be loaded here dynamically -->
            </section>

            @include('frontend.partials.instagram')
        </div>
    </div>
@endsection

@section('style')
    <!-- Add CSS -->
    <link rel="stylesheet" href="{{ static_asset('jstree/jstree.bundle.css') }}" />
@endsection
@section('script')
    <!-- Add JS -->
    <script src="{{ static_asset('jstree/jstree.bundle.js') }}"></script>


    <script>
        var ajax_loader =
            '<div class="text-center w-100"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div></div>';

        $(document).ready(function() {
            // Initialize jsTree
            $('#tree').jstree({
                core: {
                    data: {
                        url: function(node) {
                            return node.id === '#' ?
                                "{{ route('get_tree') }}" :
                                "{{ route('get_tree') }}?parent=" + node.id;
                        },
                        data: function(node) {
                            return {
                                id: node.id
                            };
                        }
                    },
                    themes: {
                        responsive: false
                    }
                },

                plugins: ['state', 'wholerow'],
                state: {
                    key: "tree-state"
                } // Remember tree state
            }).on('select_node.jstree', function(e, data) {
                if (data.event) { // Trigger only for user selection
                    const node = data.node;
                    const entityId = node.id;
                    const nodeType = node.data.type;

                    // Update URL dynamically
                    const newUrl = nodeType === 'category' ?
                        "{{ route('exploded_view.category', ':id') }}".replace(':id', entityId) :
                        "{{ route('exploded_view.product', ':id') }}".replace(':id', entityId);

                    history.pushState(null, '', newUrl);

                    // Load content on the right-hand side
                    if (nodeType === 'category') {
                        loadCategoriesOrProducts(entityId);
                    } else if (nodeType === 'single_product') {
                        loadProduct(entityId);
                    }
                }
            });

            // Handle initial state on page load
            handleInitialState();
        });

        // Handle back/forward browser navigation
        window.onpopstate = function() {
            console.log('Popstate triggered');
            handleInitialState();
        };

        function handleInitialState() {
            const pathParts = window.location.pathname.split('/').filter(Boolean);
            const entityType = pathParts[2]; // 'category' or 'product'
            const entityId = pathParts[3]; // The ID of the entity

            if (!entityType || !entityId) {
                // Root URL or no entity specified
                console.log('No specific state. Loading root categories...');
                clearTreeState(); // Clear tree state for the main page
                loadRootCategories();
                return;
            }

            console.log(`Loading state for: ${entityType} with ID: ${entityId}`);
            $('#tree').jstree('deselect_all'); // Clear any previous selection
            $('#tree').jstree('select_node', entityId, true); // Select node without triggering event

            if (entityType === 'category') {
                loadCategoriesOrProducts(entityId); // Load the category's products or subcategories
            } else if (entityType === 'product') {
                loadProduct(entityId); // Load the product details
            }
        }

        function clearTreeState() {
            // Clear the persistent state stored by jstree
            $('#tree').jstree(true).clear_state();
            $('#tree').jstree('deselect_all'); // Ensure all nodes are deselected
        }

        function loadRootCategories() {
            load_breedcum('categories','0');
            // Load the root categories on the right-hand side
            $('#product-list').html(ajax_loader);
            $('#product-detail-section').hide();
            $('#main-content-section').show();

            $.get("{{ route('get_categories') }}", {
                id: 0
            }, function(data) {
                $('#product-list').html(data);
                attachCategoryClick();
            });
        }

        function loadCategoriesOrProducts(id) {
            load_breedcum('categories',id);
            $('#product-list').html(ajax_loader);
            $('#product-detail-section').hide();
            $('#main-content-section').show();

            $.get("{{ route('get_categories') }}", {
                id: id
            }, function(data) {
                if ($.trim(data) !== '') {
                    $('#product-list').html(data);
                    attachCategoryClick();
                } else {
                    loadProducts(id); // If no categories, load products
                }

                // Sync with tree
                syncWithTree(id, 'category');
            });
        }
        function load_breedcum(type = '',id = 0)
        {
            $('#breedcum').html('');
            $.get("{{ route('get_breedcum') }}", {
                id: id,
                type: type
            }, function(data) {
                $('#breedcum').html(data);

                // Sync with tree
                syncWithTree(id, 'product_list');
            });
        }

        function loadProducts(id) {
            load_breedcum('products',id);


            $('#product-list').html(ajax_loader);
            $('#product-detail-section').hide();
            $('#main-content-section').show();
            $.get("{{ route('get_products') }}", {
                id: id
            }, function(data) {
                $('#product-list').html(data);
                attachProductClick();

                // Sync with tree
                syncWithTree(id, 'product_list');
            });
        }

        function loadProduct(id) {
            load_breedcum('product',id);
            $('#main-content-section').hide();
            $('#product-detail-section').show().html(ajax_loader);

            $.get("{{ route('get_product') }}", {
                id: id
            }, function(data) {
                $('#product-detail-section').html(data);
                initProductDetailScripts();

                // Sync with tree
                syncWithTree(id, 'single_product');
            });
        }

        function attachCategoryClick() {
            $('#product-list .card').off('click').on('click', function() {
                var catId = $(this).data('id');

                // Update URL dynamically
                const newUrl = "{{ route('exploded_view.category', ':id') }}".replace(':id', catId);
                history.pushState(null, '', newUrl);

                loadCategoriesOrProducts(catId);

                // Sync left tree
                syncWithTree(catId, 'category');
            });
        }

        function attachProductClick() {
            $('#product-list .card').off('click').on('click', function() {
                var productId = $(this).data('id');

                // Update URL dynamically
                const newUrl = "{{ route('exploded_view.product', ':id') }}".replace(':id', productId);
                history.pushState(null, '', newUrl);

                loadProduct(productId);

                // Sync left tree
                syncWithTree(productId, 'single_product');
            });
        }

        function syncWithTree(id, type) {
            // Ensure the left tree selects and opens the corresponding node
            const tree = $('#tree').jstree(true);

            // Open and select the node
            tree.deselect_all();
            tree.open_node(id); // Ensure the node's parent is opened
            tree.select_node(id); // Select the node
        }
    </script>





    <script>
        function initProductDetailScripts() {
            // Implement zoom, drag, and addToCart logic here
            var scale = 1;
            var isDragging = false;
            var startX, startY, translateX = 0,
                translateY = 0;
            var $image = $('#image');
            var $imgContainer = $('.img-container');

            function updateTransform() {
                $image.css('transform', 'scale(' + scale + ') translate(' + translateX + 'px, ' + translateY + 'px)');
            }

            $('#zoom-in').on('click', function(e) {
                e.preventDefault();
                scale += 0.1;
                updateTransform();
            });

            $('#zoom-out').on('click', function(e) {
                e.preventDefault();
                if (scale > 0.1) {
                    scale -= 0.1;
                    updateTransform();
                }
            });

            $('#reset').on('click', function(e) {
                e.preventDefault();
                scale = 1;
                translateX = 0;
                translateY = 0;
                updateTransform();
            });

            $imgContainer.on('mousedown touchstart', function(e) {
                isDragging = true;
                var clientX = (e.type === 'touchstart') ? e.touches[0].clientX : e.pageX;
                var clientY = (e.type === 'touchstart') ? e.touches[0].clientY : e.pageY;
                startX = clientX - translateX;
                startY = clientY - translateY;
                $imgContainer.css('cursor', 'grabbing');
                e.preventDefault();
            });

            $(document).on('mouseup touchend', function() {
                isDragging = false;
                $imgContainer.css('cursor', 'grab');
            });

            $(document).on('mousemove touchmove', function(e) {
                if (isDragging) {
                    var clientX = (e.type === 'touchmove') ? e.touches[0].clientX : e.pageX;
                    var clientY = (e.type === 'touchmove') ? e.touches[0].clientY : e.pageY;
                    translateX = clientX - startX;
                    translateY = clientY - startY;
                    updateTransform();
                }
            });

            $image.on('dragstart', function(e) {
                e.preventDefault();
            });



            // Handle quantity increment/decrement
            document.querySelectorAll('.btnplusminus').forEach(button => {
                button.addEventListener('click', function() {
                    const type = this.getAttribute('data-type');
                    const field = this.getAttribute('data-field');
                    const input = document.getElementById(field);
                    let currentValue = parseInt(input.value) || 1;

                    if (type === 'plus') {
                        input.value = currentValue + 1;
                    } else if (type === 'minus' && currentValue > 1) {
                        input.value = currentValue - 1;
                    }
                });
            });

            // Handle Add to Cart
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const addonId = this.getAttribute('data-addon-id');
                    const type = this.getAttribute('data-type');
                    const quantityField = type === 'addon' ?
                        `qty_${productId}_${addonId}` :
                        `qty_${productId}_0`;
                    const quantity = document.getElementById(quantityField).value;

                    // Show Loader with SweetAlert2
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Adding item to cart',
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        allowOutsideClick: false,
                    });

                    // Perform AJAX request
                    fetch('{{ route('cart.add') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                product_id: productId,
                                addon_id: addonId === '0' ? null : addonId,
                                quantity: quantity,
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.close(); // Close the loader

                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Added to Cart',
                                    text: data.success,
                                    timer: 1000,
                                    showConfirmButton: false,
                                });

                                // Refresh the mini cart
                                window.updateMiniCart();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.error || 'Something went wrong!',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Unable to add item to cart. Please try again later.',
                            });
                            console.error('Error:', error);
                        });
                });
            });
        }
    </script>
@endsection
