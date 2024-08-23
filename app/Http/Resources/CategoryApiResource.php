<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CategoryApiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "imageUrl" => Str::startsWith($this->photo, 'http')
                ? $this->photo
                : asset('images/' . $this->photo),
        ];
    }
}
