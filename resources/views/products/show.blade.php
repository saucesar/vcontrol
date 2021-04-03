@extends('layouts.app', ['active' => 'products', 'title' => 'Produtos'])

@section('content')
    @include('products.header', ['product' => $product])
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                @include('products.stats')
            </div>
        </div>
        <div class="d-flex justify-content-center">
            @include('components.alerts.error')
            @include('components.alerts.success')
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3>Validades</h3>
                    </div>
                    <div class="card_body">
                    
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3>Historico</h3>
                    </div>
                    <div class="card_body">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection