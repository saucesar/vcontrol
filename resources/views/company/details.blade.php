<div class="d-inline-flex justify-content-center align-items-center" title="{{ count($company->products) }} produtos">
    <i class="ni ni-app"></i>
    <div class="ml-1">{{ count($company->products) }}</div>
</div>
<div class="d-inline-flex justify-content-center align-items-center ml-2" title="{{ count($company->categories) }} categorias">
    <i class="ni ni-books"></i>
    <div class="ml-1">{{ count($company->categories) }}</div>
</div>
<div class="d-inline-flex justify-content-center align-items-center ml-2" title="{{ count($company->emails) }} emails">
    <i class="ni ni-email-83"></i>
    <div class="ml-1">{{ count($company->emails) }}</div>
</div>
