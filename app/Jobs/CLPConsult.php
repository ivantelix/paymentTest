<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\Payment;

class CLPConsult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;
    protected $clp;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function handle()
    {
        $date = Carbon::now()->format('Y-m-d');
        $payment = Payment::whereDate('created_at', '=', $date)
            ->where('clp_usd', '!=', null)
            ->first();

        if(empty($payment)) {
            $clpConsultGuzzle = new Client([
                'base_uri' => 'https://mindicador.cl/api/dolar',
            ]);
            $response = json_decode($clpConsultGuzzle->request('GET')->getBody()->getContents());

            $this->clp = $response->{'serie'}[0]->valor;
        }
        else {
            $this->clp = $payment->clp_usd;
        }

        Payment::where('uuid', '=', $this->payment['uuid'])->update([
            'clp_usd' => $this->clp
        ]);
    }
}
