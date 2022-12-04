<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Nombre de la moneda</span>
            </label>
            <input wire:model.defer="currency.name" class="form-control form-control-solid @error('currency.name') 'invalid-feedback' @enderror" placeholder="Ej: Peso méxicano" name="" />
            @error('currency.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Código de la moneda</span>
            </label>
            <input wire:model.defer="currency.code" class="form-control form-control-solid @error('currency.code') 'invalid-feedback' @enderror" placeholder="Ej: MX" name="" />
            @error('currency.code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Simbolo</span>
            </label>
            <input wire:model.defer="currency.symbol" class="form-control form-control-solid @error('currency.symbol') 'invalid-feedback' @enderror" placeholder="Ej: $" name="" />
            @error('currency.symbol') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Default</span>
            </label>
            <select wire:model.defer="currency.default" class="form-control form-control-solid @error('currency.default') 'invalid-feedback' @enderror">
                <option value="">Selecciona una opción</option>
                <option value="1">Si</option>
                <option value="0">No</option>
            </select>
            @error('currency.default') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Activo</span>
            </label>
            <select wire:model.defer="currency.active" class="form-control form-control-solid @error('currency.active') 'invalid-feedback' @enderror">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            @error('currency.active') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="text-center pt-15">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"><i class="fa fa-arrow-left"></i></button>
            <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                <span class="indicator-label">Guardar cambios</span>
                <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
</div>
