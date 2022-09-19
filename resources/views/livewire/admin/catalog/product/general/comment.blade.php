<div>
    <!--begin::Post-->
    <div class="ps-lg-6 mb-16 mt-md-0 mt-17">
        <!--begin::Footer-->
        <div class="d-flex flex-stack flex-wrap">
            <!--begin::Item-->
            <div class="d-flex align-items-center pe-2">
                <!--begin::Avatar-->
                <div class="symbol symbol-35px symbol-circle me-3">
                    <img loading="lazy" src="{{ $comment->imageUserPreview() }}" class="" alt="" />
                </div>
                <!--end::Avatar-->
                <!--begin::Text-->
                <div class="fs-5 fw-bolder">
                    <a class="text-gray-700 text-hover-primary">
                        {{ $comment->name }}
                    </a>
                    <span class="text-muted">
                        {{ $comment->dateToString() }}
                    </span>
                    @if ($comment->approved)
                        <span class="badge badge-primary">
                            Aprobado
                        </span>
                    @else
                        <span class="badge badge-warning">
                            No aprobado
                        </span>
                    @endif
                </div>
                <!--end::Text-->
            </div>
            <!--end::Item-->
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Acciones
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a href="mailto:{{ $comment->email }}" class="dropdown-item">Responder</a></li>
                    @if ($comment->approved)
                        <li wire:click.prevent="refused"><a class="dropdown-item">Rechazar</a></li>
                    @else
                        <li wire:click.prevent="approved"><a class="dropdown-item">Aprovar</a></li>
                    @endif                  
                    @include('admin.blog.post.comment.delete')
                </ul>
              </div>
        </div>
        <!--end::Footer-->
        <!--begin::Text-->
        <div class="fw-bold fs-5 mt-4 text-gray-600 text-dark">
            {{ $comment->body }}
        </div>
        <!--end::Text-->
    </div>
    <!--end::Post-->
</div>
