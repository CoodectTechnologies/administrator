<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Código del país</span>
            </label>
            <input wire:model.defer="country.code" class="form-control form-control-solid @error('country.code') 'invalid-feedback' @enderror" placeholder="Ej: MX" name="" />
            @error('country.code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Nombre del país</span>
            </label>
            <input wire:model.defer="country.name" class="form-control form-control-solid @error('country.name') 'invalid-feedback' @enderror" placeholder="Ej: México" name="" />
            @error('country.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Código de teléfono</span>
            </label>
            <input wire:model.defer="country.phonecode" class="form-control form-control-solid @error('country.phonecode') 'invalid-feedback' @enderror" placeholder="Ej: 52" name="" />
            @error('country.phonecode') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Status</span>
            </label>
            <!--begin::Select2-->
            <select required wire:model.defer="country.status" class="form-select mb-2 @error('country.status') 'invalid-feedback' @enderror">
                <option value="">Selecciona una opción</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <!--end::Select2-->
            @error('country.status')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Card body-->
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
