<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    //mass asignment
    protected $table = 'products';
    protected $fillable = [
        'name', 'type', 'description', 'price', 'slug', 'quantity'
    ];

    //file yg ingin disembunyikan
    protected $hidden = [

    ];

    //relasi tabel
    //pakai nama prular karena satu product bisa punya banyak galleri/foto
    public function galleries(){
        return $this->hasMany(ProductGalleryModel::class, 'products_id');
    }
}
