@if(count($addons) > 0)
<table class="table table-bordered aiz-table">
    <thead>
        <tr>
            <td class="text-center">
                {{translate('Spare Part')}}
            </td>
            <td class="text-center">
                {{translate('Number')}}
            </td>
        </tr>
    </thead>
    <tbody>

        @foreach ($addons as $key => $addon)
            <tr class="variant">
                <td>
                    <label for="" class="control-label">{{ $addon->name }}</label>
                </td>
                <td>
                    <input type="number" lang="en" name="sort_order[{{$addon->id}}]" value="{{$addon->sort_order}}" class="form-control">
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
@endif
