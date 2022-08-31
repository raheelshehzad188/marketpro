@extends('frontend.layouts.app')

@section('content')
    <section class="pt-5 bg-6">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div class="row aiz-steps arrow-divider">
                        <div class="col active">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600 text-dark">Share Info</h3>
                            </div>
                        </div>

                        <div class="col">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600  text-dark">Select a Package</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600 text-dark">Start Saving Water</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="step-form bg-6 pt-sm-5 pt-3  pb-sm-5 pb-3">
        <div class="container">
            <form id="start_project" autocomplete="off">

                    <div class="step-tab text-center">
                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <div class="fs-36 fw-500">What’s Your Email?</div>
                                <div class="fs-20 fw-500">We promise not to spam you!</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-7 mx-auto mb-5">
                                <input placeholder="Email"
                                    @if (!empty($email)) value="{{ $email }}" @endif
                                    class="form-control border-0 fs-22" id="email" type="email" name="email">
                            </div>
                        </div>
                        <div class="row password_row" style="display: none">
                            <div class="col-12">
                                <label class="fw-500 color-1">You already have an account with us? Enter Password
                                    Below</label>
                            </div>
                            <div class="col-12 col-md-7 mx-auto mb-5">
                                <input placeholder="Password" class="form-control border-0 fs-22" id="password"
                                    type="password" name="password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-7 mx-auto mb-5">
                                <select class="form-select form-select-lg theme mb-3" aria-label=".form-select-lg example"
                                    style="background-image:url('{{ static_asset('assets/img/down-arrow.png') }}')"
                                    id="heared_about_us">
                                    <option selected>How did you find us? (optional)</option>
                                    <option value="Google search">Google search</option>
                                    <option value="Nextdoor">Nextdoor</option>
                                    <option value="Friends">Friends</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Neighbor">Neighbor</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Other social media">Other social media</option>
                                    <option value="Events">Events</option>
                                    <option value="Newspaper / online news">Newspaper / online news</option>

                                </select>
                            </div>
                        </div>


                    </div>



                <div class="step-tab text-center">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="fs-36 fw-500">Where Is Your Site Located?</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="las la-search fs-24"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control border-0 fs-22" id="address" name="address"
                                    @if (auth::check()) value="{{ auth()->user()->address }}" @endif
                                    placeholder="Type your address" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="Phone number"
                                @if (auth::check()) value="{{ auth()->user()->phone }}" @endif id="phone"
                                type="text" class="form-control border-0 fs-22" name="phone">
                        </div>
                    </div> --}}


                </div>

                <div class="step-tab text-center">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="fs-36 fw-500">Tell Us About Your Project</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="fs-20 fw-500">Where are you planning to build your garden? Select one.</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 mx-auto mb-4">
                            <div class="row">
                                <div class="mb-3 col">
                                    <input type="radio" class="btn-check" name="about_project" value="Front Yard"
                                        id="option1" autocomplete="off">
                                    <label class="btn btn-secondary d-block" for="option1">Front Yard</label>
                                </div>
                                <div class="mb-3 col">
                                    <input type="radio" class="btn-check" value="Backyard" name="about_project"
                                        id="option2" autocomplete="off">
                                    <label class="btn btn-secondary d-block" for="option2">Backyard</label>
                                </div>
                                <div class="mb-3 col">
                                    <input type="radio" class="btn-check" value="Front & Backyard" name="about_project"
                                        id="option3" autocomplete="off">
                                    <label class="btn btn-secondary d-block" for="option3">Front & Backyard</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="fs-20 fw-500">What elements would you like to include? Select all that apply.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 mx-auto mb-4">
                            <div class="row">
                                <div class="mb-3 col">
                                    <input type="checkbox" class="btn-check include" value="Plants" id="btn-check-2"
                                        autocomplete="off">
                                    <label class="btn btn-secondary d-block" for="btn-check-2">Plants</label>
                                </div>
                                <div class="mb-3 col">
                                    <input type="checkbox" class="btn-check include" value="Rain Garden/Dry River"
                                        id="btn-check-3" autocomplete="off">
                                    <label class="btn btn-secondary d-block" for="btn-check-3">Rain Garden/Dry River
                                        Bed</label>
                                </div>
                                <div class="mb-3 col">
                                    <input type="checkbox" class="btn-check include" value="Walking Path/ Stepping Stones"
                                        id="btn-check-4" autocomplete="off">
                                    <label class="btn btn-secondary d-block" for="btn-check-4">Walking Path/ Stepping
                                        Stones</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <input type="checkbox" class="btn-check include" value="Hardscapes" id="btn-check-5"
                                        autocomplete="off">
                                    <label class="btn btn-secondary d-block" for="btn-check-5">Hardscapes</label>
                                </div>
                                <div class="mb-3 col">
                                    <input type="checkbox" class="btn-check include" value="Pergola/Gazebo" id="btn-check-6"
                                        autocomplete="off">
                                    <label class="btn btn-secondary d-block" for="btn-check-6">Pergola/Gazebo</label>
                                </div>
                                <div class="mb-3 col">
                                    <input type="checkbox" class="btn-check include" value="Graywater Reuse
                                                                            (Laundry to Landscape)" id="btn-check-7"
                                        autocomplete="off">
                                    <label class="btn btn-secondary d-block" for="btn-check-7">Graywater Reuse
                                        (Laundry to Landscape)</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="fs-20 fw-500">Please provide any additional information that would<br> be useful in planning your garden design.</div>
                        </div>
                        <div class="col-lg-7 mx-auto mb-5">
                            <textarea class="form-control" rows="10" name="comments" id="comments"></textarea>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-8 text-center mx-auto">
                        <button type="button" id="prevBtn" class="btn" onclick="nextPrev(-1)">Previous</button>
                        <button type="button" id="nextBtn"
                            class="btn btn-primary btn-rounded fs-18 fw-500 ff-bold text-uppercase px-5 nextPrev"
                            onclick="nextPrev(1)">Next <i class="las la-spinner la-spin la-1x actBtn-loader"
                                style="display: none"></i></button>

                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        @if (empty($step))
            var currentTab = 0; // Current step-tab is set to be the first step-tab (0)
        @else
            var currentTab = 1;
        @endif

        showTab(currentTab); // Display the current step-tab

        function showTab(n) {
            // This function will display the specified step-tab of the form...
            var x = document.getElementsByClassName("step-tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML =
                    'Next <i class="las la-spinner la-spin la-1x actBtn-loader" style="display: none"></i>';
            } else {
                document.getElementById("nextBtn").innerHTML =
                    'Next <i class="las la-spinner la-spin la-1x actBtn-loader" style="display: none"></i>';
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(0)
        }

        function nextPrev(n) {
            // This function will figure out which step-tab to display
            var x = document.getElementsByClassName("step-tab");

            $('.nextPrev').prop('disabled', true);
            $('.actBtn-loader').show();
            if (currentTab == 0) {
                $.post("{{ route('cart.startProjectCart') }}", {
                    action: 1,
                    email: $('#email').val(),
                    password: $('#password').val(),
                    heared_about_us: $('#heared_about_us').val()
                }, function(data) {
                    if (data == 'need_password') {
                        $('.password_row').css('display', 'flex');
                        AIZ.plugins.notify('danger', 'Please enter the password');
                    } else {
                        x[currentTab].style.display = "none";
                        currentTab = currentTab + n;
                        showTab(currentTab);
                    }
                }).fail(function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            AIZ.plugins.notify('danger', error[0]);
                        });
                    }
                }).always(function() {
                    $('.nextPrev').prop('disabled', false);
                    $('.actBtn-loader').hide();
                });;

            }

            if (currentTab == 1) {
                $.post("{{ route('cart.startProjectCart') }}", {
                    action: 2,
                    address: $('#address').val(),
                    phone: $('#phone').val()
                }, function(data) {
                    x[currentTab].style.display = "none";
                    currentTab = currentTab + n;
                    showTab(currentTab);
                }).fail(function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            AIZ.plugins.notify('danger', error[0]);
                        });
                    }
                }).always(function() {
                    $('.nextPrev').prop('disabled', false);
                    $('.actBtn-loader').hide();
                });;

            }

            if (currentTab == 2) {
                var val = [];
                $('.include:checked').each(function(i) {
                    val[i] = $(this).val();
                });
                $.post("{{ route('cart.startProjectCart') }}", {
                    action: 3,
                    about_project: $('input[name=about_project]:checked').val(),
                    include: val,
                    comments: $('#comments').val()
                }, function(data) {
                    if (data == 'package') {
                        window.location.href = "{{ route('packages') }}";
                    } else {
                        window.location.href = "{{ route('confirm_order') }}";
                    }

                    return false;
                }).fail(function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            AIZ.plugins.notify('danger', error[0]);
                        });
                    }
                }).always(function() {
                    $('.nextPrev').prop('disabled', false);
                    $('.actBtn-loader').hide();
                });;

            }



        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("step-tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current step-tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return true; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    </script>
@endsection
