@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="alert-icon"><i class="fas fa-thumbs-down"></i></span>
    <span class="alert-text"><strong></strong>{{ session('error') }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif