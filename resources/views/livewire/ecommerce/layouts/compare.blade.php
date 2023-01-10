<div class="dropdown cart-dropdown mr-6">
    <div class="cart-overlay"></div>
    <a href="{{ route('ecommerce.compare.index') }}" class="cart-toggle label-down link">
        <i class="w-icon-compare">
            <span class="cart-count">{{ Cart::instance('compare')->count() }}</span>
        </i>
        <span class="cart-label">{{ __('Compare') }}</span>
    </a>
</div>
