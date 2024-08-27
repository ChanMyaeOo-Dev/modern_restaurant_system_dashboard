<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TableResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "qr_code" => url('qr_codes/' . $this->qr_code),
        ];
    }
}
