<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\ProductGalleryModel;
use App\Models\ProductModel;
use illuminate\Support\Str;

class ProductController extends Controller
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
        $items = ProductModel::all();

        return view('pages.products.index')->with([
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug']= Str::slug($request->name);

        ProductModel::create($data);
        return redirect()->route('products.index')->with('alert', 'Produk berhasil di tambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function show(ProductModel $productModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ProductModel::findorFail($id);
        return view('pages.products.edit')->with([
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug']= Str::slug($request->name);

        $item = ProductModel::findorFail($id);
        $item->update($data);
        return redirect()->route('products.index')->with('alert', 'Produk berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductModel::findorFail($id);
        $item->delete();

        return redirect()->route('products.index')->with('alert', 'Produk berhasil terhapus!');
    }

    public function gallery(Request $request, $id)
    {
        $product = ProductModel::findorFail($id);
        $items = ProductGalleryModel::with('product')->where(
            'products_id', $id
        )->get();

        return view('pages.products.gallery')->with([
            'product' => $product,
            'items'   => $items
        ]);

    }
}
