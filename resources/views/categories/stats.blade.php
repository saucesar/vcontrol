<!-- Card stats -->
<div class="row mb-4">
    <div class="col">
        @include('company.card_details')
    </div>
    <div class="col">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Categorias</h5>
                        <span class="h2 font-weight-bold mb-0">{{ $categories->total() }}</span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm mb-3">
                    <span class="text-nowrap">Atualizado em {{ now() }}</span>
                </p>
            </div>
        </div>
    </div>
</div>