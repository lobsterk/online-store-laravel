<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    public function values()
    {
        return $this->hasMany('App\Models\ProductOptionValue');
    }
}
