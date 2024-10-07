<!doctype html>
@if (\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
    <html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">
    <title>{{ get_setting('website_name') . ' | ' . get_setting('site_motto') }}</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="{{ static_asset('assets/back/css/vendors.css') }}">
    @if (\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
        <link rel="stylesheet" href="{{ static_asset('assets/back/css/bootstrap-rtl.min.css') }}">
    @endif

    <!-- Required Stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/hummingbird-dev/hummingbird-treeview@v3.0.5/hummingbird-treeview.min.css"
        rel="stylesheet">


    <link rel="stylesheet" href="{{ static_asset('assets/back/css/aiz-core.css') }}">
    <link rel="stylesheet" href="{{ static_asset('jstree/jstree.bundle.css') }}" />

    @yield('style')
    <style>
        body {
            font-size: 12px;
        }

        .hummingbird-treeview,
        .hummingbird-treeview * {
            font-size: 14px;
            line-height: 14px;
        }

        .hummingbird-base {
            padding: 0;
        }

        /* .hummingbird-treeview {
            border: 1px solid #e2e5ec;
            padding: 13px;
            border-radius: 5px;

        } */

        .hummingbird-treeview .fa {
            font-style: normal;
            cursor: pointer;
            margin: 0 5px 0 0px;
        }

        i.fa.fa-empty {
            display: inline-block;
            width: 11px;
        }

        .hummingbird-treeview input[type=checkbox]:disabled {
            display: none;
            opacity: 0.4 !important;
        }
    </style>
    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: '{{ translate('Nothing selected') }}',
            nothing_found: '{{ translate('Nothing found') }}',
            choose_file: '{{ translate('Choose file') }}',
            file_selected: '{{ translate('File selected') }}',
            files_selected: '{{ translate('Files selected') }}',
            add_more_files: '{{ translate('Add more files') }}',
            adding_more_files: '{{ translate('Adding more files') }}',
            drop_files_here_paste_or: '{{ translate('Drop files here, paste or') }}',
            browse: '{{ translate('Browse') }}',
            upload_complete: '{{ translate('Upload complete') }}',
            upload_paused: '{{ translate('Upload paused') }}',
            resume_upload: '{{ translate('Resume upload') }}',
            pause_upload: '{{ translate('Pause upload') }}',
            retry_upload: '{{ translate('Retry upload') }}',
            cancel_upload: '{{ translate('Cancel upload') }}',
            uploading: '{{ translate('Uploading') }}',
            processing: '{{ translate('Processing') }}',
            complete: '{{ translate('Complete') }}',
            file: '{{ translate('File') }}',
            files: '{{ translate('Files') }}',
        }
    </script>

</head>

<body class="{{ areCloseRoutes(['poin-of-sales.index', 'poin-of-sales.create']) }}">

    <div class="aiz-main-wrapper">
        @include('backend.inc.admin_sidenav')
        <div class="aiz-content-wrapper">
            @include('backend.inc.admin_nav')
            <div class="aiz-main-content">
                <div class="px-15px px-lg-25px">
                    @yield('content')
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; {{ get_setting('site_name') }} v{{ get_setting('current_version') }}</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    @yield('modal')

    @php
        $fake_price = Session::get('fake_price');
        if ($fake_price == 'yes') {
            $button_text = 'Show Retail Price';
        } else {
            $fake_price = 'no';
            $button_text = 'Show Customer Price';
        }
    @endphp
    <script src="{{ static_asset('assets/back/js/vendors.js') }}"></script>
    <!-- Required Javascript -->




    <!-- Required Javascript -->



    <script src="{{ static_asset('assets/back/js/aiz-core.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/hummingbird-dev/hummingbird-treeview@v3.0.5/hummingbird-treeview.min.js">
    </script>

    <script src="{{ static_asset('jstree/jstree.bundle.js') }}"></script>

    @yield('script')

    <script type="text/javascript">
        @foreach (session('flash_notification', collect())->toArray() as $message)
            AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');
        @endforeach


        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-menu a').each(function() {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('{{ route('language.change') }}', {
                        _token: '{{ csrf_token() }}',
                        locale: locale
                    }, function(data) {
                        location.reload();
                    });

                });
            });
        }



        function menuSearch() {
            var filter, item;
            filter = $("#menu-search").val().toUpperCase();
            items = $("#main-menu").find("a");
            items = items.filter(function(i, item) {
                if ($(item).find(".aiz-side-nav-text")[0].innerText.toUpperCase().indexOf(filter) > -1 && $(item)
                    .attr('href') !== '#') {
                    return item;
                }
            });

            if (filter !== '') {
                $("#main-menu").addClass('d-none');
                $("#search-menu").html('')
                if (items.length > 0) {
                    for (i = 0; i < items.length; i++) {
                        const text = $(items[i]).find(".aiz-side-nav-text")[0].innerText;
                        const link = $(items[i]).attr('href');
                        $("#search-menu").append(
                            `<li class="aiz-side-nav-item"><a href="${link}" class="aiz-side-nav-link"><i class="las la-ellipsis-h aiz-side-nav-icon"></i><span>${text}</span></a></li`
                        );
                    }
                } else {
                    $("#search-menu").html(
                        `<li class="aiz-side-nav-item"><span	class="text-center text-muted d-block">{{ translate('Nothing Found') }}</span></li>`
                    );
                }
            } else {
                $("#main-menu").removeClass('d-none');
                $("#search-menu").html('')
            }
        }

        function update_switch_price(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.get('{{ route('switch.price', $fake_price) }}', {
                _token: '{{ csrf_token() }}',
            }, function(data) {

                if (data == 'yes') {
                    $('.fake_price_span').css('display', 'block');
                    $('.real_price_span').css('display', 'none');
                } else {
                    $('.fake_price_span').css('display', 'none');
                    $('.real_price_span').css('display', 'block');
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            initializeHummingbirdTreeview();

            // Delegate click event for expand/collapse icons


            $('body').on('click', '[data-expand]', function() {
                const isExpanding = $(this).attr('data-expand') === 'true';
                let icon = $(this);
                let checkbox = icon.next('label').find('input[type="checkbox"]');
                let treeview = checkbox.closest('.hummingbird-base');
                let treeviewId = treeview.attr('id');
                let treeviewType = treeview.data('type');

                let isProduct = checkbox.data('isproduct');

                toggleChildren(checkbox, isExpanding, icon, treeviewId, treeviewType, isProduct);
            });



            $('body').on('change', '.hummingbird-base input[type="checkbox"]', function() {
                let treeviewId = $(this).closest('.hummingbird-base').attr('id');
                let singleSelect = $(`#selectedCategories-${treeviewId}`).data('single-select');
                let nodeId = $(this).data('id').toString();
                let nodeName = $(this).closest('label').text().trim();
                let selectedIds = $(`#selectedCategories-${treeviewId}`).val().split(',');

                // Enforce single selection if enabled
                if (singleSelect && $(this).is(':checked')) {
                    // Uncheck all other checkboxes and update selected IDs
                    $(`.hummingbird-base#${treeviewId} input[type="checkbox"]`).not(this).each(function() {
                        $(this).prop('checked', false);
                        let otherNodeId = $(this).data('id').toString();
                        $(`#selectedTags-${treeviewId} .tag[data-id="${otherNodeId}"]`).remove();
                    });
                    selectedIds = [nodeId]; // Keep only the current nodeId
                } else if ($(this).is(':checked')) {
                    if (!selectedIds.includes(nodeId)) {
                        selectedIds.push(nodeId);
                    }
                } else {
                    $(`#selectedTags-${treeviewId} .tag[data-id="${nodeId}"]`).remove();
                    selectedIds = selectedIds.filter(id => id !== nodeId);
                }

                // Update the hidden input and manage tag addition
                $(`#selectedCategories-${treeviewId}`).val(selectedIds.join(','));
                if ($(this).is(':checked') && !$(`#selectedTags-${treeviewId} .tag[data-id="${nodeId}"]`)
                    .length) {
                    $(`#selectedTags-${treeviewId}`).append(
                        `<button type="button" class="btn border tag px-3 py-2 mr-1 mb-1" data-id="${nodeId}">${nodeName} <span class="badge badge-light delete-tag">X</span></button>`
                    );
                }

                // Custom function call if necessary
                if ($('#update_sku').length > 0) {
                    update_sku();
                }
            });

            $('body').on('click', '.delete-tag', function() {
                let tag = $(this).closest('.tag');
                let nodeId = tag.data('id').toString();
                let treeviewId = tag.closest('[id^="selectedTags"]').attr('id').replace('selectedTags-',
                '');
                let checkbox = $(`#${treeviewId} input[type="checkbox"][data-id="${nodeId}"]`);
                let hiddenInput = $(`#selectedCategories-${treeviewId}`);
                let selectedIds = hiddenInput.val().split(',').filter(Boolean);

                // Uncheck the checkbox, update UI and hidden input
                checkbox.prop('checked', false);
                tag.remove();
                selectedIds = selectedIds.filter(id => id !== nodeId);
                hiddenInput.val(selectedIds.join(','));

                // Custom function call if necessary
                if ($('#update_sku').length > 0) {
                    update_sku();
                }
            });








            $('.searchInput').on('keyup', function() {
                var searchTerm = $(this).val();
                var treeviewId = $(this).data('treeview-id');
                var searchType = $(this).data('treeview-type');

                if (searchTerm.length > 0) {
                    // Perform AJAX call to fetch search results
                    $.ajax({
                        url: '{{ route('products.searchNodes') }}', // Update with your endpoint
                        type: 'GET',
                        data: {
                            term: searchTerm,
                            treeviewId: treeviewId,
                            searchType: searchType
                        },
                        success: function(response) {
                            // Hide the original treeview
                            $('#hummingbird-base-' + treeviewId).hide();

                            // Fetch the currently selected categories to maintain state consistency
                            let selectedCategories = $(`#selectedCategories-${treeviewId}`)
                                .val().split(',');

                            // Start constructing the new treeview structure for the search results
                            var resultsHtml = '<ul id="' + treeviewId +
                                '" class="hummingbird-base">';

                            response.nodes.forEach(function(node) {
                                // Check if this node is already selected
                                let isChecked = selectedCategories.includes(String(node
                                    .id)) ? 'checked' : '';

                                // Construct the HTML for each node
                                resultsHtml += `
                                        <li>
                                            <label>
                                                <input type="checkbox" id="node-${node.id}" data-id="${node.id}" ${isChecked}> ${node.name}
                                            </label>
                                        </li>`;
                            });

                            resultsHtml += '</ul>';

                            // Populate and show the search results container
                            var searchResultsContainer = $('#hummingbird-search-results-' +
                                treeviewId);
                            searchResultsContainer.html(resultsHtml).show();

                            // Initialize Hummingbird Treeview for the new search results
                            searchResultsContainer.hummingbird({
                                checkChildren: false
                            });
                        },

                        error: function(error) {
                            console.error('Search error:', error);
                        }
                    });
                } else {
                    // If search term is cleared, show the original tree and hide search results
                    $('#hummingbird-base-' + treeviewId).show();
                    $('#hummingbird-search-results-' + treeviewId).hide().empty();
                }
            });
        });




        function toggleChildren(checkbox, expand, icon, treeviewId, treeviewType, isProduct) {
            let nodeId = checkbox.data('id');
            let childrenContainerId = `children-${treeviewId}-${nodeId}`;

            if (expand) {
                icon.attr('data-expand', 'false').removeClass('fa-plus').addClass('fa-minus');
                if ($(`#${childrenContainerId}`).length === 0 || $(`#${childrenContainerId}`).is(':empty')) {
                    loadChildren(nodeId, treeviewType, treeviewId, isProduct); // Pass treeviewType to loadChildren
                } else {
                    $(`#${childrenContainerId}`).show();
                }
            } else {
                icon.attr('data-expand', 'true').removeClass('fa-minus').addClass('fa-plus');
                $(`#${childrenContainerId}`).hide();
            }
        }

        function loadChildren(nodeId, componentType, treeviewId, isProduct) {
            let parentContainerId = `children-${treeviewId}-${nodeId}`;
            let loaderId = `loader-${treeviewId}-${nodeId}`; // Unique ID for the loader

            // Fetch the selected categories from the hidden input's value
            let selectedCategories = $(`#selectedCategories-${treeviewId}`).val().split(',').filter(Boolean);

            // Check if the container for children exists, if not, create it
            if ($(`#${parentContainerId}`).length === 0) {
                $(`#node-${treeviewId}-${nodeId}`).after(`<ul id="${parentContainerId}" style="display: none;"></ul>`);
            }

            // Create the loader element if it doesn't exist and show it
            if ($(`#${loaderId}`).length === 0) {
                $(`#${parentContainerId}`).before(
                    `<div id="${loaderId}" class="spinner-grow text-secondary spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>`
                );
            } else {
                $(`#${loaderId}`).show(); // Show the loader if it already exists
            }


            // Construct the URL based on whether we're loading categories, products, or addons
            let url = `{{ route('products.loadNodes') }}?type=${componentType}&parentId=${nodeId}`;
            if (componentType === 'addon' && isProduct) {
                url = `{{ route('products.loadNodes') }}?type=product&productId=${nodeId}`;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    let content = '';
                    data.forEach(node => {
                        let isSelected = selectedCategories.includes(String(node.id));

                        // Determine the icon class based on whether the node is a category or product and if it has children
                        let iconClass;
                        if (node.isProduct) {
                            // If it's a product and has children, it means it has addons
                            iconClass = node.has_children ? 'fa fa-plus' : 'fa fa-empty';
                        } else {
                            // For categories, the logic remains the same
                            iconClass = node.has_children ? 'fa fa-plus' : 'fa fa-empty';
                        }

                        // Determine if the checkbox should be disabled
                        // Disabling checkbox for categories if componentType is product, and for products if componentType is addon but product has no children
                        let isDisabled = (node.type === 'category' && componentType === 'product') || (node
                            .type === 'category' && componentType === 'addon') || (node.type ===
                            'product' && componentType === 'addon') || (node.isProduct && componentType ===
                            'addon' && !node.has_children) ? 'disabled' : '';

                        // Construct the HTML content for each node
                        content +=
                            `<li id="node-${treeviewId}-${node.id}">
                            <i class="${iconClass}" data-expand="${node.has_children}"></i>
                            <label><input data-isProduct="${node.isProduct}" data-id="${node.id}" type="checkbox" ${isSelected ? 'checked' : ''} ${isDisabled} /> ${node.name}</label>
                        </li>`;
                    });

                    $(`#${parentContainerId}`).html(content).show();
                    $(`#${loaderId}`).hide(); // Hide the loader after content is loaded
                    initializeHummingbirdTreeview();
                })
                .catch(error => {
                    console.error('Error loading children:', error);
                    $(`#${loaderId}`).hide(); // Hide the loader on error as well
                });
        }


        function initializeHummingbirdTreeview() {
            $('.hummingbird-base').hummingbird({
                checkChildren: false
            });
        }
    </script>


</body>

</html>
