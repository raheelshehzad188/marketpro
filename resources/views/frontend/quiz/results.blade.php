@extends('frontend.layouts.app')

@section('content')


    <section class="pt-5 bg-6">
        <div class="container">
            <div class="row text-center">
                <div class="col-xl-6 mx-auto">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="fs-36 fw-500">Your Garden Style</div>
                            <div class="fs-20 fw-500 text-start">{!! $results->description !!}</div>
                            <div class="ff-bold fs-18 mt-4">Want to see a professional garden design for your style?</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center ">
                            <a href="<?= route('start_project') ?>?step=skip" class="btn btn-primary  ff-bold fs-20 btn-rounded px-5">START MY PROJECT</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="fs-16 mt-4 mb-5"> Question? <a href="{{route('contact-us')}}">Contact Us</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="step-form  pt-sm-5 pt-3  pb-sm-5 pb-3">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 mb-5">
                    <div class="fs-36 fw-500">My Results</div>
                </div>
            </div>


            <div class="row">
                @foreach ($gardens as $garden)
                    <div class="col-md-4">
                        <div class="w-100 bg-no-repeat bg-cover bg-center lazyload mb-2"
                            style="background-image: url('{{ uploaded_asset($garden->logo) }}');"
                            data-bg="{{ static_asset('assets/img/qr1.jpg') }}">
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                class="img-fluid lazyload invisible" data-src="{{ static_asset('assets/img/qr1.jpg') }}">
                        </div>
                        <div class="body">
                            <div class="fs-18 ff-bold">{{ $garden->name }}</div>
                            <ul class="ps-3">
                                @if (json_decode($garden->included, true) != null)
                                    @foreach (json_decode($garden->included, true)['item'] as $key => $value)
                                        <li class="pt-2">
                                            {{ json_decode($garden->included, true)['item'][$key] }}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="row">
                <div class="row g-4 mt-4 plant-types">

                    @foreach ($plants as $plant)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class=" position-relative">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($plant->logo) }}" class="img-fluid lazyload">
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>


        </div>
    </section>
@endsection

@section('script')
    <script>
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
                $('.all_step_buttons').css('display', 'none');
                document.getElementById("nextBtn").innerHTML = "Next";
            } else {
                $('.final_step_buttons').css('display', 'none');
                $('.all_step_buttons').css('display', 'block');
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(0)
        }

        function nextPrev(n) {
            // This function will figure out which step-tab to display
            var x = document.getElementsByClassName("step-tab");
            // Exit the function if any field in the current step-tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current step-tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current step-tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("start_project").submit();
                return false;
            }
            // Otherwise, display the correct step-tab:
            showTab(currentTab);
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
