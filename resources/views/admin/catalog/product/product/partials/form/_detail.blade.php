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
    <!--begin::Categoríes-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <!--begin::Label-->
        <label class="form-label">Categorias</label>
        <!--end::Label-->
        <!--begin::Select2-->
        <select wire:model.defer="catalogCategoryArray" class="catalogCategoryArray form-select mb-2 @error('catalogCategoryArray') 'invalid-feedback' @enderror" data-control="select2" data-placeholder="Selecciona una opción" data-allow-clear="true" multiple="multiple">
            <option value="">Selecciona una opción</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <!--end::Select2-->
        @error('catalogCategoryArray')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        <!--end::Input group-->
        <!--begin::Button-->
        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_add_catalog_category" class="btn btn-light-primary btn-sm mb-10">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
                    <rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->Nueva categoría
        </a>
        <!--end::Button-->
    </div>
    <!--end::Categoríes-->
    <!--begin::Brands-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <!--begin::Label-->
        <label class="form-label">Marca</label>
        <!--end::Label-->
        <!--begin::Select2-->
        <select wire:model.defer="product.product_brand_id" class="form-select mb-2 @error('product.product.product_brand_id') 'invalid-feedback' @enderror" data-control="select2" data-placeholder="Selecciona una opción" data-allow-clear="true">
            <option value="">Selecciona una opción</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
        <!--end::Select2-->
        @error('product.product_brand_id')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        <!--end::Input group-->
        <!--begin::Button-->
        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_add_catalog_brand" class="btn btn-light-primary btn-sm mb-10">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
                    <rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->Nueva marca
        </a>
        <!--end::Button-->
    </div>
    <!--end::Brands-->
    <!--begin::Genders-->
    <div class="card-body pt-0">
        <!--begin::Input group-->
        <!--begin::Label-->
        <label class="form-label">Género</label>
        <!--end::Label-->
        <!--begin::Select2-->
        <select wire:model.defer="product.product_gender_id" class="form-select mb-2 @error('product.product.product_gender_id') 'invalid-feedback' @enderror" data-control="select2" data-placeholder="Selecciona una opción" data-allow-clear="true">
            <option value="">Selecciona una opción</option>
            @foreach ($genders as $gender)
                <option value="{{ $gender->id }}">{{ $gender->name }}</option>
            @endforeach
        </select>
        <!--end::Select2-->
        @error('product.product_gender_id')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
        <!--end::Input group-->
        <!--begin::Button-->
        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_add_catalog_gender" class="btn btn-light-primary btn-sm mb-10">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
                    <rect x="6" y="11" width="12" height="2" rx="1" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->Nuevo género
        </a>
        <!--end::Button-->
    </div>
    <!--end::Genders-->
</div>