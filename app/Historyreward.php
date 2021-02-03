<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historyreward extends Model
{
	protected $table = 'historyrewards';

	protected $fillable = [
    	'member_id', 'sales_id', 'reward_id', 'date', 'status',
    ];

    protected $primaryKey = 'id';
}
