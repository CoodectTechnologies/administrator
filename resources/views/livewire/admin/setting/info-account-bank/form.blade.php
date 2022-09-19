<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Nombre de banco</span>
            </label>
            <input wire:model.defer="paymentBank" class="form-control form-control-solid @error('paymentBank') 'invalid-feedback' @enderror" placeholder="Ej: BBVA" name="" />
            @error('paymentBank') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Cuenta bancaria</span>
            </label>
            <input wire:model.defer="paymentAccountBank" class="form-control form-control-solid @error('paymentAccountBank') 'invalid-feedback' @enderror" placeholder="Ej: 1519462883 " name="" />
            @error('paymentAccountBank') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Tarjeta</span>
            </label>
            <input wire:model.defer="paymentTarget" class="form-control form-control-solid @error('paymentTarget') 'invalid-feedback' @enderror" placeholder="Ej: 4152 3138 0116 5726" name="" />
            @error('paymentTarget') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">A nombre de</span>
            </label>
            <input wire:model.defer="paymentName" class="form-control form-control-solid @error('paymentName') 'invalid-feedback' @enderror" placeholder="Nombre del beneficiario" name="" />
            @error('paymentName') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
