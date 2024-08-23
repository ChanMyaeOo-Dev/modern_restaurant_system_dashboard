<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderApiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "table" => $this->table_id,
            "total_price" => $this->total_price,
            "is_completed" => $this->is_completed,
            "order_items" => OrderItemApiResource::collection($this->order_items),
        ];
    }
}
