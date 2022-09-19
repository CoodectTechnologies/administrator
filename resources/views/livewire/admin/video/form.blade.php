<div>
    @once
        @push('head')
            <link rel="stylesheet" href="{{ asset('assets/admin/plugins/custom/summernote/summernote-lite.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/admin/plugins/custom/summernote/summernote-bs5.min.css') }}">
        @endpush
    @endonce
    <div>
        @include('admin.components.errors')
        <!--begin::Form-->
        <form class="form" wire:submit.prevent="{{ $method }}">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Módulo</span>
                </label>
                <select wire:model.defer="video.module_web_id" class="form-select form-select-solid @error('video.module_web_id') 'invalid-feedback' @enderror">
                    <option value="">Selecciona un tipo</option>
                    @foreach ($modulesWeb as $moduleWeb)
                        <option value="{{ $moduleWeb->id }}">{{ $moduleWeb->name }}</option>
                    @endforeach
                </select>
                @error('video.module_web_id') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Orden</span>
                </label>
                <input type="number" required wire:model.defer="video.order" class="form-control form-control-solid @error('video.order') 'invalid-feedback' @enderror" placeholder="Ej: 1" name="" />
                @error('video.order') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
             <!--begin::Input group-->
             <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Nombre</span>
                </label>
                <input required type="text" wire:model.defer="video.name" class="form-control form-control-solid @error('video.name') 'invalid-feedback' @enderror" placeholder="Ej: Unete a {{ config('app.name') }}" name="" />
                @error('video.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
             <!--begin::Input group-->
             <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Youtube URL</span>
                </label>
                <input required type="url" wire:model.defer="video.iframe_url" class="form-control form-control-solid @error('video.iframe_url') 'invalid-feedback' @enderror" placeholder="" name="" />
                @error('video.iframe_url') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7" wire:ignore wire:key="video-{{ $video->id }}">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="">Contenido</span>
                </label>
                <textarea wire:model.defer="video.body" class="summernote-{{ $video->id }}" name="" id="" cols="30" rows="10">{!! $video->body !!}</textarea>
                @error('video.body') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
    @once
        @push('footer')
            <script src="{{ asset('assets/admin/plugins/custom/summernote/summernote-lite.js') }}"></script>
        @endpush
    @endonce
    @push('footer')
        <script>
            $(document).ready(function(){
                $('.summernote-{{ $video->id }}').summernote({
                    height: 200,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('video.body', contents);
                        }
                    }
                });
            });
        </script>
    @endpush
</div>
