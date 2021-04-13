@extends('layouts.default')

@section('content')


 <div class="card">
     <div class="card-header">
         <strong>Update Transaksi</strong>
         <br>
         <small>--<b>{{$item->uuid}}</b>--</small>
     </div>
     <div class="card-body card-block">
         <form action="{{route('transactions.update',$item->id)}}" method="POST">

            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="name" class="form-control-label">Nama</label>
                <input name="name"
                       type="text"
                       value="{{old('name') ? old('name') : $item->name}}"
                       class="form-control @error('name') is invalid @enderror"/>
                @error('name')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-control-label">Email</label>
                <input name="email"
                       type="text"
                       value="{{old('email') ? old('email') : $item->email}}"
                       class="form-control @error('email') is invalid @enderror"/>
                @error('email')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="number" class="form-control-label">Nomor</label>
                <input name="number"
                       type="number"
                       value="{{old('number') ? old('number') : $item->number}}"
                       class="form-control @error('number') is invalid @enderror"/>
                @error('number')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address" class="form-control-label">Alamat</label>
                <input name="address"
                       type="text"
                       value="{{old('address') ? old('address') : $item->address}}"
                       class="form-control @error('address') is invalid @enderror"/>
                @error('address')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group col-3 pt-3 pl-0 text-left">
                <button class="btn btn-primary btn-block" type="submit">Update Transaksi</button>
            </div>

         </form>
     </div>
 </div>


@endsection
