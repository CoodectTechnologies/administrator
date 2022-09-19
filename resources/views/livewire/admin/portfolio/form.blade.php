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
                <!--begin::Card header-->
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
                                        style="background-image: url('{{ $project->imagePreview() }}')"
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
                                @if ($imageTmp || $project->image)
                                <!--begin::Remove-->
                                <span wire:click.prevent="removeImageMain()" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="">
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
                        <label class="form-label">Cliente</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="project.client" type="text" class="form-control mb-2 @error('project.client') 'invalid-feedback' @enderror" placeholder="Empresa o cliente"/>
                        <!--end::Input-->
                        @error('project.client')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="form-label">Link</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="project.link" type="url" class="form-control mb-2 @error('project.link') 'invalid-feedback' @enderror" placeholder="Link web"/>
                        <!--end::Input-->
                        @error('project.link')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    </div>
                    <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="form-label">Fecha</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="project.date" type="date" class="form-control mb-2 @error('project.date') 'invalid-feedback' @enderror" placeholder="Fecha de proyecto"/>
                        <!--end::Input-->
                        @error('project.date')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
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
                    <div class="fv-row mb-10">
                        <label class="fs-6 fw-bold form-label mb-2">
                            <span class="">Servicio relacionado</span>
                        </label>
                        <select wire:model.defer="project.service_id" class="form-select form-select-solid @error('project.service_id') 'invalid-feedback' @enderror">
                            <option value="">Selecciona un servicio</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                        @error('project.service_id') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        <p><a href="{{ route('admin.service.create') }}">Crear nuevo servicio</a></p>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label">Nombre</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="project.name" required type="text" class="form-control mb-2 @error('project.name') 'invalid-feedback' @enderror" placeholder="Titulo del proyecto"/>
                        <!--end::Input-->
                        @error('project.name')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Se requiere un nombre de proyecto y se recomienda que sea único.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div>
                        <!--begin::Label-->
                        <label class="form-label required">Framento</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea wire:model.defer="project.fragment" required cols="10" rows="5" class="form-control @error('project.fragment') 'invalid-feedback' @enderror">{{ $project->fragment }}</textarea>
                        <!--end::Editor-->
                        @error('project.fragment')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
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
                        <textarea wire:model.defer="project.body" required cols="10" rows="5" class="form-control body @error('project.body') 'invalid-feedback' @enderror">{{ $project->body }}</textarea>
                        <!--end::Editor-->
                    </div>
                    <!--end::Input group-->
                    @error('project.body')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                </div>
                <!--end::Card header-->
            </div>
            <!--end::General options-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Galería</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="mb-7">
                        <!--begin::Input group-->
                        <div class="form-group row">
                            <!--begin::Label-->
                            <label class="col-lg-2 col-form-label text-lg-right">Imagenes</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-10">
                                <!--begin::File-->
                                <div class="dropzone dropzone-queue mb-2">
                                    <!--begin::Controls-->
                                    <div class="dropzone-panel mb-lg-0 mb-2">
                                        <label class="dropzone-select btn btn-sm btn-primary me-2" for="imagesTmp-{{ $imagesTmpInputId }}">
                                            Elegir imagenes
                                            <span wire:loading.attr="disabled" wire:loading.class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </label>
                                        <input wire:model="imagesTmp" type="file" class="d-none" multiple id="imagesTmp-{{ $imagesTmpInputId }}">
                                    </div>
                                    <!--end::Controls-->
                                </div>
                                <!--end::File-->
                                <!--begin::Hint-->
                                <span class="form-text text-muted">Procura subir no más de 10 imagenes.</span>
                                <!--end::Hint-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--begin::Input group-->
                    <div class="mb-7 row">
                        @foreach ($imagesTmp as $key => $imageTmp)
                            <div class="col-lg-4 col-sm-4 col-12">
                                <!--begin::Image input wrapper-->
                                <div class="mt-1">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <!--begin::Preview existing avatar-->
                                        <div 
                                            class="image-input-wrapper w-200px h-125px" 
                                            style="background-image: url('{{ $imageTmp->temporaryUrl() }}')"
                                        ></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Remove-->
                                        <span wire:click.prevent="removeImageTemp('{{ $key }}')" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="">
                                            <i wire:loading.remove wire:target="removeImageTemp('{{ $key }}')" class="bi bi-x fs-2"></i>
                                            <div wire:loading wire:target="removeImageTemp('{{ $key }}')" class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                            </div>
                        @endforeach
                        @foreach ($projectImages as $image)
                            <div class="col-lg-4 col-sm-4 col-12">
                                <!--begin::Image input wrapper-->
                                <div class="mt-1">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline">
                                        <!--begin::Preview existing avatar-->
                                        <div 
                                            class="image-input-wrapper w-200px h-125px" 
                                            style="background-image: url('{{ $image->imagePreview() }}')"
                                        ></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Remove-->
                                        <span wire:click.prevent="removeImage('{{ $image->id }}')" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="">
                                            <i wire:loading.remove wire:target="removeImage('{{ $image->id }}')" class="bi bi-x fs-2"></i>
                                            <div wire:loading wire:target="removeImage('{{ $image->id }}')" class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
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
                        <input wire:model.defer="project.meta_title" type="text" class="form-control mb-2 @error('project.meta_title') 'invalid-feedback' @enderror" placeholder="" />
                        <!--end::Input-->
                        @error('project.meta_title')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
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
                        <textarea wire:model.defer="project.meta_description" cols="10" rows="5" class="form-control @error('project.meta_description') 'invalid-feedback' @enderror">{{ $project->meta_description }}</textarea>
                        <!--end::Editor-->
                        @error('project.meta_description')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    </div>
                    <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label">Meta etiqueta palabras claves</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="project.meta_keywords" type="text" class="form-control mb-2 @error('project.meta_keywords') 'invalid-feedback' @enderror"/>
                        <!--end::Input-->
                        @error('project.meta_keywords')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
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
                            @this.set('project.body', contents);
                        }
                    }
                });
            });
        </script>
    @endpush
    @endonce
</div>
