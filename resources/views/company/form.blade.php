<div class="row mb-4">
    <div class="col">
        @include('components.inputs.text', ['name' => 'name', 'label' => 'Nome', 'value' => $name ?? null])
    </div>
</div>
<div class="row">
    <div class="col">
        @include('components.inputs.text', [
        'name' => 'cnpj', 'label' => 'CNPJ', 'value' => $cnpj ?? null, 'class' => 'cnpj', 'class' => 'cnpj',
        ])
    </div>
</div>

@push('js')
<script type="text/javascript">
$(document).ready(function() {
    $('.cnpj').mask('00.000.000/0000-00')
});
</script>
@endpush