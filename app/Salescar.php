<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salescar extends Model
{
	protected $table = 'sales_cars';

	protected $fillable = [
    	'member_id', 'carnumber', 'brand', 'model', 'color', 'typeCar'
    ];

    protected $primaryKey = 'id';
}
