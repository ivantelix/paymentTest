<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

use App\User;

use App\Mail\PaymentMailNotification;

class PaymentCreateListener
{
    public function handle($event)
    {
        $user = User::find($event->payment->user_id);

        Mail::to($user->email)->send(new PaymentMailNotification());
    }
}
