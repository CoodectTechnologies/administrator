@if ($product->id)
<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Estadisticas</h2>
        </div>
        <span> Vistas: {{ $product->viewUniques() }}</span>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Shipping form-->
        <div class="mt-10">
            <div class="" style="height: 32rem;">
                <livewire:livewire-line-chart :line-chart-model="$lineChartModel" />
            </div> 
        </div>
        <!--end::Shipping form-->
    </div>
    <!--end::Card header-->
</div>
@endif
