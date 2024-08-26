<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "photo" => Str::startsWith($this->photo, 'http')
                ? $this->photo
                : url('images/' . $this->photo),
            "price" => $this->price,
            "category_id" => $this->category_id,
            "category" => $this->category ? $this->category->name : "No Category",
        ];
    }
}
