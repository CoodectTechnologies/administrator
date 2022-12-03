<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Contenido</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <div wire:ignore wire:key="product.description">
            <!--begin::Label-->
            <label class="form-label">Contenido</label>
            <!--end::Label-->
            <!--begin::Editor-->
            <textarea wire:model.defer="product.description" cols="10" rows="5" class="form-control body @error('product.description') 'invalid-feedback' @enderror">{{ $product->body }}</textarea>
            <!--end::Editor-->
        </div>
        <!--end::Input group-->
        @error('product.description')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
    </div>
    <!--end::Card header-->
</div>
