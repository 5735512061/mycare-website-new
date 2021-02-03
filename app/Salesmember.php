<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Salesmember extends Authenticatable 
{
    use Notifiable;

    protected $table = 'sales_members';

    protected $guard = 'sales_members';

    protected $fillable = [
        'serialnumber', 'card_id', 'title', 'name', 'surname', 'bday', 'tel', 'date', 'expire', 'comment', 'address', 'moo', 'village', 'road', 'district', 'amphoe', 
        'province', 'zipcode', 'password', 'file',
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token',
    ];

}
