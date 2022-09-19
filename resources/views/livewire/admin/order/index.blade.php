<div>
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input wire:model="search" type="search" class="form-control form-control-solid w-250px ps-14" placeholder="Buscar orden" />
                </div>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select wire:model="status" class="form-select form-select-solid">
                        <option value="">Status</option>
                        <option value="Procesando">Procesando</option>
                        <option value="Completado">Completado</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                    <!--end::Select2-->
                </div>
                <div class="w-100 mw-150px">
                     <!--begin::Select2-->
                     <select wire:model="paymentStatus" class="form-select form-select-solid">
                        <option value="">Pago status</option>
                        <option value="Aprobado">Aprobado</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Rechazado">Rechazado</option>
                    </select>
                    <!--end::Select2-->
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-100px">Número de orden</th>
                            <th class="min-w-175px">Cliente</th>
                            <th class=" min-w-70px">Status</th>
                            <th class=" min-w-70px">Pago status</th>
                            <th class=" min-w-100px">Total</th>
                            <th class=" min-w-100px">Fecha de creación</th>
                            <th class=" min-w-100px">Acciones</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($orders as $order)
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Order ID=-->
                                <td>    
                                    <a href="{{ route('admin.order.show', $order) }}" class="text-gray-800 text-hover-primary fw-bolder">{{ $order->number }}</a>
                                </td>
                                <!--end::Order ID=-->
                                <!--begin::Customer=-->
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($order->user)
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="{{ route('admin.user.show', $order->user) }}">
                                                    <div class="symbol-label">
                                                        <img loading="lazy" src="{{ $order->user->imagePreview() }}" alt="{{ $order->user->name }}" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="{{ route('admin.user.show', $order->user) }}" class="text-gray-800 text-hover-primary fs-5 fw-bolder">{{ $order->shippingAddress->name }}</a>
                                                <!--end::Title-->
                                            </div>
                                        @else
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a>
                                                    <div class="symbol-label">
                                                        <img loading="lazy" src="{{ asset('assets/admin/media/avatars/blank.png') }}" alt="{{ $order->shippingAddress->name }}" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a class="text-gray-800 fs-5 fw-bolder">{{ $order->shippingAddress->name }}</a>
                                                <p><span class="badge badge-light">Invitado</span></p>
                                                <!--end::Title-->
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <!--end::Customer=-->
                                <!--begin::Status=-->
                                <td class=" pe-0">
                                    {!! $order->statusToString() !!}
                                </td>
                                <!--end::Status=-->
                                 <!--begin::Payment status=-->
                                 <td class=" pe-0">
                                    {!! $order->paymentStatusToString() !!}
                                </td>
                                <!--end::Payment status=-->
                                <!--begin::Total=-->
                                <td class=" pe-0">
                                    <span class="fw-bolder">{{ $order->totalToString() }}</span>
                                </td>
                                <!--end::Total=-->
                                <!--begin::Date Added=-->
                                <td class="">
                                    <span class="fw-bolder">{{ $order->created_at }}</span>
                                </td>
                                <!--end::Date Added=-->
                                <td>
                                    @include('admin.order.view')
                                    @include('admin.order.delete')
                                </td>
                            </tr>
                            <!--end::Table row-->
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            {{ $orders->links() }}
        </div>
        <!--end::Card body-->
    </div>
</div>
