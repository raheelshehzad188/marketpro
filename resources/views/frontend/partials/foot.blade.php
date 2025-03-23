<!-- Vendor -->
<script src="{{ asset('frontend/vendor/plugins/js/plugins.min.js') }}"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{ asset('frontend/js/theme.js') }}"></script>

<!-- Current Page Vendor and Views -->
<script src="{{ asset('frontend/js/views/view.contact.js') }}"></script>

<!-- Theme Custom -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>

<!-- Theme Initialization Files -->
<script src="{{ asset('frontend/js/theme.init.js') }}"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.updateMiniCart = () => {
            fetch('{{ route('cart.mini') }}')
                .then(response => response.json())
                .then(data => {
                    // Replace mini cart HTML
                    document.getElementById('headerTopCartDropdown').innerHTML = data.html;

                    // Update cart quantity in the header
                    document.querySelector('.cart-qty').textContent = data.cartQty;
                })
                .catch(error => console.error('Error updating mini cart:', error));
        };

        // Initial Mini Cart Load
        window.updateMiniCart();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Attach click event listener to dynamically handle remove buttons
        document.addEventListener('click', function(event) {
            if (event.target.closest('.btn-remove')) {
                event.preventDefault();

                const removeButton = event.target.closest('.btn-remove');
                const cartItemId = removeButton.getAttribute('data-id');

                // Show loader with SweetAlert2
                Swal.fire({
                    title: 'Processing...',
                    text: 'Removing item from cart',
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    allowOutsideClick: false,
                });

                // Perform AJAX request to remove the item
                fetch('{{ route('cart.remove') }}', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: cartItemId,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.close(); // Close the loader

                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Item Removed',
                                text: data.success,
                                timer: 1500,
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
                            text: 'Unable to remove item from cart. Please try again later.',
                        });
                        console.error('Error:', error);
                    });
            }
        });
    });
</script>
<script>
    function showSwalMessage() {
        let successMessage = "{{ session('success') }}";
        let errorMessage = "{{ session('error') }}";

        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: successMessage,
                timer: 3000,
                showConfirmButton: false
            });
        }

        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage,
                timer: 3000,
                showConfirmButton: false
            });
        }
    }
    function load_brands(){
        //header_brands
        $.get("{{ route('get_brands') }}", {}, function(data) {
            $('#header_brands').html(data);
        });

    }
    function load_year(){
        $.get("{{ route('get_years') }}", {brand_id :$('#header_brands').val()}, function(data) {
            $('#header_year').html(data);
        });
    }
    function load_model(){
        $.get("{{ route('get_model') }}", {brand_id :$('#header_brands').val(),year_id :$('#header_year').val()}, function(data) {
            $('#header_model').html(data);
        });
    }
    $('#header_brands').change(function () {
        load_year();
        load_model();
    });
    $('#header_year').change(function () {
        load_model();
    });

    document.addEventListener('DOMContentLoaded', function() {
        load_brands();
        showSwalMessage();
    });
</script>
