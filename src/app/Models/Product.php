<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'html_h1', 'html_title', 'meta_keywords',
        'meta_description', 'description', 'model',
        'price', 'count', 'status', 'created_by'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function manufacturer()
    {
        return $this->belongsTo('App\Models\Manufacturer');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }
}
