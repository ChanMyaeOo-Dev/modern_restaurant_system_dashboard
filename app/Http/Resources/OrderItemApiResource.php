<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemApiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'quantity' => $this->quantity,
            'unit_price' => $this->price,
            'special_request' => $this->special_request,
            'item' => new ItemResource($this->item),
        ];
    }
}
