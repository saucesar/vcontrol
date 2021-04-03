<div class="row mb-4">
    <div class="col">
        @include('components.inputs.text', ['name' => 'description', 'label' => 'Descrição', 'value' => $description ?? ''])
    </div>
</div>
<div class="row">
    <div class="col">
        @include('components.inputs.text', ['name' => 'ean', 'label' => 'Código Barra',  'value' => $ean ?? ''])
    </div>
</div>