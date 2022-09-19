<div>
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">
                
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select wire:model="module" class="form-select form-select-solid">
                        <option value="">Todos</option>
                        @foreach ($modulesWeb as $moduleWeb)
                            <option value="{{ $moduleWeb->id }}">{{ $moduleWeb->name }}</option>
                        @endforeach
                    </select>
                    <!--end::Select2-->
                </div>
                @include('admin.banner.create')
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Banner</th>
                            <th class="min-w-125px">Módulo</th>
                            <th class="min-w-125px">Titulo</th>
                            <th class="min-w-125px">Subtitulo</th>
                            <th class="min-w-125px">Fecha de creación</th>
                            <th class="min-w-100px">Acciones</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($banners as $banner)
                        <!--begin::Table row-->
                        <tr>
                            <!--begin::Td=-->
                            <td>
                                @if ($banner->type == 'Imagen')
                                    <img class="img-fluid" src="{{ $banner->imagePreview() }}" alt="">
                                @else
                                    <video class="img-fluid" controls src="{{ $banner->videoPreview() }}"></video>
                                @endif
                            </td>
                            <!--end::Td=-->
                            <td>
                                {{ $banner->moduleWeb ? $banner->moduleWeb->name : 'N/A' }}
                            </td>
                            <td>
                                {{ $banner->title }}
                            </td>
                            <td>
                                {{ $banner->subtitle }}
                            </td>
                            <!--begin::Joined-->
                            <td>{{ $banner->dateToString() }}</td>
                            <!--begin::Joined-->
                            <!--begin::Action=-->
                            <td class="">
                                @include('admin.banner.edit')
                                @include('admin.banner.delete')
                            </td>
                            <!--end::Action=-->
                        </tr>
                        <!--end::Table row-->
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    @push('footer')
    <script>
        Livewire.on('render', function(){
            $('.modal').modal('hide');
        });
    </script>
    @endpush
    <!--end::Content-->
</div>
