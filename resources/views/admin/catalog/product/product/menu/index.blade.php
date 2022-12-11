<!--begin::Navs-->
<ul class="nav nav-stretch nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a wire:ignore.self class="nav-link text-active-primary ms-0 me-10 py-5 {{ $submodule === null ? 'active' : '' }}"  data-bs-toggle="tab" href="#kt_product_general_tab">General</a>
    </li>
    <!--end::Nav item-->
    <!--begin::Nav item-->
    <li class="nav-item mt-2">
        <a wire:ignore.self class="nav-link text-active-primary ms-0 me-10 py-5 {{ $submodule === 'comment' ? 'active' : '' }}" data-bs-toggle="tab" href="#kt_product_comment_tab">Comentarios</a>
    </li>
    <!--end::Nav item-->
</ul>
<!--begin::Navs-->
