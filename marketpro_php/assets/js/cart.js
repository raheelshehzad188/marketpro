// Simple Cart AJAX
(function($) {
    const Cart = {
        apiUrl: 'api/cart_api.php',
        
        init: function() {
            this.loadCart();
            this.bindEvents();
        },
        
        loadCart: function() {
            const self = this;
            $('#cart-loading').removeClass('d-none');
            $('#cart-items-wrapper').addClass('d-none');
            $('#cart-empty').addClass('d-none');
            
            $.ajax({
                url: self.apiUrl,
                type: 'GET',
                data: { action: 'get_cart' },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.items.length > 0) {
                        self.renderCart(response.items, response.totals);
                    } else {
                        self.showEmptyCart();
                    }
                },
                error: function() {
                    alert('Cart load failed');
                },
                complete: function() {
                    $('#cart-loading').addClass('d-none');
                }
            });
        },
        
        renderCart: function(items, totals) {
            const tbody = $('#cart-items-tbody');
            tbody.empty();
            
            items.forEach(function(item) {
                const imagePath = item.image.startsWith('http') || item.image.startsWith('/') 
                    ? item.image 
                    : '../' + item.image;
                
                tbody.append(`
                    <tr data-cart-item-id="${item.id}">
                        <td>
                            <button type="button" class="remove-cart-item flex-align gap-12 hover-text-danger-600" data-cart-item-id="${item.id}">
                                <i class="ph ph-x-circle text-2xl d-flex"></i>
                                Remove
                            </button>
                        </td>
                        <td>
                            <div class="table-product d-flex align-items-center gap-24">
                                <a href="product-details.php?id=${item.product_id}" class="table-product__thumb border border-gray-100 rounded-8 flex-center">
                                    <img src="${imagePath}" alt="${item.name}">
                                </a>
                                <div class="table-product__content text-start">
                                    <h6 class="title text-lg fw-semibold mb-8">
                                        <a href="product-details.php?id=${item.product_id}" class="link text-line-2">${item.name}</a>
                                    </h6>
                                    
                                    ${item.tags ? `
                                    <div class="d-flex flex-wrap gap-8 mb-12">
                                        ${item.tags.map(tag => `<span class="badge bg-main-50 text-main-600 px-12 py-4 rounded-4 text-xs">${tag}</span>`).join('')}
                                    </div>
                                    ` : ''}
                                    
                                    <div class="flex-align gap-16 mb-8">
                                        <div class="flex-align gap-6">
                                            <span class="text-md fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                            <span class="text-md fw-semibold text-gray-900">${item.rating ? item.rating.toFixed(1) : '4.5'}</span>
                                        </div>
                                        <span class="text-sm fw-medium text-gray-200">|</span>
                                        <span class="text-neutral-600 text-sm">${item.total_reviews || 128} Reviews</span>
                                    </div>
                                    
                                    ${item.reviews && item.reviews.length > 0 ? `
                                    <div class="product-reviews mt-12">
                                        <div class="text-xs text-gray-600 mb-8 fw-semibold">Recent Reviews:</div>
                                        ${item.reviews.slice(0, 2).map(review => `
                                            <div class="review-item mb-8 pb-8 border-bottom border-gray-100">
                                                <div class="flex-between align-items-start mb-4">
                                                    <span class="text-sm fw-semibold text-gray-900">${review.name}</span>
                                                    <div class="flex-align gap-4">
                                                        ${Array.from({length: 5}, (_, i) => 
                                                            `<i class="ph ${i < review.rating ? 'ph-fill' : ''} ph-star text-warning-600 text-xs"></i>`
                                                        ).join('')}
                                                    </div>
                                                </div>
                                                <p class="text-xs text-gray-600 mb-4">${review.comment}</p>
                                                <span class="text-xs text-gray-400">${review.date}</span>
                                            </div>
                                        `).join('')}
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-lg h6 mb-0 fw-semibold">$${parseFloat(item.price).toFixed(2)}</span>
                        </td>
                        <td>
                            <div class="d-flex rounded-4 overflow-hidden">
                                <button type="button" class="quantity__minus border border-end border-gray-100 flex-shrink-0 h-48 w-48 text-neutral-600 flex-center hover-bg-main-600 hover-text-white" data-cart-item-id="${item.id}">
                                    <i class="ph ph-minus"></i>
                                </button>
                                <input type="number" class="quantity__input flex-grow-1 border border-gray-100 border-start-0 border-end-0 text-center w-32 px-4" 
                                       value="${item.quantity}" min="1" data-cart-item-id="${item.id}">
                                <button type="button" class="quantity__plus border border-end border-gray-100 flex-shrink-0 h-48 w-48 text-neutral-600 flex-center hover-bg-main-600 hover-text-white" data-cart-item-id="${item.id}">
                                    <i class="ph ph-plus"></i>
                                </button>
                            </div>
                        </td>
                        <td>
                            <span class="text-lg h6 mb-0 fw-semibold">$${parseFloat(item.subtotal).toFixed(2)}</span>
                        </td>
                    </tr>
                `);
            });
            
            $('#cart-subtotal').text('$' + parseFloat(totals.subtotal).toFixed(2));
            $('#cart-tax').text('$' + parseFloat(totals.tax).toFixed(2));
            $('#cart-total').text('$' + parseFloat(totals.total).toFixed(2));
            $('#cart-shipping').text('Free');
            
            $('#cart-items-wrapper').removeClass('d-none');
            $('#cart-empty').addClass('d-none');
        },
        
        showEmptyCart: function() {
            $('#cart-items-wrapper').addClass('d-none');
            $('#cart-empty').removeClass('d-none');
            $('#cart-subtotal').text('$0.00');
            $('#cart-tax').text('$0.00');
            $('#cart-total').text('$0.00');
        },
        
        updateQuantity: function(cartItemId, quantity) {
            const self = this;
            if (quantity < 1) quantity = 1;
            
            $.ajax({
                url: self.apiUrl,
                type: 'POST',
                data: { action: 'update_quantity', cart_item_id: cartItemId, quantity: quantity },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        self.renderCart(response.items, response.totals);
                    }
                }
            });
        },
        
        removeItem: function(cartItemId) {
            const self = this;
            if (!confirm('Remove this item?')) return;
            
            $.ajax({
                url: self.apiUrl,
                type: 'POST',
                data: { action: 'remove_item', cart_item_id: cartItemId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        self.renderCart(response.items, response.totals);
                    }
                }
            });
        },
        
        bindEvents: function() {
            const self = this;
            
            $(document).on('click', '.quantity__minus', function() {
                const cartItemId = $(this).data('cart-item-id');
                const input = $(this).siblings('.quantity__input');
                let qty = parseInt(input.val()) || 1;
                if (qty > 1) {
                    self.updateQuantity(cartItemId, --qty);
                }
            });
            
            $(document).on('click', '.quantity__plus', function() {
                const cartItemId = $(this).data('cart-item-id');
                const input = $(this).siblings('.quantity__input');
                let qty = parseInt(input.val()) || 1;
                self.updateQuantity(cartItemId, ++qty);
            });
            
            $(document).on('change', '.quantity__input', function() {
                const cartItemId = $(this).data('cart-item-id');
                let qty = parseInt($(this).val()) || 1;
                if (qty < 1) {
                    qty = 1;
                    $(this).val(1);
                }
                self.updateQuantity(cartItemId, qty);
            });
            
            $(document).on('click', '.remove-cart-item', function() {
                self.removeItem($(this).data('cart-item-id'));
            });
        }
    };
    
    $(document).ready(function() {
        Cart.init();
    });
    
    window.Cart = Cart;
})(jQuery);
