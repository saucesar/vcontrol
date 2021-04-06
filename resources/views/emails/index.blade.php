@extends('layouts.app', ['active' => 'emails', 'title' => 'Emails'])

@section('content')
    @include('emails.header')
    <div class="container-fluid mt--7 card card-body bg-secondary">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                @include('emails.stats')
                <div class="d-flex justify-content-center">
                    @include('components.alerts.error')
                    @include('components.alerts.success')
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <div>{{ $emails->links() }}</div>
                    <div class="d-inline-flex">
                    @if(auth()->user()->isOwner())
                    <div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddEmail" title="Adicionar um Email.">
                            <i class="ni ni-fat-add"></i>
                        </button>
                        @include('emails.add_modal', ['modalId' => "modalAddEmail"])
                    </div>
                    @endif
                    @include('components.per_page', ['route' => route('emails.index'), 'values' => [5, 10, 15, 20]])
                    @include('components.clean_filters', ['route' => route('emails.index')])
                    @include('components.search_form', ['route' => route('emails.search')])
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <div class="card card-body shadow">
                            @include('emails.table', ['emails' => $emails])
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start">
                    {{ $emails->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection