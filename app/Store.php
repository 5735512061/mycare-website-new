<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Store extends Authenticatable
{
    use Notifiable;
    // use AuthenticableTrait;
    protected $table = 'stores';

    protected $guard = 'store';


    protected $fillable = [
        'admin_id', 'name', 'store_name', 'type', 'tel', 'date', 'expire', 'image', 'logo', 'scan', 'promotion', 'comment', 'point', 'password', 'location',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token',
    ];
}
