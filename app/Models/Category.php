<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function total_items()
    {
        return $this->hasMany(Item::class)->count();
    }

    public function popularity()
    {
        return "7 out of 10";
    }
}
