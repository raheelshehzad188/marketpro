<div class="row">
    <div class="col-lg-9 mx-auto mb-4">
        {{-- <div class="row">
            <div class="col">
                <img src="{{ uploaded_asset($garden->logo) }}" class=" card-img-top img-fluid">
            </div>
        </div> --}}

        <div class="row text-center mt-4">
            <div class="col-md-12 mb-5">
                <div class="fs-36 fw-500">Gardens Selected({{ $action }}/3): {{ $garden->name }}</div>
                <div class="fs-20 fw-500">Here are a few popular plants inspired by your garden
                    choice.</div>
                <div class="fs-20 fw-500">Select the plants you like:</div>
            </div>
        </div>

        <div class="row g-1 mt-4 plant-types">
            @foreach ($garden->plants as $plant)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <input type="checkbox" class="btn-check plants-check{{ $action }}" value="{{ $plant->id }}"
                        id="btn-check-{{ $plant->id }}{{ $garden->id }}" autocomplete="off">
                    <label class="btn btn-secondary d-block" for="btn-check-{{ $plant->id }}{{ $garden->id }}">
                        <div class=" position-relative">
                            <span class="checked"><i class="las la-check"></i></span>
                            <img src="{{ uploaded_asset($plant->logo) }}" class="img-fluid">
                        </div>
                    </label>
                </div>
            @endforeach

        </div>
    </div>
</div>
