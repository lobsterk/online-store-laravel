<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    const STATUS_DISABLE = 0;
    const STATUS_ACTIVE  = 1;

    const STATUS_LIST = [
        self::STATUS_DISABLE    => 'Неактивен',
        self::STATUS_ACTIVE     => 'Активен'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\Users');
    }
}
