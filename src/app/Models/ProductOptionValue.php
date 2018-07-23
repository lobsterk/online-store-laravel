<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOptionValue extends Model
{

    public function option()
    {
        return $this->belongsTo('App\Models\ProductOption');
    }
}
