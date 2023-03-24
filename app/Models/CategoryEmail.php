<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryEmail extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'email_id'];
    protected $primaryKey = 'category_id';
    
    public $incrementing = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function email()
    {
        return $this->belongsTo(Email::class, 'email_id', 'id');
    }
}
