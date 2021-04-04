<div class="card card-stats flex-fill">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">Produtos</h5>
                <span class="h2 font-weight-bold mb-0">{{ $category->products->count() }}</span>
            </div>
            <div class="col-auto">
                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                    <i class="ni ni-app"></i>
                </div>
            </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-nowrap">Atualizado em {{ now() }}</span>
        </p>
    </div>
</div>