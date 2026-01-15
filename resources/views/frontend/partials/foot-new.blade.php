<!-- Jquery js -->
<script src="{{ static_asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
<!-- Bootstrap Bundle Js -->
<script src="{{ static_asset('frontend/js/boostrap.bundle.min.js') }}"></script>
<!-- Phosphor Icon -->
<script src="{{ static_asset('frontend/js/phosphor-icon.js') }}"></script>
<!-- Select 2 -->
<script src="{{ static_asset('frontend/js/select2.min.js') }}"></script>
<!-- Slick js -->
<script src="{{ static_asset('frontend/js/slick.min.js') }}"></script>
<!-- count down js -->
<script src="{{ static_asset('frontend/js/count-down.js') }}"></script>
<!-- jquery UI js -->
<script src="{{ static_asset('frontend/js/jquery-ui.js') }}"></script>
<!-- wow js -->
<script src="{{ static_asset('frontend/js/wow.min.js') }}"></script>
<!-- AOS Animation -->
<script src="{{ static_asset('frontend/js/aos.js') }}"></script>
<!-- marque -->
<script src="{{ static_asset('frontend/js/marque.min.js') }}"></script>
<!-- vanilla tilt -->
<script src="{{ static_asset('frontend/js/vanilla-tilt.min.js') }}"></script>
<!-- Counter -->
<script src="{{ static_asset('frontend/js/counter.min.js') }}"></script>
<!-- main js -->
<script src="{{ static_asset('frontend/js/main.js') }}"></script>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Wait for jQuery and other libraries to load
    window.addEventListener('load', function() {
        // Initialize Select2 after jQuery is loaded
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.select2 !== 'undefined') {
            jQuery(document).ready(function($) {
                $('.js-example-basic-single').select2();
            });
        }
        
        // Show flash messages
        function showSwalMessage() {
            let successMessage = "{{ session('success') }}";
            let errorMessage = "{{ session('error') }}";

            if (successMessage && typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: successMessage,
                    timer: 3000,
                    showConfirmButton: false
                });
            }

            if (errorMessage && typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        }
        
        showSwalMessage();
    });
</script>

@yield('script')

