<table class="table">
    <thead class="thead-light">
        <th>Nome</th>
        <th>Email</th>
        <th class="text-center">Ações</th>
    </thead>
    <tbody>
    @foreach($emails as $mail)
    <tr>
        <td>{{ $mail->name }}</td>
        <td>{{ $mail->email }}</td>
        <td>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditEmail{{ $mail->id }}"
                        title="Editar categoria." @if(!auth()->user()->isOwner()) disabled @endif >
                    <i class="fas fa-pen"></i>
                </button>
                <form action="{{ route('emails.destroy', $mail->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Tem certeza?');"
                            title="Deletar categoria."@if(!auth()->user()->isOwner()) disabled @endif>
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @include('emails.edit_modal', ['modalId' => "modalEditEmail$mail->id", 'mail' => $mail])
    @endforeach
    </tbody>
</table>