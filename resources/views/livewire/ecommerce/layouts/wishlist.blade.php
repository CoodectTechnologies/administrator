<div class="dropdown cart-dropdown mr-6">
    <div class="cart-overlay"></div>
    <a href="{{ route('ecommerce.wishlist.index') }}" class="cart-toggle label-down link">
        <i class="w-icon-heart">
            <span class="cart-count">{{ Cart::instance('wishlist')->count() }}</span>
        </i>
        <span class="cart-label">{{ __('Wishlist') }}</span>
    </a>
</div>
