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
                                <h3 class="fs-16 ff-bold fw-600 text-dark">Garden Types</h3>
                            </div>
                        </div>

                        <div class="col">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600  text-dark">Plant Types</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                <span class="step"></span>
                                <h3 class="fs-16 ff-bold fw-600 text-dark">See Your Results</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="step-form bg-6 pt-sm-5 pt-3  pb-sm-5 pb-3">
        <div class="container">
            <form id="start_quiz" class="start_quiz" method="GET" action="{{ route('packages') }}" autocomplete="off">
                <div class="step-tab text-center">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="fs-36 fw-500">Style Quiz</div>
                            <div class="fs-20 fw-500">Select the top 3 gardens you like best:</div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-9 mx-auto mb-4">
                            <div class="row align-items-start">
                                @foreach ($gardens as $garden)
                                    <div class="mb-3 col-sm-6 align-self-stretch">
                                        <input type="checkbox" value="{{ $garden->id }}" class="btn-check garden-check"
                                            id="btn-check-{{ $garden->id }}" autocomplete="off">
                                        <label class="btn btn-secondary d-block" for="btn-check-{{ $garden->id }}">
                                            <div class="card text-start mb-auto">
                                                <div class=" position-relative">
                                                    <span class="checked"><i class="las la-check"></i></span>


                                                    {{-- <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($garden->logo) }}"
                                                        class=" card-img-top img-fluid lazyload"> --}}
                                                    <div class="w-100 bg-no-repeat bg-cover bg-center card-img-top img-fluid lazyload"
                                                        style="background-image: url('{{ static_asset('assets/img/placeholder.jpg') }}');"
                                                        data-bg="{{ uploaded_asset($garden->logo) }}">
                                                        <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                            data-src="{{ static_asset('assets/img/quz1.jpg') }}"
                                                            class="img-fluid lazyload invisible">
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title ff-bold fs-18 ff-bold">{{ $garden->name }}</h5>
                                                    <ul>
                                                        @if (json_decode($garden->included, true) != null)
                                                            @foreach (json_decode($garden->included, true)['item'] as $key => $value)
                                                                <li>{{ json_decode($garden->included, true)['item'][$key] }}
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>

                {{-- plant type steps --}}
                <div class="step-tab plant_type_step1">

                </div>

                <div class="step-tab plant_type_step2">

                </div>

                <div class="step-tab plant_type_step3">

                </div>
                {{-- end of plant type steps --}}


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
                                @if (auth::check()) value="{{ auth()->user()->email }}" disabled @endif
                                class="form-control border-0 fs-22" id="email" type="email" name="email">
                        </div>
                    </div>
                    <div class="row password_row" style="display: none">
                        <div class="col-12">
                            <label class="fw-500 color-1">You already have an account with us? Enter Password Below</label>
                        </div>
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="Password" class="form-control border-0 fs-22" id="password" type="password"
                                name="password">
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
                                <option value="Facebook">Facebook</option>
                                <option value="Other social media">Other social media</option>
                                <option value="Events">Events</option>
                                <option value="Newspaper / online news">Newspaper / online news</option>
                            </select>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-12 text-center mx-auto all_step_buttons" style="display: block">
                        <button type="button" id="prevBtn" class="btn" onclick="nextPrev(-1)">Previous</button>
                        <button type="button" id="nextBtn"
                            class="btn btn-primary btn-rounded fs-18 fw-500 ff-bold text-uppercase px-5 nextPrev"
                            onclick="nextPrev(1)" disabled>Next <i class="las la-spinner la-spin la-1x actBtn-loader"
                                style="display: none"></i></button>
                    </div>


                    <div class="col-12 text-center mt-3" style="visibility: hidden">
                        <div class="fs-16 fw-600 garden-select-count">0/3 Gardens Selected</div>
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
        var currentTab = 0; // Current step-tab is set to be the first step-tab (0)
        showTab(currentTab); // Display the current step-tab

        function showTab(n) {
            if (n == '0') {
                $('.garden-select-count').css('visibility', 'visible');
            } else {
                $('.garden-select-count').css('visibility', 'hidden');
            }
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

                $('.final_step_buttons').css('display', 'block');
                $('.all_step_buttons').css('display', 'block');
                document.getElementById("nextBtn").innerHTML =
                    'Next <i class="las la-spinner la-spin la-1x actBtn-loader" style="display: none"></i>';
            } else {
                $('.final_step_buttons').css('display', 'none');
                $('.all_step_buttons').css('display', 'block');
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
                var gardens = [];
                $('.garden-check:checked').each(function(i) {
                    gardens[i] = $(this).val();
                });
                $.post("{{ route('cart.quiz') }}", {
                    action: 1,
                    gardens: gardens,
                }, function(data) {
                    $('.plant_type_step1').html(data);
                    x[currentTab].style.display = "none";
                    currentTab = currentTab + n;
                    showTab(currentTab);
                    fixStepIndicator(1);
                    scroll_up();
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
                var plants = [];
                $('.plants-check1:checked').each(function(i) {
                    plants[i] = $(this).val();
                });
                $.post("{{ route('cart.quiz') }}", {
                    action: 2,
                    plants: plants,
                }, function(data) {
                    $('.plant_type_step2').html(data);
                    x[currentTab].style.display = "none";
                    currentTab = currentTab + n;
                    showTab(currentTab);
                    fixStepIndicator(1);
                    scroll_up();
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
                var plants = [];
                $('.plants-check2:checked').each(function(i) {
                    plants[i] = $(this).val();
                });

                $.post("{{ route('cart.quiz') }}", {
                    action: 3,
                    plants: plants,
                }, function(data) {
                    $('.plant_type_step3').html(data);
                    x[currentTab].style.display = "none";
                    currentTab = currentTab + n;
                    showTab(currentTab);
                    fixStepIndicator(1);
                    scroll_up();
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

            if (currentTab == 3) {
                var plants = [];
                $('.plants-check3:checked').each(function(i) {
                    plants[i] = $(this).val();
                });

                $.post("{{ route('cart.quiz') }}", {
                    action: 4,
                    plants: plants,
                }, function(data) {
                    if (data == 'authenticate') {
                        x[currentTab].style.display = "none";
                        currentTab = currentTab + n;
                        showTab(currentTab);
                        fixStepIndicator(1);
                        scroll_up();
                    } else {
                        window.location.replace(data);
                    }
                }).fail(function(err) {
                    if (err.status == 422) {
                        $.each(err.responseJSON.errors, function(i, error) {
                            AIZ.plugins.notify('danger', error[0]);
                        });
                    }
                }).always(function() {
                    $('.nextPrev').prop('disabled', false);
                    $('.actBtn-loader').hide();
                });;

            }

            if (currentTab == 4) {

                $.post("{{ route('cart.quiz') }}", {
                    action: 5,
                    email: $('#email').val(),
                    password: $('#password').val(),
                    heared_about_us: $('#heared_about_us').val()
                }, function(data) {
                    console.log(data);
                    if (data == 'need_password') {
                        $('.password_row').css('display', 'flex');
                        AIZ.plugins.notify('danger', 'Please enter the password');
                    } else {
                        window.location.replace(data);
                    }
                }).fail(function(err) {
                    if (err.status == 422) {
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


        $(document).ready(function() {

            $('.garden-check').on('click', function() {
                var selected_garden = 0;
                $('.garden-check').each(function() { // find unique names
                    if ($(this).is(':checked')) {
                        selected_garden++;
                    }
                });
                $('.garden-select-count').html(selected_garden + '/3 Gardens Selected');
                if (selected_garden == 3) {
                    $('.nextPrev').prop('disabled', false);
                } else {
                    $('.nextPrev').prop('disabled', true);
                }

            });

        });

        function scroll_up() {
            window.scrollTo(0, 0);
        }
    </script>
@endsection
