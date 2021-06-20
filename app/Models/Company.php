<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'cnpj', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'company_id', 'id');
    }

    public function productsWithPaginate(int $perPage = 5, bool $withDates = false)
    {
        $products = Product::where('company_id', $this->id);
        !$withDates ? : $products->with('dates');
        
        return $perPage > 0 ? $products->paginate($perPage) : $products->paginate(5);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'company_id', 'id');
    }

    public function emails()
    {
        return $this->hasMany(Email::class, 'company_id', 'id');
    }

    public function reasons()
    {
        return $this->hasMany(Reason::class,'company_id', 'id');
    }
}
