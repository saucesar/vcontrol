<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'company_id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class, 'category_emails');
    }

    public function containsEmail(int $emailId)
    {
        foreach($this->emails as $email) {
            if($email->id == $emailId) { return true; }
        }

        return false;
    }

    public static function byCompany(int $companyId, int $perPage = 0)
    {
        $categories = Category::where('company_id', $companyId);
        return $perPage > 0 ? $categories->paginate($perPage) : $categories->get();
    }

    public static function search(string $search,int $companyId, int $perPage = 0)
    {
        $categories = Category::where('name', 'ilike', "%$search%")->where('company_id', $companyId);
        return $perPage > 0 ? $categories->paginate($perPage)->appends(['search' => $search]) : $categories->get();
    }
}
