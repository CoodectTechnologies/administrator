<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="required">Teléfono</span>
            </label>
            <input wire:model.defer="phone" class="form-control form-control-solid @error('phone') 'invalid-feedback' @enderror" placeholder="Ingrese número de teléfono" name="" />
            @error('phone') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Correo</span>
            </label>
            <input wire:model.defer="email" class="form-control form-control-solid @error('email') 'invalid-feedback' @enderror" placeholder="Ingrese correo " name="" />
            @error('email') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Facebook</span>
            </label>
            <input wire:model.defer="facebook" class="form-control form-control-solid @error('facebook') 'invalid-feedback' @enderror" placeholder="Link de Facebook" name="" />
            @error('facebook') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Twitter</span>
            </label>
            <input wire:model.defer="twitter" class="form-control form-control-solid @error('twitter') 'invalid-feedback' @enderror" placeholder="Link de Twitter" name="" />
            @error('twitter') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Instagram</span>
            </label>
            <input wire:model.defer="instagram" class="form-control form-control-solid @error('instagram') 'invalid-feedback' @enderror" placeholder="Link de Instagram" name="" />
            @error('instagram') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">YouTube</span>
            </label>
            <input wire:model.defer="youtube" class="form-control form-control-solid @error('youtube') 'invalid-feedback' @enderror" placeholder="Link de YouTube" name="" />
            @error('youtube') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">WhatsApp</span>
            </label>
            <input wire:model.defer="whatsapp" class="form-control form-control-solid @error('whatsapp') 'invalid-feedback' @enderror" placeholder="Ej: +52xxxxxxxxx" name="" />
            <span class="badge badge-secondary">Deberá de tener un +52 al princio o el número correspondiente a tu país.</span>
            @error('whatsapp') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="fs-6 fw-bold form-label mb-2">
                <span class="">Linkedin</span>
            </label>
            <input wire:model.defer="linkedin" class="form-control form-control-solid @error('linkedin') 'invalid-feedback' @enderror" placeholder="Link de Linkedin" name="" />
            @error('linkedin') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
