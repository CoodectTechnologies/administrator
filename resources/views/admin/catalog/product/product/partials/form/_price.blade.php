<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Precio</h2>
        </div>
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">
        <!--begin::Shipping form-->
        <div class="mt-5">
            <div class="row">
                @foreach ($currencies as $currency)
                    <div class="col-lg-4">
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <!--begin::Label-->
                            <label class="form-label" title="{{ $currency->name }}">Precio {{ $currency->code }}</label>
                            <!--end::Label-->
                            <!--begin::Editor-->
                            <input wire:model.defer="priceCurrenciesArray.{{ $currency->id }}.price" type="number" name="weight" class="form-control mb-2 @error('priceCurrenciesArray.{{ $currency->id }}.price') 'invalid-feedback' @enderror" placeholder="{{ $currency->symbol }}"/>
                            <!--end::Editor-->
                            @error('priceCurrenciesArray.{{ $currency->id }}.price')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Input group-->
                    </div>
                @endforeach
            </div>
        </div>
        <!--end::Shipping form-->
    </div>
    <!--end::Card header-->
</div>
