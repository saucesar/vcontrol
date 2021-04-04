<table class="table">
    <thead class="thead-light">
        <th>Categoria</th>
        <th>Produtos</th>
    </thead>
    <tbody>
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->name }}</td>
        <td>{{ $category->products->count() }}</td>
    </tr>
    @endforeach
    </tbody>
</table>