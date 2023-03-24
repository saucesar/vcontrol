<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['ean', 'description', 'value', 'company_id', 'category_id'];

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
        $historic = Date::where('product_id', '=', $this->id)->where('deleted_at', '<>', null)->orderBy('deleted_at', 'DESC')->withTrashed();
        return $perPage > 0 ? $historic->paginate($perPage) : $historic->get();
    }

    public function getEanImgUrl()
    {
        $url = "https://www.cognex.com/api/Sitecore/Barcode";
        return "$url/Get?data=$this->ean&code=S_EAN13&width=1200&imageType=JPG&foreColor=%23000000&backColor=%23FFFFFF&rotation=RotateNoneFlipNone";
    }
}
