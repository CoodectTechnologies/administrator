

<div class="product-wrap">
    <div class="product text-center">
        <figure class="product-media">
            <a href="{{ route('ecommerce.product.show', $product) }}">
                <img src="{{ $product->imagePreview() }}" alt="{{ $product->name }}" width="300"/>
                @if (count($product->images))
                    <img src="{{ $product->images->first()->imagePreview() }}" alt="{{ $product->name }}" width="300">
                @endif
            </a>
            @if ($promotion = $product->getPromotion())
                <div class="product-countdown-container">
                    <div class="product-countdown countdown-compact" data-until="2023, 9, 9"
                        data-format="DHMS" data-compact="false"
                        data-labels-short="Days, Hours, Mins, Secs">
                        00:00:00:00
                    </div>
                </div>
            @endif
            <div class="product-action-horizontal">
                @livewire('ecommerce.cart.mini', ['product' => $product], key('cart-'.$product->id))
                @livewire('ecommerce.wishlist.mini', ['product' => $product], key('wishlist-'.$product->id))
                <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                    title="Compare"></a>
                <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                    title="Quick View"></a>
            </div>
            <div class="product-label-group">
                @if ($product->getIsNew())
                    <label class="product-label label-new">New</label>
                @endif
                @if ($promotionPercentage = $product->getPromotionPercentage())
                    <label class="product-label label-discount">{{ $promotionPercentage }}%</label>
                @endif
            </div>
        </figure>
        <div class="product-details">
            <div class="product-cat">
                @foreach ($product->productCategories as $productCategory)
                    <a href="{{ route('ecommerce.product.index', ['category' => $productCategory->slug]) }}">{{ $productCategory->name }}</a>
                @endforeach
            </div>
            <h3 class="product-name">
                <a href="{{ route('ecommerce.product.show', $product) }}">{{ $product->name }}</a>
            </h3>
            <div class="ratings-container">
                <div class="ratings-full">
                    <span class="ratings" style="width: {{ $product->getStarsPercentageAVG() }}%;"></span>
                    <span class="tooltiptext tooltip-top"></span>
                </div>
                <a href="{{ route('ecommerce.product.show', $product) }}#comments" class="rating-reviews">({{ count($product->comments) }} Comentarios)</a>
            </div>
            <div class="product-pa-wrapper">
                <div class="product-price">
                    {!! $product->getPriceToString() !!}
                </div>
            </div>
        </div>
    </div>
</div>
