@extends('layouts.default')

@section('content')


 <div class="card">
     <div class="card-header">
         <strong>Tambah Gambar Produk</strong>
     </div>
     <div class="card-body card-block">
         <form action="{{route('product-galleries.store')}}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="form-group col-2 p-0">
                <label for="products_id" class="form-control-label">Nama Produk</label>
                <select name="products_id" class="form-control @error('products_id') is invalid @enderror">
                    @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
                @error('products_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group col-3 p-0">
                <label for="photo" class="form-control-label">Gambar Produk</label>
                <input name="photo"
                       type="file"
                       value="{{old('photo')}}"
                       accept="image/*"
                       required
                       class="form-control @error('photo') is invalid @enderror"/>
                @error('photo')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <fieldset class="form-group">
                <div class="row">
                    <label class="col-form-label col-sm-2 pt-0">Jadikan Default :</label>
                        <div class="col-sm-10 pl-0">

                            <div class="form-check form-check-inline">
                                <input name="is_default"
                                       id="inlineRadio1"
                                       type="radio"
                                       value="1"
                                       class="form-check-input @error('is_default') is invalid @enderror"/>
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input name="is_default"
                                       id="inlineRadio2"
                                       type="radio"
                                       value="0"
                                       class="form-check-input @error('is_default') is invalid @enderror"/>
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div>
                        </div>
                </div>
                @error('is_default')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </fieldset>

            <div class="form-group col-3 pt-3 pl-0">
                <button class="btn btn-success btn-block" type="submit">Tambah Gambar Produk</button>
            </div>

         </form>
     </div>
 </div>


@endsection
