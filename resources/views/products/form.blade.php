<div class="row mb-4">
    <div class="col">
        @include('components.inputs.text', ['name' => 'description', 'label' => 'Descrição', 'value' => $product->description ?? null])
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        @include('components.inputs.text', ['name' => 'ean', 'class' => 'ean', 'label' => 'Código Barra',  'value' => $product->ean ?? null])
    </div>
    <div class="col">
        @include('components.inputs.float', ['name' => 'value', 'label' => 'Valor',  'value' => $product->value ?? null])
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        <label for="category_id">Categoria</label>
        <select class="form-control" name="category_id" required>
            <option value="">Selecione</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @if(isset($product) && $product->category->id == $category->id || old('category_id') == $category->id) selected @endif>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>
</div>
@push('js')
<script type="text/javascript">
$(document).ready(function() {
    $('.ean').mask('0000000000000')
});
</script>
@endpush