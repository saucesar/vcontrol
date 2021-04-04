@extends('layouts.app', ['active' => 'categories', 'title' => 'Categoria'])

@section('content')
    @include('categories.header')
    <div class="container-fluid mt--7 card card-body bg-secondary">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="row">           
                    <div class="col">
                        @include('categories.stats')
                    </div>     
                    <div class="col">
                        @include('categories.actions')
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    @include('components.alerts.error')
                    @include('components.alerts.success')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Lista de Produtos</h3>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            {{ $products->links() }}
            <div>
                @include('components.per_page', ['route' => route('categories.show', $category->id), 'values' => [4, 8, 12, 20]])
            </div>
        </div>
        <div class="card-deck">
            @foreach($products as $product)
                @include('products.card', ['product' => $product])
            @endforeach
        </div>
        <div class="d-flex justify-content-start">
            {{ $products->links() }}
        </div>
    </div>
@endsection