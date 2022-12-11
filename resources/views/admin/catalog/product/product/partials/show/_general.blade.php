<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">Detalles</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Usuario que registro el producto</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->user ? $product->user->name : 'N/A' }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Género</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">
                @if ($product->productGender)
                    <a href="{{ route('admin.catalog.gender.index', ['search' => $product->productGender->name]) }}">{{ $product->productGender->name }}</a>
                @else
                    N/A
                @endif
            </span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Marca</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">
                @if ($product->productBrand)
                    <a href="{{ route('admin.catalog.brand.index', ['search' => $product->productBrand->name]) }}">{{ $product->productBrand->name }}</a>
                @else
                    N/A
                @endif
            </span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Clase de envío</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">
                @if ($product->shippingClass)
                    <a href="{{ route('admin.setting.shipping-class', ['search' => $product->shippingClass->name]) }}">{{ $product->shippingClass->name }}</a>
                @else
                    N/A
                @endif
            </span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<!--end::Card body-->

<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">Datos generales</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Nombre de producto</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->name }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">SKU</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->sku }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Categorias</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">
                @foreach ($product->productCategories as $category)
                    <span class="badge badge-primary">{{ $category->name }}</span>
                @endforeach
            </span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Precio</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{!! $product->getPriceToString() !!}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Detalle</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->detail }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Descripción</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{!! $product->description !!}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Cantidad</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->qty === null ? 'Ilimitado' : $product->qty }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Destacado</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->featured ? 'Si' : 'No' }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Status</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            <span class="fw-bolder fs-6 text-gray-800">{{ $product->status }}</span>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Iframe</label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            {!! $product->iframe !!}
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-7">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Promoción a la que aplica
       </label>
        <!--end::Label-->
        <!--begin::Col-->
        <div class="col-lg-8">
            @if ($promotion = $product->getPromotion())
                <span class="fw-bolder fs-6 text-primary-800">
                    {{ $promotion->name }} ({{ $product->getPromotionPercentage() }}%)
                </span>
            @else
                <span class="fw-bolder fs-6 text-gray-800">N/A</span>
            @endif
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Video</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">
                {!! $product->video !!}
            </span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Ficha técnica</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">
                @if ($product->technical_datasheet)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" width="100%" height="400px" allowfullscreen src="{{ Storage::url($product->technical_datasheet) }}"></iframe>
                    </div>
                @endif
            </span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
</div>
<!--end::Card body-->

<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">Datos de envío</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Peso</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->weight }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Altura</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->height }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Ancho</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->width }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Largo</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->length }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
</div>
<!--end::Card body-->

<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">Meta tags</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Meta titulo</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->meta_title }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Meta descripción</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->meta_description }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="row mb-10">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">Meta palabras claves</label>
        <!--begin::Label-->
        <!--begin::Label-->
        <div class="col-lg-8">
            <span class="fw-bold fs-6 text-gray-800">{{ $product->meta_keywords }}</span>
        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->
</div>
<!--end::Card body-->

<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">Galería</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--end::Input group-->
    <div class="row">
        @foreach ($product->images as $image)
            <div class="col-lg-6">
                <!--begin::Overlay-->
                <a class="d-block overlay m-5" data-fslightbox="lightbox-basic" href="{{ $image->imagePreview() }}">
                    <!--begin::Image-->
                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                        style="background-image:url('{{ $image->imagePreview() }}')">
                    </div>
                    <!--end::Image-->

                    <!--begin::Action-->
                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                    </div>
                    <!--end::Action-->
                </a>
                <!--end::Overlay-->
            </div>
        @endforeach
    </div>
</div>

<!--begin::Card header-->
<div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
        <h3 class="fw-bolder m-0">Datos estadisticos</h3>
    </div>
    <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Card body-->
<div class="card-body p-9">
    <!--end::Input group-->
    <div class="" style="height: 32rem;">
        <livewire:livewire-line-chart :line-chart-model="$lineChartModel" />
    </div>
</div>
