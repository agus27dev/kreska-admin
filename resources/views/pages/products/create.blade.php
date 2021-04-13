@extends('layouts.default')

@section('content')


 <div class="card">
     <div class="card-header">
         <strong>Tambah Produk</strong>
     </div>
     <div class="card-body card-block">
         <form action="{{route('products.store')}}" method="POST">

            @csrf

            <div class="form-group">
                <label for="name" class="form-control-label">Nama Produk</label>
                <input name="name"
                       type="text"
                       value="{{old('name')}}"
                       class="form-control @error('name') is invalid @enderror"/>
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group col-2 p-0">
                <label for="type" class="form-control-label">Tipe Produk</label>
                <select name="type" class="form-control @error('type') is invalid @enderror">
                    <option value="">--Pilih Tipe--</option>
                    @foreach ($types = ['desain','foto&video','reparasi'] as $type)
                        <option value="{{$type}}" {{old('type') == $type ? 'selected' : ''}} >{{$type}}</option>
                    @endforeach

                    {{-- <option value="desain" {{old('type') == "desain" ? 'selected' : ''}}>desain</option>
                    <option value="foto&video" {{old('type') == "foto&video" ? 'selected' : ''}}>foto&video</option>
                    <option value="reparasi" {{old('type') == "reparasi" ? 'selected' : ''}}>reparasi</option> --}}
                </select>
                @error('type')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-control-label">Deskripsi</label>
                <textarea name="description"
                          class="form-control @error('description') is invalid @enderror">{{old('description')}}</textarea>
                @error('description')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group col-3 p-0">
                <label for="price" class="form-control-label">Harga Produk</label>
                <input name="price"
                       type="number"
                       min="0"
                       value="{{old('price')}}"
                       class="form-control @error('price') is invalid @enderror"/>
                @error('price')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group col-3 p-0">
                <label for="quantity" class="form-control-label">Jumlah Produk Tersedia</label>
                <input name="quantity"
                       type="number"
                       min="0"
                       step="1"
                       value="{{old('quantity')}}"
                       class="form-control @error('quantity') is invalid @enderror"/>
                @error('quantity')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group col-2 pt-3 pl-0 text-left">
                <button class="btn btn-success btn-block" type="submit">Tambah Produk</button>
            </div>

         </form>
     </div>
 </div>


@endsection
