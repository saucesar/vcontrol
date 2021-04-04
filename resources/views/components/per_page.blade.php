<div class="dropdown">
    <button class="btn btn-info" type="button" data-toggle="dropdown" title="{{ $title ?? '' }}">
        <i class="ni ni-bullet-list-67"></i>
    </button>
    <div class="dropdown-menu">
        @if(isset($values))
            @foreach($values as $value)
            <a class="dropdown-item" href="{{ $route }}?perPage={{ $value }}">{{ $value }} por Página</a>
            @endforeach
        @else
            <a class="dropdown-item" href="{{ $route }}?perPage=4">04 por Página</a>
            <a class="dropdown-item" href="{{ $route }}?perPage=10">10 por Página</a>
            <a class="dropdown-item" href="{{ $route }}?perPage=16">16 por Página</a>
            <a class="dropdown-item" href="{{ $route }}?perPage=30">30 por Página</a>
        @endif
    </div>
</div>