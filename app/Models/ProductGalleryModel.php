<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGalleryModel extends Model
{
    use HasFactory;
    use SoftDeletes;

     //mass asignment
    protected $table = 'product_galleries';
    protected $fillable = [
        'products_id','photo','is_default'
    ];

    //file yg ingin disembunyikan
    protected $hidden = [

    ];

    //relasi tabel
    //pakai singular karena satu foto hanya dimiliki satu galeri
    public function product(){
        return $this->belongsTo(ProductModel::class, 'products_id', 'id');
    }

    //accessor
    public function getphotoAttribute($value){
        return url('storage/' . $value);
    }
}
