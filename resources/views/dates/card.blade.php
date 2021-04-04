<div class="card">
    <div class="card-header">
        <h3>{{ $title }}</h3>
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