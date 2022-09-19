<a href="#" onclick="event.preventDefault(); confirmDestroyVideo('{{ $video->slug }}')" class="btn btn-light-danger btn-shadow ms-2">Elimnar</a>
@once
    @push('footer')
        <script>
            function confirmDestroyVideo(slug){
                swal.fire({
                    title: "¿Estás seguro?",
                    text: "No podrá recuperar este video.",
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
                        @this.call('destroy', slug);
                    }
                });
            }
        </script>
    @endpush
@endonce