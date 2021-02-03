<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Random extends Model
{
	protected $table = 'randoms';

	protected $fillable = [
    	'number', 'date',
    ];

    protected $primaryKey = 'id';
}
