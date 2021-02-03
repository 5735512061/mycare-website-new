<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    use Notifiable;

    protected $table = 'staffs';

    protected $guard = 'staff';

    protected $fillable = [
        'admin_id', 'branch', 'staff_name', 'password', 'pw',
    ];

    protected $primaryKey = 'id';
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
