<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "table" => $this->table->name,
            "total" => $this->total_price,
        ];
    }
}
