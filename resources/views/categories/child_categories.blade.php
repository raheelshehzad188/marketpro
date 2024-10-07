<ul>
    @foreach($childrenCategories as $childCategory)
        <li data-id="{{ $childCategory->id }}">
            <i class="fa fa-plus"></i>
            <label>
                <input id="node-{{ $childCategory->id }}" data-id="{{ $childCategory->id }}" type="checkbox" /> {{ $childCategory->name }}
            </label>
            @if($childCategory->childrenCategories->count() > 0)
                @include('categories.child_categories', ['childrenCategories' => $childCategory->childrenCategories])
            @endif
        </li>
    @endforeach
</ul>
