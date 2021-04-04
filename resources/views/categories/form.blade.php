<div class="row mb-4">
    <div class="col">
        @include('components.inputs.text', ['name' => 'name', 'label' => 'Nome', 'value' => $name ?? ''])
    </div>
</div>
<div class="row">
    <div class="col">
        @error('emails')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="row">
            <div class="col-2 text-center">Incluir?</div>
            <div class="col-5">Nome</div>
            <div class="col">Email</div>
        </div>
        <hr class="my-3">
        @foreach($emails as $mail)
        <div class="row">
            <div class="col-2 text-center">
                <input class="@error('emails') is-invalid @enderror" type="checkbox" name="emails[]" id="email{{ $mail->id }}" value="{{ $mail->id }}" 
                       @if(in_array($mail->id, $categoryEmails ?? old('emails') ?? []))) checked @endif>
            </div>
            <div class="col-5">
                {{ $mail->name }}
            </div>
            <div class="col">
                {{ $mail->email }}
            </div>
        </div>
        <hr class="my-3">
        @endforeach
    </div>
</div>