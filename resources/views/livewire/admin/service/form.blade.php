<div>
    @once
    @push('head')
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/custom/summernote/summernote-lite.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/custom/summernote/summernote-bs5.min.css') }}">
    @endpush
    @endonce
    @include('admin.components.errors')
    <form wire:submit.prevent="{{ $method }}" class="form d-flex flex-column flex-lg-row">
        <!--begin::Aside column-->
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <!--begin::Card -->
            <div class="card card-flush py-4">
                <!--begin::Card body-->
                <div class="card-body text-start pt-0">
                    <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <!--begin::Label-->
                        <label class="fs-6 fw-bold mb-2">
                            <span class="required">Imagen</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Image input wrapper-->
                        <div class="mt-1">
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline">
                                <!--begin::Preview existing avatar-->
                                <div 
                                    class="image-input-wrapper w-200px h-125px" 
                                    @if ($imageTmp)
                                        style="background-image: url('{{ $imageTmp->temporaryUrl() }}')"
                                    @else
                                        style="background-image: url('{{ $service->imagePreview() }}')"
                                    @endif
                                ></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Edit-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow image-input" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Cambiar imagen">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input wire:model.defer="imageTmp" class="d-none" type="file" name="" accept=".png, .jpg, .jpeg, .gif, .webp" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit-->
                                @if ($imageTmp || $service->image)
                                <!--begin::Remove-->
                                <span wire:click.prevent="removeImage()" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Remove-->
                                @endif
                            </div>
                            <!--end::Image input-->
                        </div>
                        @error('imageTmp') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror            
                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Establezca la imagen principal. Solo se aceptan archivos de imagen *.png, *.jpg, *.jpeg, *gif</div>
                    <!--end::Description-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card -->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Detalles</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">Orden</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="service.order" required type="number" class="form-control mb-2 @error('service.order') 'invalid-feedback' @enderror" placeholder="Número de ordenamiento"/>
                        <!--end::Input-->
                        @error('service.order')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="form-label">Categoría</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="service.category" type="text" class="form-control mb-2 @error('service.category') 'invalid-feedback' @enderror" placeholder="Categoría a la que pertenece el servicio"/>
                        <!--end::Input-->
                        @error('service.category')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end::Aside column-->
        <!--begin::Main column-->
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <!--begin::General options-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>General</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">Nombre</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="service.name" required type="text" class="form-control mb-2 @error('service.name') 'invalid-feedback' @enderror" placeholder="Titulo del servicio"/>
                        <!--end::Input-->
                        @error('service.name')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Se requiere un nombre de servicio y se recomienda que sea único.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="form-label required">Framento</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea wire:model.defer="service.fragment" required cols="10" rows="5" class="form-control @error('service.fragment') 'invalid-feedback' @enderror">{{ $service->fragment }}</textarea>
                        <!--end::Editor-->
                        @error('service.fragment')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Pequeña descripción atractiva del servicio.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::General options-->
            <!--begin::General options-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Contenido</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div wire:ignore wire:key="service.body">
                        <!--begin::Label-->
                        <label class="form-label required">Contenido</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea wire:model.defer="service.body" required cols="10" rows="5" class="form-control body @error('service.body') 'invalid-feedback' @enderror">{{ $service->body }}</textarea>
                        <!--end::Editor-->
                    </div>
                    <!--end::Input group-->
                    @error('service.body')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                </div>
                <!--end::Card header-->
            </div>
            <!--end::General options-->
            <!--begin::Meta options-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Meta opciones</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label">Meta etiqueta titulo</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="service.meta_title" type="text" class="form-control mb-2 @error('service.meta_title') 'invalid-feedback' @enderror" placeholder="" />
                        <!--end::Input-->
                        @error('service.meta_title')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Establezca un título de etiqueta meta. Se recomienda que sean palabras clave simples y precisas.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label">Meta etiqueta descripción</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea wire:model.defer="service.meta_description" cols="10" rows="5" class="form-control @error('service.meta_description') 'invalid-feedback' @enderror">{{ $service->meta_description }}</textarea>
                        <!--end::Editor-->
                        @error('service.meta_description')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    </div>
                    <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label">Meta etiqueta palabras claves</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="service.meta_keywords" type="text" class="form-control mb-2 @error('service.meta_keywords') 'invalid-feedback' @enderror"/>
                        <!--end::Input-->
                        @error('service.meta_keywords')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Establezca una lista de palabras clave con las que se relaciona el service. Separe las palabras clave agregando una coma
                            <code>,</code>entre cada palabra clave.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Meta options-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="{{ route('admin.service.index') }}" class="btn btn-light me-5">Cancelar</a>
                <!--end::Button-->
                <!--begin::Button-->
                <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                    <span class="indicator-label">Guardar cambios</span>
                    <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
    @once
    @push('footer')
        <script src="{{ asset('assets/admin/plugins/custom/summernote/summernote-lite.js') }}"></script>
        <script>
            $(document).ready(function(){
                $('.body').summernote({
                    height: 400,
                    callbacks: {
                        onChange: function(contents, $editable) {
                            @this.set('service.body', contents);
                        }
                    }
                });
            });
        </script>
    @endpush
    @endonce
</div>
