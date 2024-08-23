<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartApiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "table_id" => $this->table_id,
            "quantity" => $this->quantity,
            'item' => new ItemResource($this->item),
            'special_request' => $this->special_request
        ];
    }
}
