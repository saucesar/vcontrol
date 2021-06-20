<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Categories\CategoryResource;
use App\Http\Resources\Dates\DateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'ean' => $this->ean,
            "description" => $this->description,
            'value' => $this->value,
            'category' => CategoryResource::make($this->category),
            'dates' => DateResource::collection($this->dates),
        ];
    }
}
