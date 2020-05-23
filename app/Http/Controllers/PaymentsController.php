<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Model\Payment;
use App\Jobs\CLPConsult;

use App\Repositories\CLPConsultGuzzle;

class PaymentsController extends Controller
{
    protected $clp;

    public function __construct(CLPConsultGuzzle $clp)
    {
        $this->clp = $clp;
    }

    public function index()
	{
		$payments = Payment::with(['client'])->get();
		return response()->json($payments, 200);
	}

	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'payment_date' => 'date_format:"Y-m-d"',
            'expires_at' => 'required|date_format:"Y-m-d"',
            'user_id' => 'required|numeric',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $payment = [
        	"uuid" => Str::uuid(),
        	"payment_date" => $request->payment_date,
        	"expires_at" => $request->expires_at,
        	"status" => $request->status,
        	"user_id" => $request->user_id
        ];

        var_dump($this->clp->get());

        /*$payment = Payment::create($payment);

        if(!$payment) {
        	return response()->json("An error has occurred.", 400);
        }

        dispatch(new CLPConsult($payment));
        return response()->json($payment, 201);*/
	}
}
