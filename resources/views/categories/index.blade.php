@extends('layouts.app', ['active' => 'categories', 'title' => 'Categoria'])

@section('content')
    @include('categories.header')
    <div class="container-fluid mt--7 card card-body bg-secondary">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                @include('categories.stats')
                <div class="d-flex justify-content-center">
                    @include('components.alerts.error')
                    @include('components.alerts.success')
                </div>
                <div class="d-flex justify-content-between">
                    <div>{{ $categories->links() }}</div>
                    <div>
                    @if(auth()->user()->isOwner())
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddCategory" title="Adicionar uma categoria.">
                            <i class="ni ni-fat-add"></i>
                        </button>
                        @include('categories.add_modal', ['modalId' => 'modalAddCategory'])
                    @endif
                    @include('components.per_page', ['route' => route('categories.index'), 'values' => [5, 10, 15, 20]])
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card card-body shadow-lg">
                            @include('categories.table', ['categories' => $categories])
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection