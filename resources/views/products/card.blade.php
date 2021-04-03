<div class="card card-sized mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <a href="{{ route('products.show', $product->id) }}">
                    <h5 class="card-title text-uppercase text-muted mb-0">{{ $product->description }}</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $product->ean }}</span>
                </a>
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