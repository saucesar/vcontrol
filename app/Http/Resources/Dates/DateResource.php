<?php

namespace App\Http\Resources\Dates;

use Illuminate\Http\Resources\Json\JsonResource;

class DateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'amount' => $this->amount,
            'value' => $this->value,
            'lote' => $this->lote,
        ];
    }
}
