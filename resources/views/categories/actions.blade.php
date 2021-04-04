<div class="card card-stats flex-fill">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Ações</h5>
            </div>
            <div class="col-auto">
                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                    <i class="fas fa-info-circle"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalEditCategory{{ $category->id }}"
                        title="Editar categoria." @if(!auth()->user()->isOwner()) disabled @endif >
                    <i class="fas fa-pen"></i>
                </button>
            </div>
            <div class="col">
                <form action="{{ route('categories.destroy', $category->id) }}?redirect=categories.index" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-block btn-danger" type="submit" onclick="return confirm('Tem certeza?');"
                            title="Deletar categoria."@if(!auth()->user()->isOwner()) disabled @endif>
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
            @include('categories.edit_modal', ['modalId' => "modalEditCategory$category->id", 'category' => $category])
        </div>
    </div>
</div>