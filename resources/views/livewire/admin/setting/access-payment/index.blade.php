<div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
    <!--begin::Content-->
    <!--begin::Card-->
    <div class="card card-flush">
         <!--begin::Card header-->
         <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">

            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                @include('admin.setting.access-payment.edit')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Body-->
        <div class="card-body p-5 px-lg-19 py-lg-16">
            <div class="mb-14">
                <div class="mb-15">
                    <h1 class="fs-2x text-dark mb-6">Accesos de pasarela de pagos</h1>
                </div>
                <div class="notice d-flex bg-light-info rounded border-info border border-dashed mb-9 p-6">
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-bold">
                            <div class="fs-6 text-gray-700">
                                <strong class="me-1">PayPal: </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h2 class="fw-bolder text-dark mb-8">Client Id</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        {{ config('services.paypal.client_id') }}
                    </div>
                </div>

                <div class="notice d-flex bg-light-info rounded border-info border border-dashed mb-9 p-6">
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-bold">
                            <div class="fs-6 text-gray-700">
                                <strong class="me-1">Mercado pago: </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h2 class="fw-bolder text-dark mb-8">Public key</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        {{ config('services.mercadopago.key') }}
                    </div>
                    <h2 class="fw-bolder text-dark mb-8">Token</h2>
                    <div class="fs-4 fw-bold text-gray-700 mb-13">
                        {{ config('services.mercadopago.token') }}
                    </div>
                </div>
            </div>
            <!--end::Content main-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::About card-->
    @push('footer')
        <script>
            Livewire.on('render', function(){
                $('.modal').modal('hide');
            });
        </script>
    @endpush
</div>
