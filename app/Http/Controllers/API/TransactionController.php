<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionModel;

class TransactionController extends Controller
{
    public function get(Request $request, $id){

        //nunjuk ke relasi
        $product = TransactionModel::with(['details.product'])->find($id);

        if($product)
            return ResponseFormatter::success($product, 'Data Transaksi Berhasil Diambil');
        else
            return ResponseFormatter::eror(null, 'Data Transaksi Tidak Ada', 404);
    }
}
