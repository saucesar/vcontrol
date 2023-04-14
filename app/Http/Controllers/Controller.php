<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCompanyInSession(): Company
    {
        try {
            $company = session('company');
            
            if(is_null($company)) {
                return $this->setCompanyInSession(auth()->user()->companies[0]);
            }
            
            return $company->refresh();
        } catch(Exception $e) {
            return null;
        }
    }

    public function setCompanyInSession(Company $company): Company
    {
        session()->put('company', $company);
        return $company;
    }
}
