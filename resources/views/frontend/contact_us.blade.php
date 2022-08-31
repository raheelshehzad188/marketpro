@extends('frontend.layouts.app')

@section('content')



    <section class="step-form bg-6 pt-sm-5 pt-3  pb-sm-5 pb-3">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col">
                            <div class="fs-24 after">CONTACT US</div>

                            <div class="fs-32 mt-3">We’d love to hear from you</div>

                            <div class="fs-18 mb-2">Have questions about our process, how we work, what you can expect? Feel free to give us a call or chat with a team member at project@waterefficientgardens.com</div>
                            <div class="d-block color-2 fs-32"><a href="" class="me-2"><i class="las la-phone"></i></a> <a href=""><i class="lar la-envelope"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <form id="start_project" method="GET" action="{{ route('packages') }}" autocomplete="off">
                        <div class="step-tab text-center">
                            <div class="row">
                                <div class="col-md-6 mx-auto mb-5">
                                    <input placeholder="First Name" class="form-control border-0 fs-22" type="text" name="">
                                </div>
                                <div class="col-md-6 mx-auto mb-5">
                                    <input placeholder="Last Name" class="form-control border-0 fs-22" type="text" name="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mx-auto mb-5">
                                    <input placeholder="Email" class="form-control border-0 fs-22" type="email"
                                        name="email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mx-auto mb-5">
                                    <textarea class="form-control fs-22 p-2" rows="10"
                                        placeholder="How can we help?"></textarea>
                                </div>
                            </div>


                        </div>




                        <div class="row">
                            <div class="col-12 ">
                                <button type="button" id="nextBtn"
                                    class="btn btn-primary btn-rounded fs-18 fw-500 ff-bold text-uppercase px-5">Submit</button>
                            </div>
                        </div>

                    </form>
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
                document.getElementById("nextBtn").innerHTML = "Next";
            } else {
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
