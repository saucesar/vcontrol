<div class="card">
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
                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalEditProduct{{ $product->id }}"
                        title="Editar um Produto." @if(!auth()->user()->isOwner()) disabled @endif >
                    <i class="fas fa-pen"></i>
                </button>
                @include('products.edit_modal', ['modalId' => "modalEditProduct$product->id", 'product' => $product])
            </div>
            <div class="col">
                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-block btn-danger" type="submit" onclick="return confirm('Tem certeza?')"
                            title="Deletar produto."  @if(!auth()->user()->isOwner()) disabled @endif >
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>

            <div class="col">
                <a class="btn btn-block btn-danger" href="#" title="Detalhes em pdf.">
                    <i class="fas fa-file-pdf"></i>
                </a>
            </div>
        </div>
    </div>
</div>