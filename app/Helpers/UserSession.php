<?php

namespace App\Helpers;

use App\Http\Controllers\CompanyController;


class UserSession
{
    public static function getCompany()
    {
        return (new CompanyController())->getCompanyInSession();
    }
}