<div class="row mb-4">
    <div class="col">
        @include('components.inputs.text', ['name' => 'name', 'label' => 'Nome', 'value' => $name ?? null])
    </div>
</div>
<div class="row">
    <div class="col">
        @include('components.inputs.text', ['name' => 'email', 'label' => 'Email', 'value' => $email ?? null])
    </div>
</div>