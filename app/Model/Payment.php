<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $fillable = [
		'uuid',
		'payment_date',
		'expires_at',
		'status',
		'user_id',
		'clp_usd'
	];

	public function client()
	{
		return $this->belongsTo('App\User');
	}
}
