<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'amount', 'value', 'date_id', 'reason_id'];

    public function date()
    {
        return $this->belongsTo(Date::class, 'date_id', 'id');
    }

    public function reason()
    {
        return $this->hasOne(Reason::class, 'id', 'reason_id');
    }
}
