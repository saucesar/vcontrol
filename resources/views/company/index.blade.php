@extends('layouts.app', ['active' => 'company', 'title' => 'Empresa'])

@section('content')
    @include('company.header')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="row">
                    <div class="col">
                        @include('company.products_info')
                    </div>
                    <div class="col">
                        @include('company.products_info')
                    </div>
                    <div class="col">
                        @include('company.products_info')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection