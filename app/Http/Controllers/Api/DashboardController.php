<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $userTransaction = $request->user()->getTotalTransaction();
        $totalTransaction = Transaction::count();

        return [
            'userTransaction' => $userTransaction,
            'totalTranasaction' => $totalTransaction,
            'transaction'=> $request->user()->transactions
        ];
    }
}
