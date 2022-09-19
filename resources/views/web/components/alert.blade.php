@if (session()->has('alert'))
<div class="contentbar"> 
    <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('alert') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif