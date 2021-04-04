<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ean', 'description', 'company_id', 'category_id'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->withTrashed();
    }

    public function dates()
    {
        return $this->hasMany(Date::class, 'product_id', 'id')->orderBy('date');
    }

    public function historic(int $perPage = 0)
    {
        $historic = Date::where('product_id', '=', $this->id)->where('deleted_at', '<>', null)->withTrashed();
        return $perPage > 0 ? $historic->paginate($perPage) : $historic->get();
    }

    public static function byCompany(int $companyId, int $perPage = 0)
    {
        $products = Product::where('company_id', $companyId);
        return $perPage > 0 ? $products->paginate($perPage) : $products->get();
    }

    public static function byCategory(int $categoryId, int $perPage = 0)
    {
        $products = Product::where('category_id', $categoryId);
        return $perPage > 0 ? $products->paginate($perPage) : $products->get();
    }
}
