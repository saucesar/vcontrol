<div class="modal fade" id="{{ $modalId ?? 'modalAddCompany' }}" tabindex="-1" role="dialog"
    aria-labelledby="{{ $modalId ?? 'modalAddCompany' }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId ?? 'modalAddCompany' }}Label">Nova empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('company.store') }}" method="post">
                <input type="hidden" name="modalName" value="{{ $modalId ?? 'modalAddCompany' }}">
                <div class="modal-body">
                    @csrf
                    @include('company.form')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>