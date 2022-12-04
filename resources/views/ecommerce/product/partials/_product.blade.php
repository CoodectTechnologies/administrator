<div class="product-wrap">
    <div class="product text-center">
        <figure class="product-media">
            <a href="{{ route('ecommerce.product.show', $product) }}">
                <img src="{{ $product->imagePreview() }}" alt="{{ $product->name }}" height="338">
                @if (count($product->images))
                    <img src="{{ $product->images->first()->imagePreview() }}" alt="{{ $product->name }}" height="">
                @endif
            </a>
            <div class="product-action-vertical">
                <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></a>
                <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                    title="Add to wishlist"></a>
                <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                    title="Quickview"></a>
                <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                    title="Add to Compare"></a>
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
            <h4 class="product-name">
                <a href="{{ route('ecommerce.product.show', $product) }}">{{ $product->name }}</a>
            </h4>
            <div class="ratings-container">
                <div class="ratings-full">
                    <span class="ratings" style="width: 50%;"></span>
                    <span class="tooltiptext tooltip-top"></span>
                </div>
                <a href="#" class="rating-reviews">({{ count($product->comments) }} Comentarios)</a>
            </div>
            <div class="product-price">
                <ins class="new-price">{!! $product->getPriceToString() !!}</ins>
            </div>
        </div>
    </div>
</div>
