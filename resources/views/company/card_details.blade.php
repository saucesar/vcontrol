<div class="card card-stats mb-4 mb-xl-0">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">{{ $company->name }}</h5>
            </div>
            <div class="col-auto">
                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                    <i class="ni ni-building"></i>
                </div>
            </div>
        </div>
        <p class="mt-3 mb-0 text-muted text-sm">
            @include('company.details', ['company' => $company])
        </p>
    </div>
</div>