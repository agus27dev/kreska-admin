<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetailModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'transaction_details';
    protected $fillable = [
        'transactions_id','products_id'
    ];

    protected $hidden = [

    ];

    public function transaction(){
        return $this->belongsTo(TransactionModel::class,'transactions_id','id');
    }

    public function product(){
        return $this->belongsTo(ProductModel::class,'products_id','id');
    }
}
