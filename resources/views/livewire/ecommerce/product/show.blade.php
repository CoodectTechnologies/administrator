<div>

    <!-- Start of Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row gutter-lg pb-5">
                <div class="main-content">
                    <div class="product product-single row">
                        <div class="col-md-6 mb-6">
                            @include('ecommerce.product.partials.show._gallery')
                        </div>
                        <div class="col-md-6 mb-4 mb-md-6">
                            @include('ecommerce.product.partials.show._product')
                        </div>
                    </div>
                    <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            @include('ecommerce.product.partials.show._menu')
                        </ul>
                        <div wire:ignore.self class="tab-content">
                            <div wire:ignore.self class="tab-pane active" id="product-tab-description">
                                {!! $product->description !!}
                            </div>
                            <div wire:ignore.self class="tab-pane" id="product-tab-video">
                                {!! $product->iframe_url !!}
                            </div>
                            <div wire:ignore.self class="tab-pane" id="product-tab-comment">
                                @livewire('ecommerce.comment.form')
                                @livewire('ecommerce.comment.index')
                            </div>
                        </div>
                    </div>
                    <div wire:ignore>
                        @include('ecommerce.product.partials.show._related_product')
                    </div>
                </div>
                @include('ecommerce.product.partials.show._sidebar')
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</div>

@push('footer')
    <script>
        Livewire.on('renderJs', function(){
            Coodect.reloadCarouselProductSingle();
            Coodect.productSingle('.product-single');
        });
    </script>
@endpush
