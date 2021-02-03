<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salescondition extends Model
{
	protected $table = 'sales_conditions';

	protected $fillable = [
    	'member_id', 'store_id', 'status', 'date',
    ];

    protected $primaryKey = 'id';
}
