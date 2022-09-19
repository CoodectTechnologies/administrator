<li><a class="dropdown-item" href="#" onclick="event.preventDefault(); confirmDestroyComment({{ $comment->id }})">Eliminar</a></li>
@once
    @push('footer')
    <script>
            function confirmDestroyComment(id){
                swal.fire({
                    title: "¿Estás seguro?",
                    text: "No podrá recuperar este comentario.",
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