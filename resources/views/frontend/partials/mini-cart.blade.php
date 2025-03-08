<ol class="mini-products-list">
    @foreach ($cartItems as $item)
        <li class="item">
            <a href="#" title="{{ $item->product->name }}" class="product-image">
                @if ($item->product->source == 'knobby')
                    <img src="{{ $item->product->knobby_thumbnail_img }}" alt="{{ $item->product->name }}">
                @else
                    <img src="{{ uploaded_asset($item->product->thumbnail_img) }}" alt="{{ $item->product->name }}">
                @endif
                <div class="product-details">
                    <p class="product-name">
                        <a href="#">{{ $item->product->name }}</a>
                        @if ($item->addon)
                            <br><small>Addon: {{ $item->addon->name }}</small>
                        @endif
                    </p>
                    <p class="qty-price">
                        {{ $item->quantity }}X <span
                            class="price">${{ $item->product->unit_price + ($item->addon->unit_price ?? 0) }}</span>
                    </p>
                    <a href="#" title="Remove This Item" class="btn-remove" data-id="{{ $item->id }}"><i
                            class="fas fa-times"></i></a>
                </div>
            </a>
        </li>
    @endforeach
</ol>
<div class="totals">
    <span class="label">Total:</span>
    <span class="price-total"><span class="price">${{ $total }}</span></span>
</div>
<div class="actions">
    <a class="btn btn-dark" href="{{ route('basket') }}">View Cart</a>
    <a class="btn btn-primary" href="{{ route('checkout') }}">Checkout</a>
</div>
