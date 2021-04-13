<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function all(Request $request){

        $id         = $request->input('id');
        $name       = $request->input('name');
        $slug       = $request->input('slug');
        $type       = $request->input('type');
        $limit      = $request->input('limit', 6);
        $price_from = $request->input('price_from');
        $price_to   = $request->input('price_to');

        //slug dan id hanya menampilkan satu data

        if($id){

            $product = ProductModel::with('galleries')->find($id);

            if($product)
                return ResponseFormatter::success($product, 'Data Produk Berhasil Diambil');
            else
                return ResponseFormatter::eror(null, 'Data Produk Tidak Ada', 404);
        }

        if($slug){

            //slug pakai where karena bukan primary key

            $product = ProductModel::with('galleries')
                    ->where('slug', $slug)
                    ->first();

            if($product)
                return ResponseFormatter::success($product, 'Data Produk Berhasil Diambil');
            else
                return ResponseFormatter::eror(null, 'Data Produk Tidak Ada', 404);

        }

        // ini query untuk menampilkan yang banyak data atau filtrasi

        $product = ProductModel::with('galleries');


        switch ($product) {
            case ($name == true):
                $product->where('name','like', '%' . $name . '%');
                if($product->count()>0)
                    return ResponseFormatter::success(
                        $product->paginate($limit),
                        'Data Produk Berhasil Diambil'
                    );
                else
                    return ResponseFormatter::eror(null, 'Data Produk Tidak Ada', 404);
                break;

            case ($type == true):
                $product->where('name','like', '%' . $type . '%');
                if($product->count()>0)
                    return ResponseFormatter::success(
                        $product->paginate($limit),
                        'Data Produk Berhasil Diambil'
                    );
                else
                    return ResponseFormatter::eror(null, 'Data Produk Tidak Ada', 404);
                break;

            case ($price_from == true):
                $product->where('price','>=', $price_from);
                if($product->count()>0)
                    return ResponseFormatter::success(
                        $product->paginate($limit),
                        'Data Produk Berhasil Diambil'
                    );
                else
                    return ResponseFormatter::eror(null, 'Data Produk Tidak Ada', 404);
                break;

            case ($price_to == true):
                $product->where('price','<=', $price_to);
                if($product->count()>0)
                    return ResponseFormatter::success(
                        $product->paginate($limit),
                        'Data Produk Berhasil Diambil'
                    );
                else
                    return ResponseFormatter::eror(null, 'Data Produk Tidak Ada', 404);
                break;

            default:

                return ResponseFormatter::success(
                    $product->paginate($limit),
                    'Data Produk Berhasil Diambil'
                );

                break;
        }


        // if($name)
        //     $product->where('name','like', '%' . $name . '%');

        // if($type)
        //     $product->where('type', 'like', '%' . $type . '%');

        // if($price_from)
        //     $product->where('price','>=', $price_from);

        // if($price_to)
        //     $product->where('price','<=', $price_to);

        // return ResponseFormatter::success(
        //     $product->paginate($limit),
        //     'Data Produk Berhasil Diambil'
        // );

    }


}
