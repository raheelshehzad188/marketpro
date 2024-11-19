@if (count($products) > 0)
    <select class="select2 form-control aiz-selectpicker" name="{{$target}}" data-toggle="select2"
        data-placeholder="Choose ..." data-live-search="true" required>
        @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>
@endif
