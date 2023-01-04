@include('components.inputs.text', ['name' => $name, 'label' => $label, 'type' => 'number', 'value' => ($value ?? null), 'prepend' => $prepend ?? null, 'min' => 1])
