<div>
    <!-- Start of PageContent -->
    <div class="page-content">
        <div class="container">
            @include('ecommerce.components.alert')
            @if (!count($cart))
                <div class="text-center alert alert-primary alert-bg alert-button alert-block">
                    <h4 class="alert-title">{{ __('Empty cart list') }}</h4>
                    {{ __('In this section you will be shown all the products that you have added to your wishlist') }}
                    <br>
                    <a href="{{ route('ecommerce.product.index') }}" class="btn btn-primary btn-rounded">{{ __('Show products') }}</a>
                    <button class="btn btn-link btn-close">
                        <i class="close-icon"></i>
                    </button>
                </div>
            @else
                <div class="row gutter-lg mb-10">
                    <div class="col-lg-8 pr-lg-4 mb-6">
                        <table class="shop-table cart-table">
                            <thead>
                                <tr>
                                    <th class="product-name"><span>{{ __('Product') }}</span></th>
                                    <th></th>
                                    <th class="product-price"><span>{{ __('Price') }}</span></th>
                                    <th class="product-quantity"><span>{{ ('Quantity') }}</span></th>
                                    <th class="product-subtotal"><span>{{ __('Subtotal') }}</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="{{ route('ecommerce.product.show', $item->model) }}">
                                                    <figure>
                                                        <img src="{{ $item->options->image }}" alt="{{ $item->name }}"
                                                            width="300" height="338">
                                                    </figure>
                                                </a>
                                                <button wire:click="delete('{{ $item->rowId }}')"
                                                    wire:target="delete('{{ $item->rowId }}')"
                                                    wire:loading.class="load-more-overlay loading"
                                                    class="btn btn-close"
                                                    type="submit">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{ route('ecommerce.product.show', $item->model) }}">
                                                {{ $item->name }}
                                            </a>
                                        </td>
                                        <td class="product-price"><span class="amount">${{ number_format($item->price, 2) }}</span></td>
                                        <td class="product-quantity">
                                            <div class="input-group">
                                                <input wire:change="update({{ $item->model->id }}, $event.target.value, '{{ $item->rowId }}')" value="{{ $item->qty }}" class="form-control" type="number">
                                                <button wire:click="update({{ $item->model->id }}, {{ ($item->qty + 1) }}, '{{ $item->rowId }}')" class="quantity-plus w-icon-plus"></button>
                                                <button wire:click="update({{ $item->model->id }}, {{ ($item->qty - 1) }}, '{{ $item->rowId }}')" class="quantity-minus w-icon-minus"></button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">${{ number_format($item->subtotal, 2) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="cart-action mb-6">
                            <a href="{{ route('ecommerce.product.index') }}" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>{{ __('Continue shopping') }}</a>
                            <button wire:click="deleteCart" type="submit" class="btn btn-rounded btn-default btn-clear">{{ __('Clear cart') }}</button>
                        </div>

                    </div>
                    <div class="col-lg-4 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar">
                            <div class="cart-summary mb-4">
                                <h3 class="cart-title text-uppercase">{{ __('Cart subtotals') }}</h3>
                                <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                    <label class="ls-25">{{ __('Subtotal') }}</label>
                                    <span>${{ $subtotal }}</span>
                                </div>
                                <hr class="divider mb-6">
                                <a href="{{ route('ecommerce.checkout.index') }}"
                                    class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                    {{ __('Proceed to checkout') }}<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- End of PageContent -->
</div>
