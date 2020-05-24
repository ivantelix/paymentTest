<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function getPayment(Request $request)
    {
        if ($request->has('client')) {
            $client = $request->get('client');

            $context = User::with('payments')->where('id', $client)->get();
        }
        else {
            $context = "You must specify the user_id parameter";
        }

        return response()->json($context, 200);
    }

    public function store(Request $request)
    {
        //not necesary
    }

    public function update(Request $request, $id)
    {
        //not necesary
    }

    public function destroy($id)
    {
        //not necesary
    }
}
