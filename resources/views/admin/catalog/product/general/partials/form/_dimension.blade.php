<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Dimenciones</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Shipping form-->
        <div class="mt-10">
            <!--begin::Input group-->
            <div class="mb-10 fv-row">
                <!--begin::Label-->
                <label class="form-label">Peso (KG)</label>
                <!--end::Label-->
                <!--begin::Editor-->
                <input wire:model.defer="product.weight" type="number" name="weight" class="form-control mb-2 @error('product.weight') 'invalid-feedback' @enderror" placeholder="Ej: 2"/>
                <!--end::Editor-->
                @error('product.weight')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                <!--begin::Description-->
                <div class="text-muted fs-7">Establecer un peso de producto en kilogramos (kg)</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row">
                <!--begin::Label-->
                <label class="form-label">Dimensiones</label>
                <!--end::Label-->
                <!--begin::Input-->
                <div class="d-flex flex-wrap flex-sm-nowrap gap-3">
                    <input wire:model.defer="product.width" type="number" name="width" class="form-control mb-2" placeholder="Ancho (CM)"/>
                    @error('product.width')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    <input wire:model.defer="product.height" type="number" name="height" class="form-control mb-2" placeholder="Altura (CM)"/>
                    @error('product.height')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    <input wire:model.defer="product.length" type="number" name="length" class="form-control mb-2" placeholder="largo (CM)"/>
                    @error('product.length')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                </div>
                <!--end::Input-->
                <!--begin::Description-->
                <div class="text-muted fs-7">Introduce las dimensiones del producto en centímetros (cm).</div>
                <!--end::Description-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Shipping form-->
    </div>
    <!--end::Card header-->
</div>