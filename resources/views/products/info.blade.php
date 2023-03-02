<div class="row mb-4">
    <div class="col">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Produtos</h5>
                        <span class="h2 font-weight-bold mb-0">{{ auth()->user()->company->products->count() }}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-nowrap"></span>
                </p>
            </div>
        </div>
    </div>
</div>