<div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
    <div class="cart-overlay"></div>
    <a href="{{ route('ecommerce.cart.index') }}" class="cart-toggle label-down link">
        <i class="w-icon-cart">
            <span class="cart-count">{{ Cart::instance('default')->count() }}</span>
        </i>
        <span class="cart-label">{{ __('Cart') }}</span>
    </a>
    <div class="dropdown-box">
        <div class="products">
            @forelse (Cart::instance('default')->content() as $item)
                <div class="product product-cart">
                    <div class="product-detail">
                        <a href="{{ route('ecommerce.product.show', $item->model) }}" class="product-name">
                            {{ $item->name }}
                        </a>
                        <div class="price-box">
                            <span class="product-quantity">{{ $item->qty }}</span>
                            <span class="product-price">{{ $item->subtotal() }}</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="{{ route('ecommerce.product.show', $item->model) }}">
                            <img src="{{ $item->options->image }}" alt="{{ $item->name }}" height="84" width="94" />
                        </a>
                    </figure>
                    <button
                        wire:loading.class="load-more-overlay loading"
                        wire:click.prevent="removeProduct('{{ $item->rowId }}')" class="btn btn-link btn-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @empty
                <div class="alert alert-success alert-button">
                    <a href="{{ route('ecommerce.product.index') }}" class="btn btn-success btn-rounded">
                        {{ __('empty cart') }}
                    </a>
                </div>
            @endforelse
        </div>
        <div class="cart-total">
            <label>{{ __('Subtotal') }}:</label>
            <span class="price">{{ Cart::instance('default')->subtotal() }} {{ session()->get('currency') }} </span>
        </div>
        @if (Cart::instance('default')->count())
            <div class="cart-action">
                <a href="{{ route('ecommerce.cart.index') }}" class="btn btn-dark btn-outline btn-rounded">Ver carrito</a>
                <a href="{{ route('ecommerce.checkout.index') }}" class="btn btn-primary  btn-rounded">Checkout</a>
            </div>
        @endif
    </div>
    <!-- End of Dropdown Box -->
</div>
