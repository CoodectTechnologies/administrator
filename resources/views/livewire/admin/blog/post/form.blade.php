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
            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Imagen</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body text-center pt-0">
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
                                        style="background-image: url('{{ $post->imagePreview() }}')"
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
                                @if ($imageTmp || $post->image)
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
            <!--end::Thumbnail settings-->
            <!--begin::Status-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Status</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Select2-->
                    <select required wire:model.defer="post.status" class="form-select mb-2">
                        <option value="">Selecciona un status</option>
                        <option value="Publicado">Publicado</option>
                        <option value="Borrador">Borrador</option>
                    </select>
                    <!--end::Select2-->
                    @error('post.status')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Status-->
            <!--begin::Category & tags-->
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
                <div class="card-body pt-0" wire:ignore>
                    <!--begin::Input group-->
                    <!--begin::Label-->
                    <label class="form-label">Categorias</label>
                    <!--end::Label-->
                    <!--begin::Select2-->
                    <select wire:model.defer="postCategoryArray" class="postCategoryArray form-select mb-2" data-control="select2" data-placeholder="Selecciona una opción" data-allow-clear="true" multiple="multiple">
                        <option value="">Selecciona una opción</option>
                        @foreach ($blogCategories as $blogCategory)
                            <option value="{{ $blogCategory->id }}">{{ $blogCategory->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Select2-->
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <!--begin::Label-->
                    <label class="form-label d-block">Etiquetas</label>
                    <!--end::Label-->
                    <!--begin::Select2-->
                    <select wire:model.defer="postTagArray" class="postTagArray form-select mb-2" data-control="select2" data-placeholder="Selecciona una opción" data-allow-clear="true" multiple="multiple">
                        <option value="">Selecciona una opción</option>
                        @foreach ($blogTags as $blogTag)
                            <option value="{{ $blogTag->id }}">{{ $blogTag->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Select2-->
                    <!--end::Input group-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Category & tags-->
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
                        <input wire:model.defer="post.name" required type="text" class="form-control mb-2" placeholder="Titulo del post"/>
                        <!--end::Input-->
                        @error('post.name')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Se requiere un nombre de blog y se recomienda que sea único.</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div>
                        <!--begin::Label-->
                        <label class="form-label required">Framento</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea wire:model.defer="post.fragment" required cols="10" rows="5" class="form-control @error('post.fragment') 'invalid-feedback' @enderror">{{ $post->fragment }}</textarea>
                        <!--end::Editor-->
                        @error('post.fragment')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Pequeña descripción atractiva del post.</div>
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
                    <div wire:ignore wire:key="post.body">
                        <!--begin::Label-->
                        <label class="form-label required">Contenido</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <textarea wire:model.defer="post.body" required cols="10" rows="5" class="form-control body @error('post.body') 'invalid-feedback' @enderror">{{ $post->body }}</textarea>
                        <!--end::Editor-->
                    </div>
                    <!--end::Input group-->
                    @error('post.body')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
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
                        <input wire:model.defer="post.meta_title" type="text" class="form-control mb-2 @error('post.meta_title') 'invalid-feedback' @enderror" placeholder="" />
                        <!--end::Input-->
                        @error('post.meta_title')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
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
                        <textarea wire:model.defer="post.meta_description" cols="10" rows="5" class="form-control @error('post.meta_description') 'invalid-feedback' @enderror">{{ $post->meta_description }}</textarea>
                        <!--end::Editor-->
                        @error('post.meta_description')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                    </div>
                    <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label">Meta etiqueta palabras claves</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input wire:model.defer="post.meta_keywords" type="text" class="form-control mb-2 @error('post.meta_keywords') 'invalid-feedback' @enderror"/>
                        <!--end::Input-->
                        @error('post.meta_keywords')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Establezca una lista de palabras clave con las que se relaciona el post. Separe las palabras clave agregando una coma
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
                <a href="{{ route('admin.blog.post.index') }}" class="btn btn-light me-5">Cancelar</a>
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
                            @this.set('post.body', contents);
                        }
                    }
                });
                $('.postCategoryArray').select2().on('change', function (e) {
                    let data = $(this).select2("val");
                    @this.set('postCategoryArray', data);
                });
                $('.postTagArray').select2().on('change', function (e) {
                    let data = $(this).select2("val");
                    @this.set('postTagArray', data);
                });
            });
        </script>
    @endpush
    @endonce
</div>
