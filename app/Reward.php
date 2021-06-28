<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $table = 'rewards';

    protected $fillable = [
        'admin_id', 'user_type' , 'reward_name', 'point', 'expire', 'image', 'detail', 'comment', 'reward_type'
    ];

    protected $primaryKey = 'id';
}
