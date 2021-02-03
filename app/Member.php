<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable 
{
    use Notifiable;
    // use AuthenticableTrait;

    protected $table = 'members';

    protected $guard = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serialnumber', 'card_id', 'title', 'name', 'surname', 'bday', 'tel', 'membertype', 'date', 'expire', 'comment', 'address', 'moo', 'village', 'road', 'district', 'amphoe', 'province', 'zipcode',
        'carnumber', 'carprovince', 'miles', 'brand', 'model', 'color', 'password', 'status','education', 'career', 'salary', 'contidion', 
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function services() {
        return $this->belongsToMany('App\Service', 'member_id', 'id');
    }

}
