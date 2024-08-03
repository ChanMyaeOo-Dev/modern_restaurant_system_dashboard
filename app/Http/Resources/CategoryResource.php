<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "photo" => Str::startsWith($this->photo, 'http')
                ? $this->photo
                : asset('images/' . $this->photo),
            "total_items" => $this->total_items(),
            "popularity" => $this->popularity(),
        ];
    }
}
