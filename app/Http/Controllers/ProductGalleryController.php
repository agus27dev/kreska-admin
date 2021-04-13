<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\ProductGalleryModel;
use Illuminate\Http\Request;
use App\Http\Requests\ProductGalleryRequest;

class ProductGalleryController extends Controller
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
        // memanggil relasi
        $items = ProductGalleryModel::with('product')->get();

        return view('pages.product-galleries.index')->with([
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
        $products = ProductModel::all();

        return view('pages.product-galleries.create')->with([
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();
        $data['photo']= $request->file('photo')->store(
            'assets/product', 'public'
        );

        ProductGalleryModel::create($data);
        return redirect()->route('product-galleries.index')->with('alert', 'Gambar Produk berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductGalleryModel  $productGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGalleryModel $productGalleryModel)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductGalleryModel  $productGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductGalleryModel $productGalleryModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductGalleryModel  $productGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductGalleryModel $productGalleryModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductGalleryModel  $productGalleryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductGalleryModel::findorFail($id);
        $item->delete();

        return redirect()->route('product-galleries.index')->with('alert', 'Gambar Produk berhasil terhapus!');
    }
}
