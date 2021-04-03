@extends('layouts.app', ['active' => 'products', 'title' => 'Empresa'])

@section('content')
    @include('products.header')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        @include('products.info')
                    </div>
                    <div class="col"></div>
                </div>
                <div class="d-flex justify-content-center">
                    @include('components.alerts.error')
                    @include('components.alerts.success')
                </div>
                <div class="d-flex justify-content-between">
                    <div>{{ $products->links() }}</div>
                    <div>
                    @if(auth()->user()->isOwner())
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddProduct" title="Adicionar um Produto.">
                            <i class="ni ni-fat-add"></i>
                        </button>
                        @include('products.add_modal', ['modalId' => 'modalAddProduct'])
                    @endif
                    @include('components.per_page', ['route' => route('products.index')])
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
    </div>
@endsection