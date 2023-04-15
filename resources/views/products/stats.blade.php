<!-- Card stats -->
<div class="row mb-4">
    <div class="col-xl-3 col-lg-6">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <img src="{{ $product->getEanImgUrl() }}" class="img-fluid" alt="Barcode {{ $product->ean }}"/>
            </div>
        </div>
    </div>
    <div class="col">
        @include('products.actions')
    </div>
</div>