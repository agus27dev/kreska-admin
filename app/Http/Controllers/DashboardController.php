<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransactionModel;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }

    function index(){

        $income = TransactionModel::where('transaction_status','SUCCESS')->sum('transaction_total');
        $sales  = TransactionModel::count();
        $items   = TransactionModel::orderBy('id','DESC')->take(5)->get();
        $pie    = [
            'pending'  => TransactionModel::where('transaction_status','PENDING')->count(),
            'success'  => TransactionModel::where('transaction_status','SUCCESS')->count(),
            'failed'  => TransactionModel::where('transaction_status','FAILED')->count()
        ];


        return view('pages.dashboard')->with([
            'income' => $income,
            'sales'  => $sales,
            'items'   => $items,
            'pie'    => $pie
        ]);
    }



}
