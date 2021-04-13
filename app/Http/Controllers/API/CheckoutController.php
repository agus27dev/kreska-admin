<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Http\Requests\API\CheckoutRequest;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request){

        $data = $request->except('transaction_details');
        $data['uuid'] = 'TRX' . mt_rand(10000, 99999) . mt_rand(100,999);

        $transaction = TransactionModel::create($data);

        foreach ($request->transaction_details as $product){

            $details[] = new TransactionDetailModel([
                'transactions_id' => $transaction->id,
                'products_id'     => $product,
            ]);

            //mengurangi jumlah produk
            ProductModel::find($product)->decrement('quantity');
        }

        //details() = relasi. code ini menyimpan ke model transaksi yang berelasi dengan transaksi details
        $transaction->details()->saveMany($details);

        return ResponseFormatter::success($transaction);

    }
}
