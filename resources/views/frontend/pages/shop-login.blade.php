@extends('frontend.layouts.master')
@section('title', 'Customer Login & Registration')

@section('content')
<div role="main" class="main shop py-4">

    <div class="container py-4">
        <div class="row justify-content-center">
            <!-- Login Form -->
            <div class="col-md-6 col-lg-5 mb-5 mb-lg-0">
                <h2 class="font-weight-bold text-5 mb-0">Login</h2>
                <form action="{{ route('customer.login') }}" id="frmSignIn" method="post" class="needs-validation">
                    @csrf
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label text-color-dark text-3">Email address <span class="text-color-danger">*</span></label>
                            <input type="text" name="email" class="form-control form-control-lg text-4" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
                            <input type="password" name="password" class="form-control form-control-lg text-4" required>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="form-group col-md-auto">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" id="rememberme">
                                <label class="form-label custom-control-label cur-pointer text-2" for="rememberme">Remember Me</label>
                            </div>
                        </div>
                        <div class="form-group col-md-auto">
                            <a class="text-decoration-none text-color-dark text-color-hover-primary font-weight-semibold text-2" href="#" id="forgot-password-link">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <button type="submit" class="btn btn-dark btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">Login</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Register Form -->
            <div class="col-md-6 col-lg-5">
                <h2 class="font-weight-bold text-5 mb-0">Register</h2>
                <form action="{{ route('customer.register') }}" id="frmSignUp" method="post" class="needs-validation">
                    @csrf
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label text-color-dark text-3">Username or Email address <span class="text-color-danger">*</span></label>
                            <input type="text" name="email" class="form-control form-control-lg text-4" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
                            <input type="password" name="password" class="form-control form-control-lg text-4" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-label text-color-dark text-3">Confirm Password <span class="text-color-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg text-4" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <p class="text-2 mb-2">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="#" class="text-decoration-none">privacy policy.</a></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <button type="submit" class="btn btn-dark btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<!-- Add any custom styles if needed -->
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Helper function to format errors for SweetAlert
    function formatErrors(errors) {
        let errorHtml = '<ul style="text-align:left;">';
        Object.keys(errors).forEach(field => {
            errors[field].forEach(msg => {
                errorHtml += `<li>${msg}</li>`;
            });
        });
        errorHtml += '</ul>';
        return errorHtml;
    }

    // AJAX Login Submission
    const loginForm = document.getElementById('frmSignIn');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            let loginData = new FormData(loginForm);

            Swal.fire({
                title: 'Logging in...',
                didOpen: () => Swal.showLoading(),
                allowOutsideClick: false,
            });

            fetch('{{ route("customer.login") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: loginData
                })
                .then(response => response.json())
                .then(data => {
                    Swal.close();
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: data.success,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            // After login, cart merge is handled in the backend.
                            location.reload();
                        });
                    } else if (data.errors) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            html: formatErrors(data.errors)
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: data.error || 'Invalid credentials'
                        });
                    }
                })
                .catch(error => {
                    Swal.close();
                    console.error('Login error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Login failed. Please try again.'
                    });
                });
        });
    }

    // AJAX Register Submission
    const registerForm = document.getElementById('frmSignUp');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            let registerData = new FormData(registerForm);

            Swal.fire({
                title: 'Registering...',
                didOpen: () => Swal.showLoading(),
                allowOutsideClick: false,
            });

            fetch('{{ route("customer.register") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: registerData
                })
                .then(response => response.json())
                .then(data => {
                    Swal.close();
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful',
                            text: data.success,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else if (data.errors) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            html: formatErrors(data.errors)
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Registration Failed',
                            text: data.error || 'Registration failed. Please try again.'
                        });
                    }
                })
                .catch(error => {
                    Swal.close();
                    console.error('Registration error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Registration failed. Please try again.'
                    });
                });
        });
    }

    // AJAX Forgot Password Submission
    const forgotPasswordLink = document.getElementById('forgot-password-link');
    if (forgotPasswordLink) {
        forgotPasswordLink.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Forgot Password?',
                input: 'email',
                inputLabel: 'Enter your email address',
                inputPlaceholder: 'your-email@example.com',
                showCancelButton: true,
                confirmButtonText: 'Send Reset Link',
                showLoaderOnConfirm: true,
                preConfirm: (email) => {
                    return fetch('{{ route("customer.forgot-password") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: new URLSearchParams({ email: email })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText);
                        }
                        return response.json();
                    })
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.value.success,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else if (result.value.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.value.error
                        });
                    }
                }
            });
        });
    }
});
</script>
@endsection
