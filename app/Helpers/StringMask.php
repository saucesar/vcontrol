<?php

namespace App\Helpers;

class StringMask
{
    public static function cnpj(string $cnpj)
    {
        if(strlen($cnpj) == 14) {
            return substr($cnpj, 0, 2).".".
                   substr($cnpj, 2, 3).".".
                   substr($cnpj, 5, 3)."/".
                   substr($cnpj, 8, 4)."-".
                   substr($cnpj, 12, 2);
        }

        return $cnpj;
    }
}