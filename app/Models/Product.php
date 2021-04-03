<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ean', 'description', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
