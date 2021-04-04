@extends('layouts.app', ['active' => 'categories', 'title' => 'Categoria'])

@section('content')
    @include('categories.header')
    <div class="container-fluid mt--7 card card-body bg-secondary">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="row mb-4">
                    <div class="col d-flex align-content-stretch">
                        @include('categories.cards.products_info')
                    </div>
                    <div class="col d-flex align-content-stretch">
                        @include('categories.cards.emails_info')
                    </div>
                    <div class="col d-flex align-content-stretch">
                        @include('categories.actions')
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    @include('components.alerts.error')
                    @include('components.alerts.success')
                </div>
            </div>
        </div>
        <div class="card card-body mb-4">
            <h3>Enviar para:</h3>
            @include('emails.table', ['emails' => $category->emails, 'notActions' => true])
        </div>
        <div class="card card-body mb-4">
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
    </div>
@endsection