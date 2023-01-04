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
        <h3 class="text-center">Lista de Emails</h3>
        <div class="row">
            <div class="col-2 text-center"></div>
            <div class="col-5">Nome</div>
            <div class="col">Email</div>
        </div>
        <hr class="my-3">
        @foreach($emails as $mail)
        <div class="row">
            <div class="col-2 text-center">
                <input class="@error('emails') is-invalid @enderror" type="checkbox" name="emails[]" id="email{{ $mail->id }}" value="{{ $mail->id }}"
                       @if(isset($category) && $category->containsEmail($mail->id)) checked @endif>
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