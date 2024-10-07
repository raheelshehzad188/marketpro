<div class="card">
    <div class="card-header">
        <div id="selectedTags-{{ $treeviewId }}">
            @if (isset($selectedCategoryNames) && count($selectedCategoryNames) > 0)
                @foreach ($selectedCategoryNames as $category)
                    <button type="button" class="btn border tag px-3 py-2 mr-1 mb-1" data-id="{{ $category->id }}">
                        @if ($treeviewType == 'addon')
                            {{ $category->sku }} <span class="badge badge-light delete-tag">X</span>
                        @else
                            {{ $category->name }} <span class="badge badge-light delete-tag">X</span>
                        @endif

                    </button>
                @endforeach
            @endif
        </div>
    </div>

    <div class="card-body pt-2">
        <div class="form-group mb-4">
            <input type="text" class="searchInput form-control form-control-sm"
                data-treeview-id="{{ $treeviewId }}" data-treeview-type="{{ $treeviewType }}" placeholder="Type to search, clear to view all items">
        </div>
        <div class="h-300px overflow-auto c-scrollbar-light">
            <div id="hummingbird-base-{{ $treeviewId }}" class="treeview-container hummingbird-treeview">
                {{-- <div id="treeview_container" class="hummingbird-treeview"> --}}
                <ul id="{{ $treeviewId }}" class="hummingbird-base" data-single-select='true'
                    data-selected-categories="{{ isset($selectedCategories) ? json_encode($selectedCategories) : '[]' }}"
                    data-type="{{ $treeviewType }}">
                    @foreach ($nodes as $node)
                        <li>
                            @if ($node->childrenCategories->count() > 0)
                                <i class="fa fa-plus" data-expand="true"></i>
                            @else
                                <i class="fa fa-empty" data-expand="true"></i>
                            @endif
                            <label>
                                <input id="node-{{ $treeviewId }}-{{ $node->id }}" data-id="{{ $node->id }}"
                                    type="checkbox"
                                    {{ isset($selectedCategories) && in_array($node->id, $selectedCategories) ? 'checked' : '' }}
                                    {{ $treeviewType == 'category' ? '' : 'disabled' }} />
                                {{ $node->name }}


                            </label>
                            @if ($node->childrenCategories->count() > 0)
                                <ul id="children-{{ $treeviewId }}-{{ $node->id }}" style="display: none;"></ul>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <input type="hidden" name="selectedCategories_{{ $treeviewId }}"
                    id="selectedCategories-{{ $treeviewId }}"
                    value="{{ isset($selectedCategories) ? implode(',', $selectedCategories) : '' }}" data-single-select="{{ isset($singleSelect) ? $singleSelect : 'false' }}">
            </div>

            <div id="hummingbird-search-results-{{ $treeviewId }}" class="treeview-container hummingbird-treeview"
                style="display: none;">
                <!-- Search results will be populated here for treeview1 -->
            </div>

        </div>


    </div>
</div>
