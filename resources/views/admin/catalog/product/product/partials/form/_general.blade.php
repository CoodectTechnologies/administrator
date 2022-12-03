<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>General</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <div class="mb-10 fv-row">
            <!--begin::Label-->
            <label class="required form-label">Nombre</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input wire:model.defer="product.name" required type="text" class="form-control mb-2 @error('product.name') 'invalid-feedback' @enderror" placeholder="Nombre del producto"/>
            <!--end::Input-->
            @error('product.name')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            <!--begin::Description-->
            <div class="text-muted fs-7">Se requiere un nombre de producto y se recomienda que sea único.</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->
        <div class="row">
            <!--begin::Input group-->
            <div class="mb-10 fv-row col-lg-6">
                <!--begin::Label-->
                <label class="form-label">Cantidad</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input wire:model.defer="product.quantity" type="number" class="form-control mb-2 @error('product.quantity') 'invalid-feedback' @enderror" placeholder="Cantidad"/>
                <!--end::Input-->
                @error('product.quantity')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                <!--begin::Description-->
                <div class="text-muted fs-7">En caso de dejar vacio este campo, es considerado que no tendrá un limite de productos</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10 fv-row col-lg-6">
                <!--begin::Label-->
                <label class="form-label">SKU</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input wire:model.defer="product.sku" type="text" class="form-control mb-2 @error('product.sku') 'invalid-feedback' @enderror" placeholder="SKU"/>
                <!--end::Input-->
                @error('product.sku')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            </div>
            <!--end::Input group-->
        </div>
        <!--begin::Input group-->
        <!--begin::Input group-->
        <div class="mb-10 fv-row col-lg-12">
            <!--begin::Label-->
            <label class="form-label">Iframe youtube</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input wire:model.defer="product.iframe_url" type="text" class="form-control mb-2 @error('product.iframe_url') 'invalid-feedback' @enderror" placeholder="iframe_url"/>
            <!--end::Input-->
            @error('product.iframe_url')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Input group-->
        <div>
            <!--begin::Label-->
            <label class="form-label required">Pequeña descripción</label>
            <!--end::Label-->
            <!--begin::Editor-->
            <textarea wire:model.defer="product.detail" cols="10" rows="5" class="form-control @error('product.detail') 'invalid-feedback' @enderror">{{ $product->detail }}</textarea>
            <!--end::Editor-->
            @error('product.detail')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            <!--begin::Description-->
            <div class="text-muted fs-7">Pequeña descripción atractiva del producto.</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Card header-->
</div>
