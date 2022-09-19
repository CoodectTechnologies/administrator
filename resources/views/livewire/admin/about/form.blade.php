<div>
    <div>
        @include('admin.components.errors')
        <!--begin::Form-->
        <form class="form" wire:submit.prevent="{{ $method }}">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Misión</span>
                </label>
                <textarea required wire:model.defer="about.mission" class="form-control form-control-solid @error('about.mission') 'invalid-feedback' @enderror" cols="30" rows="10">{{ $about->mission }}</textarea>
                @error('about.mission') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Visión</span>
                </label>
                <textarea required wire:model.defer="about.vision" class="form-control form-control-solid @error('about.vision') 'invalid-feedback' @enderror" cols="30" rows="10">{{ $about->vision }}</textarea>
                @error('about.vision') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Valores</span>
                </label>
                <input type="text" required  wire:model.defer="about.values" class="form-control form-control-solid @error('about.values') 'invalid-feedback' @enderror">
                <span class="badge badge-light">Cada valor será separado con una </span><code>,</code>
                @error('about.values') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
</div>
