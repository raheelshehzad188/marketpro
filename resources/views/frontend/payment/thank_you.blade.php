@extends('frontend.layouts.app')

@section('content')




    <section class="step-form bg-6 pt-sm-5 pt-3  pb-sm-5 pb-3">
        <div class="container">
            <form id="" action="" autocomplete="off">
                <div class="step-tab text-center">
                    <div class="row">
                        <div class="col-md-6 mb-5 mx-auto">
                            <div class="fs-36 fw-500">Thank You!</div>
                            <div class="fs-20 fw-500">A confirmation has been sent to your email. Let’s save your info and finish setting up your account:</div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="Enter Password" class="form-control border-0 fs-22" type="password" name="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-7 mx-auto mb-5">
                            <input placeholder="Confirm Password" type="password" class="form-control border-0 fs-22"
                                name="heared_about_us">
                        </div>
                    </div> --}}


                </div>




                {{-- <div class="row">
                    <div class="col-md-8 text-center mx-auto">

                        <button type="button" id="nextBtn"
                            class="btn btn-primary btn-rounded fs-18 fw-500 ff-bold text-uppercase px-5"
                            onclick="">Save</button>
                    </div>
                </div> --}}

            </form>
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
                document.getElementById("regForm").submit();
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
