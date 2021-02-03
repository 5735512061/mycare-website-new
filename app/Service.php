<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table = 'services';

	protected $fillable = [
    	'staff_id', 'member_id', 'branch', 'date', 'miles', 'service', 'amount', 'unit', 'price', 'comment', 'discount', 'discountturn',
    ];

    protected $primaryKey = 'id';
}
