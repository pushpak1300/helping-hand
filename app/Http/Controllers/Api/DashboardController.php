<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dealings;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $userTransaction = $request->user()->getTotalTransaction();
        $totalTransaction = Dealings::count();
        return [
            'userTransaction' => $userTransaction,
            'totalTranasaction' => $totalTransaction,
            'transaction'=> $request->user()->transaction
        ];
    }
}
