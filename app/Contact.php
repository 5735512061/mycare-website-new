<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';

	protected $fillable = [
    	'serialnumber', 'name', 'tel', 'message',
    ];

    protected $primaryKey = 'id';
}
