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
                            style="background-image: url('{{ $product->imagePreview() }}')"
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
                    @if ($imageTmp || $product->image)
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
<!--end::Thumbnail settings-->