<div class="card flex-fill mb-4">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h3>{{ $title }}</h3>
            @if(!isset($noActions))
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAddDate"
                    title="Adicionar uma categoria." @if(auth()->user()->status != 'granted') disabled @endif>
                <i class="ni ni-fat-add"></i>
            </button>
            @endif
        </div>
        @if(!isset($noActions))
            @include('dates.add_modal', ['modalId' => 'modalAddDate', 'productId' => $product->id, 'value' => $product->value])
        @endif
    </div>
    <div class="card_body">
        @include('dates.table', ['dates' => $dates, 'noActions' => $noActions ?? null])
    </div>
    <div class="card-footer">
    @if(!($dates instanceof \Illuminate\Database\Eloquent\Collection))
    {{ $dates->links() }}
    @endif
    </div>
</div>