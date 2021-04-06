<table class="table">
    <thead class="thead-light">
        <th>Data</th>
        <th>Quant.</th>
        <th>Lote</th>
        @if(isset($noActions))
        <th>Motivo</th>
        @else
        <th class="text-center">Ações</th>
        @endif
    </thead>
    <tbody>
        @foreach($dates as $date)
        <tr>
            <td>{{ $date->date() }}</td>
            <td>{{ $date->amount }}</td>
            <td>{{ $date->lote }}</td>
            @if(isset($noActions))
            <td>{{ $date->reason->name }}</td>
            @else
            <td>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalGraficDate{{ $date->id }}"
                            title="Gráfico de evolução.">
                        <i class="ni ni-chart-bar-32"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEditDate{{ $date->id }}"
                            title="Editar categoria." @if(!auth()->user()->isOwner()) disabled @endif >
                        <i class="fas fa-pen"></i>
                    </button>
                    <form action="{{ route('dates.destroy', $date->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Tem certeza?');"
                                title="Deletar data."@if(!auth()->user()->isOwner()) disabled @endif>
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
            @include('dates.edit_modal', ['modalId' => "modalEditDate$date->id", 'date' => $date])
            @include('dates.graphic_modal', ['modalId' => "modalGraficDate$date->id", 'chartId' => "chartDate$date->id"])
            @endif
        </tr>
        @endforeach
    </tbody>
</table>