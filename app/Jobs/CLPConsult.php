<?php

namespace App\Jobs;

use App\Model\Payment;
use App\Repositories\CLPConsultGuzzle;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CLPConsult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;
    protected $clpConsultGuzzle;
    protected $clp;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->clpConsultGuzzle = new CLPConsultGuzzle();
    }

    public function handle()
    {
        $date = \Carbon::now();
        $payment = Payment::where('crated_at', '=', $date)
            ->where('clp_usd', '!=', '')
            ->first();

        if(!$payment) {
            $this->clp = $this->clpConsultGuzzle->get();
        }
        else {
            $this->clp = $payment->clp_usd;
        }

        Payment::where('uuid', $this->payment['uuid'])->update([
            'clp_usd' => $this->clp
        ]);
    }
}
