<div>
    <div>
        @include('admin.components.errors')
        <!--begin::Form-->
        <form class="form" wire:submit.prevent="{{ $method }}">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Características</span>
                </label>
                <!--begin::Select2-->
                <select wire:model.defer="packageFeatureArray" required class="packageFeatureArray-{{ $package->id }} form-select mb-2 @error('packageFeatureArray') 'invalid-feedback' @enderror" data-control="select2" data-placeholder="Selecciona una opción" data-allow-clear="true" multiple="multiple">
                    <option value="">Selecciona una opción</option>
                    @foreach ($packageFeatures as $packageFeature)
                        <option value="{{ $packageFeature->id }}">{{ $packageFeature->name }}</option>
                    @endforeach
                </select>
                <!--end::Select2-->
                @error('packageFeatureArray')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                <!--begin::Button-->
                <a href="{{ route('admin.package.feature.index') }}" class="btn btn-light-primary btn-sm mb-10">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
                            <rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Nueva característica
                </a>
                <!--end::Button-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Orden</span>
                </label>
                <input required wire:model.defer="package.order" class="form-control form-control-solid @error('package.order') 'invalid-feedback' @enderror" placeholder="Ej: 1" name="" />
                @error('package.order') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="required">Titulo</span>
                </label>
                <input type="text" required wire:model.defer="package.title" class="form-control form-control-solid @error('package.title') 'invalid-feedback' @enderror" placeholder="Ingrese el titulo" name="" />
                @error('package.title') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="">Subtitulo</span>
                </label>
                <input type="text" wire:model.defer="package.subtitle" class="form-control form-control-solid @error('package.subtitle') 'invalid-feedback' @enderror" placeholder="Ingrese el subtitulo" name="" />
                @error('package.subtitle') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="fs-6 fw-bold form-label mb-2">
                    <span class="">Precio</span>
                </label>
                <input type="number" wire:model.defer="package.price" class="form-control form-control-solid @error('package.price') 'invalid-feedback' @enderror" placeholder="Ingrese el precio" name="" />
                @error('package.price') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
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
            $(document).ready(function(){
                $('.packageFeatureArray-{{ $package->id }}').select2().on('change', function (e) {
                    let data = $(this).select2("val");
                    @this.set('packageFeatureArray', data);
                });
                Livewire.on('renderJs', function(){
                    $('.packageFeatureArray-{{ $package->id }}').select2();
                });
            });
        </script>
    @endpush
    
</div>
