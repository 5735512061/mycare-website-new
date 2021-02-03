<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
	protected $table = 'conditions';

	protected $fillable = [
    	'member_id', 'store_id', 'status', 'date',
    ];

    protected $primaryKey = 'id';
}
