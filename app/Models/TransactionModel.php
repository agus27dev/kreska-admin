<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'transactions';
    protected $fillable = [
        'uuid','name','email','number','address','transaction_total','transaction_status'
    ];

    protected $hidden = [

    ];

    //relasi prular karena satu transaksi bisa punya banyak transaksi detail
    public function details(){
        return $this->hasMany(TransactionDetailModel::class,'transactions_id');
    }
}
