<div class="card">
    <div class="card-header">
        <h3>Ações</h3>
    </div>
    <div class="card_body">
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