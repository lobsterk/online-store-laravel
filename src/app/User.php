<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'surname', 'patronymic'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const STATUS_ACTIVE  = 1;
    const STATUS_DISABLE = 0;

    const STATUS_LIST = [
        self::STATUS_ACTIVE     => 'Активен',
        self::STATUS_DISABLE    => 'Заблокирован'
    ];

    const ROLE_ADMIN    = 0;
    const ROLE_MANAGER  = 1;
    const ROLE_CLIENT   = 2;

    const ROLE_LIST = [
        self::ROLE_ADMIN        => 'Администратор',
        self::ROLE_MANAGER      => 'Менеджер',
        self::ROLE_CLIENT       => 'Пользователь'
    ];

    public function addresses()
    {
        return  $this->hasMany('App\Models\UserAddress');
    }
}
