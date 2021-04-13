<div class="row mb-4">
    <input type="hidden" name="product_id" value="{{ $productId }}">
    <input type="hidden" name="value" value="{{ $value }}">
    <div class="col">
        <label for="date">Data</label>
        <input class="form-control @error('date') is-invalid @enderror" type="date" name="date" value="{{ $date ?? now() }}" required>
        @error('date')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col">
        @include('components.inputs.text_not_required', ['name' => 'lote', 'label' => 'Lote', 'value' => $lote ?? old('lote')])
    </div>
</div>
<div class="row mb-4">
    <div class="col">
        @include('components.inputs.number', ['name' => 'amount', 'label' => 'Quantidade', 'value' => $amount ?? old('amount') ?? '1'])
    </div>
    @if(isset($isEdit))
    <div class="col">
        <label for="reason_id">Motivo</label>
        <select class="form-control" name="reason_id" id="reason_id">
            <option value="">Selecione</option>
            @foreach(auth()->user()->company->reasons as $reason)
            <option value="{{ $reason->id }}">{{ $reason->name }}</option>
            @endforeach
        </select>
        @error('reason_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    @endif
</div>