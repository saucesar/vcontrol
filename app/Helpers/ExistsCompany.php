<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class ExistsCompany
{
    public static function get(): bool
    {
        return count(Auth::user()->companies) > 0;
    }
}