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
                        <span class="font-weight-bold mb-0" title="Codigo de barras">
                            <i class="fas fa-barcode"></i>
                            {{ $product->ean }}
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{ route('categories.show', $product->category->id) }}">
                            <span class="font-weight-bold mb-0" title="Categoria">
                                <i class="ni ni-books"></i>
                                {{ $product->category->name }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                    <i class="ni ni-app"></i>
                </div>
            </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
            <span class="text-nowrap"></span>
        </p>
    </div>
</div>