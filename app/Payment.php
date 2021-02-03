<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $table = 'payments';

	protected $fillable = [
    	'member_id', 'card_id', 'slip', 'bank', 'money', 'payday', 'time', 'comment',
    ];

    protected $primaryKey = 'id';
}
