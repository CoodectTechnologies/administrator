<div>
    <div>
        @include('admin.components.errors')
        <!--begin::Form-->
        <form class="form" wire:submit.prevent="{{ $method }}">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Nombre</span>
                </label>
                <input type="text" required wire:model.defer="size.name" class="form-control form-control-solid @error('size.name') 'invalid-feedback' @enderror" placeholder="Ej: XL" name="" />
                @error('size.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Colores relacionados</span>
                </label>
                <!--begin::Select2-->
                <select wire:model.defer="colorArray" class="colorArray form-select mb-2 @error('colorArray') 'invalid-feedback' @enderror" data-control="select2" data-placeholder="Selecciona una opción" data-allow-clear="true" multiple="multiple">
                    <option value="">Selecciona los colores</option>
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                </select>
                <!--end::Select2-->
                @error('colorArray') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                <!--begin::Description-->
                <div class="text-muted fs-7 mb-7">Agregar color(es) relacionados a la medida.</div>
                <!--end::Description-->
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
    @push('footer')
        <script>
            $('.colorArray').select2().on('change', function (e) {
                let data = $(this).select2("val");
                @this.set('colorArray', data);
            });
            Livewire.on('renderJs', function(){
                $('.colorArray').select2();
            });
        </script>
    @endpush
</div>
