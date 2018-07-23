<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'parent_id', 'display_menu', 'status', 'slug'
    ];

    public function subCategory()
    {
        return $this->hasMany(self::class, 'parent_id');

    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
