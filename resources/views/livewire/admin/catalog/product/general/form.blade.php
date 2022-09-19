<div>
    @once
    @push('head')
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/custom/summernote/summernote-lite.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/custom/summernote/summernote-bs5.min.css') }}">
    @endpush
    @endonce
    <div class="gap-7 gap-lg-10 mb-5">
        <!--begin:::Menu-->
        @include('admin.catalog.product.general.partials.form._menu')
        <!--end:::Menu-->
    </div>
    @include('admin.components.errors')
    <!--begin::Tab content-->
    <div class="tab-content">
        <!--begin::Tab pane general-->
        <div wire:ignore.self class="tab-pane fade {{ $submodule === null ? 'show active' : '' }}" id="kt_ecommerce_add_product_general" role="tab-panel">
            @include('admin.catalog.product.general.partials.form._form')
        </div>
        <!--end::Tab pane general-->
        @if ($product->id)
            <!--begin::Tab pane color-->
            <div wire:ignore.self class="tab-pane fade {{ $submodule === 'colors' ? 'show active' : '' }}" id="kt_ecommerce_add_product_colors" role="tab-panel">
                @livewire('admin.catalog.product.color.index', ['product' => $product], key('product-color-'.$product->id))
            </div>
            <!--end::Tab pane color-->
            <!--begin::Tab pane size-->
            <div wire:ignore.self class="tab-pane fade {{ $submodule === 'sizes' ? 'show active' : '' }}" id="kt_ecommerce_add_product_size" role="tab-panel">
                @livewire('admin.catalog.product.size.index', ['product' => $product], key('product-size-'.$product->id))
            </div>
            <!--end::Tab pane comments-->
            <div wire:ignore.self class="tab-pane fade {{ $submodule === 'comments' ? 'show active' : '' }}" id="kt_ecommerce_comment" role="tap-panel">
                @include('admin.catalog.product.general.comment.index')
            </div>
        @endif
    </div>
    <!-- Modals -->
    @include('admin.catalog.product.general.partials.form._modal')
    @once
    @push('footer')
        @livewireChartsScripts
        <script src="{{ asset('assets/admin/plugins/custom/summernote/summernote-lite.js') }}"></script>
        <script>
            $(document).ready(function(){
                $('.body').summernote({
                    height: 200,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('product.description', contents);
                        }
                    }
                });
                $('.catalogCategoryArray').select2().on('change', function (e) {
                    let data = $(this).select2("val");
                    @this.set('catalogCategoryArray', data);
                });
                Livewire.on('render', function(){
                    $('.modal').modal('hide');
                });
                Livewire.on('renderJs', function(){
                    $('.catalogCategoryArray').select2();
                });
            });
        </script>
    @endpush
    @endonce
</div>
