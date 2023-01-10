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
            <span class="ratings" style="width: {{ $product->getStarsPercentageAVG() }}%;"></span>
            <span class="tooltiptext tooltip-top"></span>
        </div>
        <a href="#product-tab-reviews" class="rating-reviews scroll-to">({{ $product->comments()->validate()->count() }}) {{ __('Comments') }}</a>
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
                    class="size {{ $sizeSelected ? ($sizeSelected->id == $size->id ? 'active' : '') : '' }}">
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
                    class="color {{ $colorSelected ? ($colorSelected->id == $color->id ? 'active' : '') : '' }} "
                    style="background-color: {{ $color->hexadecimal }}"
                    {{ $sizeSelected ? (!$color->validateColorSizeSelected($sizeSelected->id) ? 'disabled' : '') : '' }}>
                </button>
            @endforeach
        </div>
    </div>
    @if($colorSelected || $sizeSelected)
        <a wire:click.prevent="resetVariation" href="#" class="btn btn-link btn-primary btn-simple">{{ __('Clean All') }}</a>
    @endif
    <form wire:submit.prevent="addCart">
        <div class="fix-bottom product-sticky-content sticky-content">
            <div class="product-form container">
                <div class="product-qty-form">
                    <div class="input-group">
                        <input wire:model.defer="quantity" required class="quantity form-control" type="number" min="1">
                        <button wire:ignore type="button" class="quantity-plus w-icon-plus"></button>
                        <button wire:ignore type="button" class="quantity-minus w-icon-minus"></button>
                    </div>
                </div>
                <button
                    {{ count($colors) ? (!$colorSelected ? ' disabled' : '') : '' }}
                    {{ count($sizes) ? (!$sizeSelected ? ' disabled' : '') : '' }}
                    wire:target="addCart"
                    wire:loading.class="load-more-overlay loading"
                    wire:loading.disabled
                    class="btn btn-primary btn-cart"
                    type="submit">
                    <i class="w-icon-cart"></i>
                    <span>{{ __('Add') }}</span>
                </button>
            </div>
        </div>
    </form>
    <div class="social-links-wrapper">
        <div class="social-links">
            <div class="social-icons social-no-color border-thin">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('ecommerce.product.show', $product) }}" class="social-icon social-facebook w-icon-facebook"></a>
                <a href="whatsapp://send?text={{ $product->slug }}" data-action="share/whatsapp/share" class="social-icon social-whatsapp fab fa-whatsapp" target="_blank"> </a>
            </div>
        </div>
        <span class="divider d-xs-show"></span>
        <div class="product-link-wrapper d-flex">
            @livewire('ecommerce.wishlist.mini', ['product' => $product], key('wishlist-'.$product->id))
            @livewire('ecommerce.compare.mini', ['product' => $product], key('compare-'.$product->id))
        </div>
    </div>
</div>
