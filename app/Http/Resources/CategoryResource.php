<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "photo" => $this->photo,
            "total_items" => $this->total_items(),
            "popularity" => $this->popularity(),
        ];
    }
}
