<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $modalId }}Label">Editar Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('dates.update', $date->id) }}" method="post">
        @csrf
        @method('put')
        <input type="hidden" name="modalName" value="{{ $modalId }}">
        <div class="modal-body">
            @include('dates.form', ['productId' => $date->product_id, 'value' => $date->value, 'date' => $date->date, 'lote' => $date->lote, 'amount' => $date->amount, 'isEdit' => true])
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@push('head_scripts')
    @if($errors->any())
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#{{ old('modalName') }}").modal('show');
        });
    </script>
    @endif
@endpush