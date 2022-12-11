<ul wire:ignore class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-n2">
    <!--begin:::Tab item-->
    <li class="nav-item">
        <a class="nav-link text-active-primary pb-4 {{ $submodule === null ? 'active' : '' }}" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">General</a>
    </li>
    <!--end:::Tab item-->
    @if ($product->exists)
        <!--begin:::Tab item-->
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 {{ $submodule === 'colors' ? 'active' : '' }}" data-bs-toggle="tab" href="#kt_ecommerce_add_product_colors">Colores</a>
        </li>
        <!--end:::Tab item-->
        <!--begin:::Tab item-->
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 {{ $submodule === 'sizes' ? 'active' : '' }}" data-bs-toggle="tab" href="#kt_ecommerce_add_product_size">Medidas</a>
        </li>
        <!--end:::Tab item-->
    @endif
</ul>
