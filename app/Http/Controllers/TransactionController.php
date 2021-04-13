<?php

namespace App\Http\Controllers;

use App\Models\TransactionModel;
use App\Http\Requests\TransactionRequest;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = TransactionModel::all();

        return view('pages.transactions.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionModel  $transactionModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // memanggil model transaksi dengan relasinya detail. dan juga dalam detail ada relasi product
        $item = TransactionModel::with('details.product')->findOrFail($id);

        return view('pages.transactions.show')->with([
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionModel  $transactionModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = TransactionModel::findorFail($id);

        return view('pages.transactions.edit')->with([
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionModel  $transactionModel
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $data = $request->all();

        $item = TransactionModel::findorFail($id);
        $item->update($data);
        return redirect()->route('transactions.index')->with('alert', 'Transaksi berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionModel  $transactionModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $item = TransactionModel::findorFail($id);
        $item->delete();

        return redirect()->route('transactions.index')->with('alert', 'Transaksi berhasil terhapus!');
    }

    public function setStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $item = TransactionModel::findorFail($id);
        $item->transaction_status = $request->status;
        $item->save();

        return redirect()->route('transactions.index')->with('alert', 'Status transaksi berhasil diupdate!');;
    }
}
