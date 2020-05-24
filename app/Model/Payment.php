<?php

namespace App\Model;

use App\Events\PaymentCreateEvent;
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

    protected $dispatchesEvents = [
        'saved' => PaymentCreateEvent::class,
    ];

	public function client()
	{
		return $this->belongsTo('App\User');
	}
}
