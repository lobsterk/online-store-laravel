<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    protected $fillable = [
        'path', 'sort_order'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
