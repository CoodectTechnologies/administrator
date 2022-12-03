<form wire:submit.prevent="{{ $method }}" class="form d-flex flex-column flex-lg-row pt-5">
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::Image-->
        @include('admin.catalog.product.product.partials.form._image')
        <!--end::Image-->
        <!--begin::Status-->
        @include('admin.catalog.product.product.partials.form._status')
        <!--end::Status-->
        <!--begin::Fetured-->
        @include('admin.catalog.product.product.partials.form._featured')
        <!--end::Fetured-->
        <!--begin:: Details-->
        @include('admin.catalog.product.product.partials.form._detail')
        <!--end:: Details-->
        <!--begin:: Graphic-->
        @include('admin.catalog.product.product.partials.form._graphic')
        <!--end:: Graphic-->
    </div>
    <!--end::Aside column-->
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin::General-->
        @include('admin.catalog.product.product.partials.form._general')
        <!--end::General-->
        <!--begin::Prices-->
        @include('admin.catalog.product.product.partials.form._price')
        <!--end::Prices-->
        <!--begin::Description-->
        @include('admin.catalog.product.product.partials.form._description')
        <!--end::Description-->
        <!--begin::Gallery-->
        @include('admin.catalog.product.product.partials.form._gallery')
        <!--end::Gallery-->
        <!--begin::Shipping class-->
        @include('admin.catalog.product.product.partials.form._shipping-class')
        <!--end::Shipping class-->
        <!--begin::Dimension-->
        @include('admin.catalog.product.product.partials.form._dimension')
        <!--end::Dimension-->
        <!--begin::Meta options-->
        @include('admin.catalog.product.product.partials.form._meta-tag')
        <!--end::Meta options-->
        <!--end:: Save changes-->
        <div class="d-flex justify-content-end py-5">
            <!--begin::Button-->
            <a href="{{ route('admin.catalog.product.index') }}" class="btn btn-light me-5">Cancelar</a>
            <!--end::Button-->
            <!--begin::Button-->
            <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                <span class="indicator-label">Guardar cambios</span>
                <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </button>
            <!--end::Button-->
        </div>
        <!--end:: Save changes-->
    </div>
    <!--end::Main column-->
</form>
