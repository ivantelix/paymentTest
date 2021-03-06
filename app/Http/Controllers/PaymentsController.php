<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Model\Payment;
use App\Jobs\CLPConsult;
use App\Events\PaymentCreateEvent;

class PaymentsController extends Controller
{
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

        $payment = Payment::create($payment);

        if(!$payment) {
        	return response()->json("An error has occurred.", 400);
        }

        //dispatch job for consult api
        CLPConsult::dispatch($payment);

        return response()->json($payment, 201);
	}

	public function delete(Request $request)
    {
        if($request->has('uuid')) {
            Payment::where('uuid','=', $request->get('uuid'))->delete();
            $msg = "Payment has been successfully removed";
        }
        else {
            $msg = "You must specify the uuid parameter";
        }

        return response()->json($msg);
    }
}
