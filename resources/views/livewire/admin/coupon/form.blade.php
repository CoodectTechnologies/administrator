<div>
    <div>
        @include('admin.components.errors')
        <!--begin::Form-->
        <form class="form" wire:submit.prevent="{{ $method }}">
            <!--begin::Thumbnail settings-->
            <div class="col-lg-6">
                <div class="card card-flush py-4">
                    <div class="card-body text-left pt-0">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="required">Código</span>
                            </label>
                            <input type="text" required wire:model.defer="coupon.code" class="form-control form-control-solid @error('coupon.code') 'invalid-feedback' @enderror" placeholder="Ej: WELCOME{{ date('Y') }}" name="" />
                            @error('coupon.code') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="required">Porcentage</span>
                            </label>
                            <input type="number" required wire:model.defer="coupon.percentage" class="form-control form-control-solid @error('coupon.percentage') 'invalid-feedback' @enderror" placeholder="" name="" />
                            @error('coupon.percentage') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="required">Fecha fin</span>
                            </label>
                            <input type="date" required wire:model.defer="coupon.date_end" class="form-control form-control-solid @error('coupon.date_end') 'invalid-feedback' @enderror" name="" />
                            @error('coupon.date_end') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="">Gasto mínimo</span>
                            </label>
                            <input type="number" wire:model.defer="coupon.minimum_expense" class="form-control form-control-solid @error('coupon.minimum_expense') 'invalid-feedback' @enderror" placeholder="" name="" />
                            <span class="badge badge-sm badge-secondary">Deje vacio este campo en caso de no requerir un gasto mínimo</span>
                            @error('coupon.minimum_expense') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="form-label required">Excluir productos con promoción</label>
                            <!--end::Label-->
                            <select required wire:model.defer="coupon.exclude_promotion" class="form-select mb-2 @error('coupon.exclude_promotion') 'invalid-feedback' @enderror">
                                <option value="">Selecciona una opción</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                            @error('coupon.exclude_promotion')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-bold form-label mb-2">
                                <span class="">Limite de usos</span>
                            </label>
                            <input type="number" wire:model.defer="coupon.exclude_promotion" class="form-control form-control-solid @error('coupon.exclude_promotion') 'invalid-feedback' @enderror" placeholder="" name="" />
                            <span class="badge badge-sm badge-secondary">Deje vacio este campo en caso de no limitar la cantidad de usos</span>
                            @error('coupon.exclude_promotion') <small  class="form-text text-danger" role="alert">{{ $message }}</small> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="form-label required">Activo</label>
                            <!--end::Label-->
                            <select required wire:model.defer="coupon.active" class="form-select mb-2 @error('coupon.active') 'invalid-feedback' @enderror">
                                <option value="">Selecciona una opción</option>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                            @error('coupon.active')<small class="form-text text-danger" role="alert">{{ $message }}</small>@enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"><i class="fa fa-arrow-left"></i></button>
                            <button wire:loading.attr="disabled" wire:target="{{ $method }}" type="submit" class="btn btn-primary">
                                <span class="indicator-label">Guardar cambios</span>
                                <span wire:loading wire:target="{{ $method }}" class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
