<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
	protected $table = 'statistics';

	protected $fillable = [
    	'member_id','sales_id', 'store_id', 'date', 'code',
    ];

    protected $primaryKey = 'id';
}
