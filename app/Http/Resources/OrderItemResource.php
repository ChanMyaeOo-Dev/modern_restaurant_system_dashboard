<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class OrderItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "photo" => Str::startsWith($this->photo, 'http')
                ? $this->photo
                : url('images/' . $this->photo),
            "price" => $this->price
        ];
    }
}
