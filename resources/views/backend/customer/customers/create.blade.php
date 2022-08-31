@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Add New Dealer') }}</h5>
    </div>
    <div class="col-md-12 mx-auto">
        <form class="form form-horizontal" id="register_form" action="{{ route('customers.store') }}" method="POST"
            enctype="multipart/form-data" id="choice_form">
            @csrf
            <input type="hidden" name="added_by" value="admin">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Member Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Name') }}</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" placeholder="{{ translate('Name') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">Company</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="company" placeholder="Company">
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('New Password') }}</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="new_password" placeholder="New Password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Confirm New Password') }}</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="confirm_new_password"
                                placeholder="{{ translate('Confirm New Password') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Email') }}</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" name="email" placeholder="{{ translate('Email') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Contact Number') }}</label>
                        <div class="col-md-8">
                            <input type="tel" class="form-control" name="contact_number"
                                placeholder="{{ translate('Contact Number') }}" required>
                        </div>
                    </div>


                </div>
            </div>

            <div class="mb-3 text-right">
                <button type="button" class="btn btn-primary shadow"
                    onclick="submit_register(this)">Save Dealer <i class="las la-spinner la-spin la-1x actBtn-loader"
                        style="display: none"></i></button>

            </div>
        </form>
    </div>



@endsection

@section('script')

    <script type="text/javascript">
        function submit_register(elm) {
            $(elm).prop('disabled', true);
            $('.actBtn-loader').show();
            $.ajax({
                type: "POST",
                url: '{{ route('customers.store') }}',
                data: $('#register_form').serializeArray(),
                success: function(data) {
                    AIZ.plugins.notify('success', 'Successfully Added!');
                    window.location.href = '{{ route('customers.index') }}';
                },
                error: function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            AIZ.plugins.notify('danger', error[0]);
                        });
                    }
                    $(elm).prop('disabled', false);
                    $('.actBtn-loader').hide();
                }
            });
        }
    </script>

@endsection
