<div class="dropdown">
    <button class="btn btn-link" type="button" data-toggle="dropdown" title="{{ $title ?? '' }}">
        <i class="fas fa-list"></i>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ $route }}?perPage=4">04 por Página</a>
        <a class="dropdown-item" href="{{ $route }}?perPage=10">10 por Página</a>
        <a class="dropdown-item" href="{{ $route }}?perPage=16">16 por Página</a>
        <a class="dropdown-item" href="{{ $route }}?perPage=30">30 por Página</a>
    </div>
</div>