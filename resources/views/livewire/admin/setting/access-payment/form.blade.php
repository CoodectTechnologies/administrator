<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">PayPal - Client Id</span>
            </label>
            <input wire:model.defer="paypalClientId" class="form-control form-control-solid @error('paypalClientId') 'invalid-feedback' @enderror" placeholder="Ej: Aaom6OSz_cvoi7C72DFaxwxKuAclEBeXA7ua-j1EenB73XoSBOIYKTcA6_uFbpJc5N46-bXehUdLVeZM" name="" />
            @error('paypalClientId') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Mercado pago - Public key</span>
            </label>
            <input wire:model.defer="mercadoPagoKey" class="form-control form-control-solid @error('mercadoPagoKey') 'invalid-feedback' @enderror" placeholder="Ej: 392bbf59-0a4b-4a7d-a096-5cf6548de48b " name="" />
            @error('mercadoPagoKey') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Mercado pago - Llave secreta</span>
            </label>
            <input wire:model.defer="mercadoPagoToken" class="form-control form-control-solid @error('mercadoPagoToken') 'invalid-feedback' @enderror" placeholder="Ej: 7535429537422278-051316-7d8ac1be3db19378a2e27f1330a8200e-1123244856" name="" />
            @error('mercadoPagoToken') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
