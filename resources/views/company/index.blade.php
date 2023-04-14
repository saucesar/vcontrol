@extends('layouts.app', ['active' => 'company', 'title' => 'Empresa'])

@section('content')
@include('company.header')
<div class="container-fluid mt--7 card card-body bg-secondary">
    <div class="d-flex justify-content-center">
        @include('components.alerts.error')
        @include('components.alerts.success')
    </div>
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddCompany"
                    title="Adicionar uma empresa.">
                    <i class="ni ni-fat-add"></i>
                </button>
                @include('company.modal_add')
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <table class='table table-responsive-sm table-striped'>
                <thead class="thead-dark">
                    <th>ID</th>
                    <th>CNPJ</th>
                    <th>NOME</th>
                    <th>DETALHES</th>
                    <th class="text-center">OPÇÔES</th>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->cnpj }}</td>
                        <td>{{ $company->name }}</td>
                        <td>
                            <div class="d-inline-flex justify-content-center align-items-center"
                                 title="{{ count($company->products) }} produtos">
                                <i class="ni ni-app"></i>
                                <div class="ml-1">{{ count($company->products) }}</div>
                            </div>
                            <div class="d-inline-flex justify-content-center align-items-center ml-2"
                                 title="{{ count($company->categories) }} categorias">
                                <i class="ni ni-books"></i>
                                <div class="ml-1">{{ count($company->categories) }}</div>
                            </div>
                            <div class="d-inline-flex justify-content-center align-items-center ml-2"
                                 title="{{ count($company->emails) }} emails">
                                <i class="ni ni-email-83"></i>
                                <div class="ml-1">{{ count($company->emails) }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <form action="{{ route('company.destroy', $company->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Tem certeza?');"
                                            title="Deletar categoria.">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection