<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesservice extends Model
{
	protected $table = 'sales_services';

	protected $fillable = [
        'car_id', 'branch', 'date', 'bill_number', 'service', 'amount', 'unit', 'price', 'comment', 'discount', 'discountturn',
    ];

    protected $primaryKey = 'id';
}
