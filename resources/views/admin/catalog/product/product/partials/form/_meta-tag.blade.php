<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>SEO</h2>
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
            <input wire:model.defer="product.meta_title" type="text" class="form-control mb-2 @error('product.meta_title') 'invalid-feedback' @enderror" placeholder="" />
            <!--end::Input-->
            @error('product.meta_title')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
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
            <textarea wire:model.defer="product.meta_description" cols="10" rows="5" class="form-control @error('product.meta_description') 'invalid-feedback' @enderror">{{ $product->meta_description }}</textarea>
            <!--end::Editor-->
            @error('product.meta_description')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="mb-10">
            <!--begin::Label-->
            <label class="form-label">Meta etiqueta palabras claves</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input wire:model.defer="product.meta_keywords" type="text" class="form-control mb-2 @error('product.meta_keywords') 'invalid-feedback' @enderror"/>
            <!--end::Input-->
            @error('product.meta_keywords')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
            <!--begin::Description-->
            <div class="text-muted fs-7">Establezca una lista de palabras clave con las que se relaciona el product. Separe las palabras clave agregando una coma
                <code>,</code>entre cada palabra clave.</div>
            <!--end::Description-->
        </div>
        <!--end::Input group-->
    </div>
    <!--end::Card header-->
</div>