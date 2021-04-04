@extends('layouts.app', ['active' => 'products', 'title' => 'Produtos'])

@section('content')
    @include('products.header', ['product' => $product])
    <div class="container-fluid mt--7 card card-body bg-secondary">
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
                @include('dates.card', ['dates' => $product->dates, 'title' => 'Validades'])
            </div>
            <div class="col">
                @include('dates.card', ['dates' => $product->historic(5), 'title' => 'Historico', 'noActions' => true])
            </div>
        </div>
    </div>
@endsection