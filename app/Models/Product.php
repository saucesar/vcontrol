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

    public static function byCompany(int $companyId, int $perPage = 0)
    {
        $products = Product::where('company_id', $companyId);

        return $perPage > 0 ? $products->paginate($perPage) : $products->get();
    }
}
