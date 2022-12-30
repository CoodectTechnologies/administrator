<div wire:ignore.self class="product-details" data-sticky-options="{'minWidth': 767}">

    <h2 class="product-title">{{ $product->name }}</h2>
    <div class="product-bm-wrapper">
        @if ($product->brand)
            <figure class="brand">
                <img src="{{ $product->brand->imagePreview() }}" alt="{{ $product->brand->name }}"
                    width="102"/>
            </figure>
        @endif
        <div class="product-meta">
            <div class="product-categories">
                {{ __('Category') }}:
                @foreach ($product->productCategories as $productCategory)
                    <span class="product-category"><a href="{{ route('ecommerce.product.index', ['category' => $productCategory->slug]) }}">{{ $productCategory->name }}</a></span>
                @endforeach
            </div>
            <div class="product-sku">
                SKU: <span>{{ $product->sku }}</span>
            </div>
        </div>
    </div>
    <hr class="product-divider">
    <div class="product-price"><ins class="new-price">{{ $priceToString }}</ins></div>
    <div class="ratings-container">
        <div class="ratings-full">
            <span class="ratings" style="width: 80%;"></span>
            <span class="tooltiptext tooltip-top"></span>
        </div>
        <a href="#product-tab-reviews" class="rating-reviews scroll-to">({{ count($product->comments) }}) {{ __('Comments') }}</a>
    </div>
    <div class="product-short-desc">
        {!! $product->detail !!}
    </div>
    <hr class="product-divider">
    <div class="product-form product-variation-form product-size-swatch">
        <label class="mb-1">{{ __('Size') }}:</label>
        <div class="flex-wrap d-flex align-items-center product-variations">
            @foreach ($sizes as $size)
                <button
                    wire:click="loadSize({{ $size->id }})"
                    class="size {{ $sizeFilter ? ($sizeFilter->id == $size->id ? 'active' : '') : '' }}">
                    {{ $size->name }}
                </button>
            @endforeach
        </div>
    </div>
    <div class="product-form product-variation-form product-color-swatch">
        <label>{{ __('Color') }}: </label>
        <div class="d-flex align-items-center product-variations">
            @foreach ($colors as $color)
                <button
                    wire:click="loadColor({{ $color->id }})"
                    {{-- x-on:click="imagesByColor('{{ $color->id }}')" --}}
                    class="color {{ $colorFilter ? ($colorFilter->id == $color->id ? 'active' : '') : '' }} "
                    style="background-color: {{ $color->hexadecimal }}"
                    {{ $sizeFilter ? (!$color->validateColorSizeSelected($sizeFilter->id) ? 'disabled' : '') : '' }}>
                </button>
            @endforeach
        </div>
        <a href="#" class="product-variation-clean">{{ __('Clean All') }}</a>
    </div>
    <div class="product-variation-price">
        <span></span>
    </div>
    <div>
        <div class="fix-bottom product-sticky-content sticky-content">
            <div class="product-form container">
                <div class="product-qty-form">
                    <div class="input-group">
                        <input class="quantity form-control" type="number" value="0" min="1" max="10000000">
                        <button class="quantity-plus w-icon-plus"></button>
                        <button class="quantity-minus w-icon-minus"></button>
                    </div>
                </div>
                <button
                    {{ count($colors) ? (!$colorFilter ? 'disaled' : '') : '' }}
                    {{ count($sizes) ? (!$sizeFilter ? 'disaled' : '') : '' }}
                    class="btn btn-primary btn-cart">
                    <i class="w-icon-cart"></i>
                    <span>{{ __('Add') }}</span>
                </button>
            </div>
        </div>
    </div>
    <div class="social-links-wrapper">
        <div class="social-links">
            <div class="social-icons social-no-color border-thin">
                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                <a href="#"
                    class="social-icon social-pinterest fab fa-pinterest-p"></a>
                <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                <a href="#"
                    class="social-icon social-youtube fab fa-linkedin-in"></a>
            </div>
        </div>
        <span class="divider d-xs-show"></span>
        <div class="product-link-wrapper d-flex">
            <a href="#"
                class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
            <a href="#"
                class="btn-product-icon btn-compare btn-icon-left w-icon-compare"><span></span></a>
        </div>
    </div>
</div>
