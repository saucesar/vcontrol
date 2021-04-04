<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Date extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['date', 'amount', 'lote', 'product_id', 'previous_id', 'reason_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function previous()
    {
        return $this->hasOne(Date::class, 'id', 'previous_id')->withTrashed();
    }

    public function reason()
    {
        return $this->hasOne(Reason::class, 'id', 'reason_id');
    }
}
