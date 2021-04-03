<div class="card card-sized shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0" title="Descrição">
                    <a href="{{ route('products.show', $product->id) }}">
                        {{ $product->description }}
                    </a>
                </h5>
                <div class="row">
                    <div class="col">
                        <span class="h2 font-weight-bold mb-0" title="Codigo de barras">
                            <i class="fas fa-barcode"></i>
                            {{ $product->ean }}
                        </span>
                    </div>
                    <div class="col">
                        <span class="h2 font-weight-bold mb-0" title="Categoria">
                            <i class="ni ni-app"></i>
                            {{ $product->category->name }}
                        </span>
                    </div>
                </div>
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