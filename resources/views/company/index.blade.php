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

            </div>
        </div>
    </div>
@endsection