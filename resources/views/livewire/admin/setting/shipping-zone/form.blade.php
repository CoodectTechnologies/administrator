<div>
    @include('admin.components.errors')
    <!--begin::Form-->
    <form class="form" wire:submit.prevent="{{ $method }}">
        <div wire:ignore.self class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
            {{-- General --}}
            <!--begin::Details toggle-->
            <div class="d-flex flex-stack fs-4 py-3">
                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_form_shipping_zone_general_{{ $shippingZone->id }}" role="button" aria-expanded="false" aria-controls="kt_user_form_shipping_zone_general_{{ $shippingZone->id }}">General
                <span class="ms-2 rotate-180">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </span></div>
            </div>
            <!--end::Details toggle-->
            <div class="separator"></div>
            <div class="mt-5"></div>
            <!--begin::Details content-->
            <div id="kt_user_form_shipping_zone_general_{{ $shippingZone->id }}" class="collapse show">
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">Nombre de la zona</span>
                    </label>
                    <input wire:model.defer="shippingZone.name" class="form-control form-control-solid @error('shippingZone.name') 'invalid-feedback' @enderror" placeholder="Ej: Guadalajara" name="" />
                    @error('shippingZone.name') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="required">Precio de envío</span>
                    </label>
                    <input wire:model.defer="shippingZone.price" class="form-control form-control-solid @error('shippingZone.price') 'invalid-feedback' @enderror" placeholder="Ej: 90" name="" />
                    @error('shippingZone.price') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">Precio de envío gratis en una compra mayor o igual a</span> <br>
                        <span class="badge badge-light">Dejar en blanco en caso de no aplicar</span>
                    </label>
                    <input wire:model.defer="shippingZone.free_shipping_over_to" class="form-control form-control-solid @error('shippingZone.free_shipping_over_to') 'invalid-feedback' @enderror" placeholder="Ej: 90" name="" />
                    @error('shippingZone.free_shipping_over_to') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <div class="fv-row mb-7">
                    <div wire:ignore>
                        <label class="fs-6 fw-bold form-label mb-2">
                            <span class="required">Estados / Regiones </span>
                        </label>
                        <select wire:model.defer="shippingZoneStatesArray" class="select2-{{ $shippingZone->id }} form-select form-select-solid @error('shippingZoneStatesArray') 'invalid-feedback' @enderror" data-control="select2" data-placeholder="Selecciona los estados" data-allow-clear="true" multiple="multiple">
                            <option value="">Selecciona los estados / regiones</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }} - {{ $state->country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('shippingZoneStatesArray') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
                <div class="fv-row mb-7">
                    <label class="fs-6 fw-bold form-label mb-2">
                        <span class="">Limitar a codigos postales especificos</span>
                    </label>
                    <textarea wire:model.defer="shippingZone.zip_codes" cols="10" rows="10" class="form-control form-control-solid @error('shippingZone.zip_codes') 'invalid-feedback' @enderror" placeholder="Escribe los códigos postales separados por comas, Los códigos postales que contienen rangos totalmente numéricos (p.ej.: 90210...99000) también son compatibles.">{{ $shippingZone->zip_codes }}</textarea>
                    @error('shippingZone.zip_codes') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                </div>
            </div>
            @if (count($shippingClasses))
                {{-- Shipping Classes --}}
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_form_shipping_zone_classes_{{ $shippingZone->id }}" role="button" aria-expanded="false" aria-controls="kt_user_form_shipping_zone_classes_{{ $shippingZone->id }}">Clases de envío
                    <span class="ms-2 rotate-180">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span></div>
                </div>
                    <!--end::Details toggle-->
                    <div class="separator"></div>
                    <div class="mt-5"></div>
                    <!--begin::Details content-->
                    <div id="kt_user_form_shipping_zone_classes_{{ $shippingZone->id }}" class="collapse show">
                    @foreach ($shippingClasses as $shippingClass)
                        <h5>{{ $shippingClass->name }}</h5>
                        <div class="row">
                            <div class="col-6 fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mb-2">
                                    <span class="">Precio de envío</span>
                                </label>
                                <input wire:model.defer="shippingZonesClassArray.{{ $shippingClass->id }}.price" class="form-control form-control-solid @error('shippingZonesClassArray.{{ $shippingClass->id }}.price') 'invalid-feedback' @enderror" placeholder="Ej: 90"/>
                                @error('shippingZonesClassArray.{{ $shippingClass->id }}.price') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-6 fv-row mb-7">
                                <label class="fs-6 fw-bold form-label mb-2">
                                    <span class="">* [qty]</span>
                                </label>
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input wire:model.defer="shippingZonesClassArray.{{ $shippingClass->id }}.multiply_quantity" class="form-check-input @error('shippingZonesClassArray.{{ $shippingClass->id }}.multiply_quantity') 'invalid-feedback' @enderror" type="checkbox" value="" id="flexSwitchDefault-{{ $shippingZone->id }}-{{ $shippingClass->id }}"/>
                                </div>
                                @error('shippingZonesClassArray.{{ $shippingClass->id }}.multiply_quantity') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <!--begin::Actions-->
        <div class="text-center pt-15">
            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"><i class="fa fa-arrow-left"></i></button>
            <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                <span class="indicator-label">Guardar cambios</span>
                <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </button>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->

    @push('footer')
        <script>
            $('.select2-{{ $shippingZone->id }}').select2().on('change', function (e) {
                var data = $(this).select2("val");
                @this.set('shippingZoneStatesArray', data);
            });
        </script>
    @endpush
    
</div>
