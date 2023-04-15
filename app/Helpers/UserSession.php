<?php

namespace App\Helpers;

use App\Http\Controllers\CompanyController;
use App\Models\Company;

class UserSession
{
    public static function getCompany(): Company
    {
        return (new CompanyController())->getCompanyInSession();
    }
}