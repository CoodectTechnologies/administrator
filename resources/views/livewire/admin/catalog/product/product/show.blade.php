<div>
    <!--begin::Navbar-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            @include('admin.catalog.product.product.partials.show._profile')
            <!--end::Details-->
            @include('admin.catalog.product.product.menu.index')
        </div>
    </div>
    <!--end::Navbar-->
    <!--begin::details View-->
    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
        <div class="tab-content" id="myTabContent" wire:ignore.self>
            <!--begin:::Tab pane-->
            <div wire:ignore.self class="tab-pane fade {{ $submodule === null ? 'show active' : '' }}" id="kt_product_general_tab" role="tabpanel">
                @include('admin.catalog.product.product.partials.show._general')
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div wire:ignore.self class="tab-pane fade {{ $submodule === 'comments' ? 'show active' : '' }}" id="kt_product_comment_tab" role="tabpanel">
                @include('admin.catalog.product.product.comment.index')
            </div>
        </div>
    </div>
    <!--end::details View-->
</div>
