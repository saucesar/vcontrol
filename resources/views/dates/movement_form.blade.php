<div class="row mb-4">
    <div class="col">
        @include('components.inputs.number', ['name' => 'amount', 'label' => $amountLabel, 'value' => $amount ?? old('amount') ?? '1'])
    </div>
    <div class="col">
        <label for="reason_id">Motivo</label>
        <select class="form-control" name="reason_id" id="reason_id" required>
            <option value="">Selecione</option>
            @foreach($company->reasons as $reason)
            <option value="{{ $reason->id }}" {{ old('reason_id') == $reason->id ? 'selected' : '' }}>{{ $reason->name }}</option>
            @endforeach
        </select>
        @error('reason_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>