<div class="row mb-4">
    <div class="col">
        @include('components.inputs.text', ['name' => 'description', 'label' => 'Descrição', 'value' => $description ?? ''])
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        @include('components.inputs.text', ['name' => 'ean', 'label' => 'Código Barra',  'value' => $ean ?? ''])
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <label for="category_id">Categoria</label>
        <select class="form-control" name="category_id" required>
            <option value="">Selecione</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ !(isset($categoryId) && $categoryId == $category->id) ? : 'selected' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>