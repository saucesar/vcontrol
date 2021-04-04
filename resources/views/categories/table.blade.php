<table class="table">
    <thead class="thead-light">
        <th>ID</th>
        <th>Categoria</th>
        <th class="text-center">Produtos</th>
        <th class="text-center">Ações</th>
    </thead>
    <tbody>
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td class="text-center">{{ $category->products->count() }}</td>
        <td>
            <div class="d-flex justify-content-center">
                <a class="btn btn-sm btn-info" href="{{ route('categories.show', $category->id) }}" title="Detalhes da categoria.">
                    <i class="far fa-eye"></i>
                </a>
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditCategory{{ $category->id }}"
                        title="Editar categoria." @if(!auth()->user()->isOwner()) disabled @endif >
                    <i class="fas fa-pen"></i>
                </button>
                <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Tem certeza?');"
                            title="Deletar categoria."@if(!auth()->user()->isOwner()) disabled @endif>
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @include('categories.edit_modal', ['modalId' => "modalEditCategory$category->id", 'category' => $category, 'emails' => $emails])
    @endforeach
    </tbody>
</table>