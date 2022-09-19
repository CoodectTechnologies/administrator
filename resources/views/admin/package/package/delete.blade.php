<!--end::Delete-->
<a href="#" onclick="event.preventDefault(); confirmDestroyPackage({{ $package->id }})" class="btn btn-sm btn-danger ms-2">Eliminar</a>

@once
    @push('footer')
    <script>
            function confirmDestroyPackage(id){
                swal.fire({
                    title: "¿Estás seguro?",
                    text: "No podrá recuperar este paquete.",
                    icon: "warning",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "<i class='fa fa-trash'></i> <span class='font-weight-bold'>Si, eliminar</span>",
                    cancelButtonText: "<i class='fas fa-arrow-circle-left'></i>  <span class='text-dark font-weight-bold'>No, cancelar</span>",
                    reverseButtons: true,
                    cancelButtonClass: "btn btn-light-secondary font-weight-bold",
                    confirmButtonClass: "btn btn-danger",
                }).then(function(result) {
                    if (result.isConfirmed) {
                        @this.call('destroy', id);
                    }
                });
            }
    </script>
    @endpush
@endonce