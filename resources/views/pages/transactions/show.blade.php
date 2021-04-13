<table class="table table-bordered">

    <tr>
        <th>Nama</th>
            <td>{{$item->name}}</td>
    </tr>

    <tr>
        <th>Email</th>
            <td>{{$item->email}}</td>
    </tr>

    <tr>
        <th>Nomor</th>
            <td>{{$item->number}}</td>
    </tr>

    <tr>
        <th>Alamat</th>
            <td>{{$item->address}}</td>
    </tr>

    <tr>
        <th>Total Transaksi</th>
            <td>{{$item->transaction_total}}</td>
    </tr>

    <tr>
        <th>Status</th>
            <td>{{$item->transaction_status}}</td>
    </tr>

    <tr>
        <th>Pembelian Produk</th>
            <td>
                <table class="table table-bordered w-100">
                    <tr>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Harga</th>
                    </tr>
                    @foreach ($item->details as $detail)
                    <tr>
                        <td>{{$detail->product->name}}</td>
                        <td>{{$detail->product->type}}</td>
                        <td>Rp{{number_format($detail->product->price,2,",",".")}}</td>
                    </tr>
                    @endforeach
                </table>
            </td>
    </tr>

    <tr>
        <th>Set Status Transaksi</th>
            <td>
                <div class="row">
                    <div class="col-4">
                        <a href="{{route('transactions.status',$item->id)}}?status=PENDING" class="btn btn-secondary btn-block">
                            <i class="fa fa-clock-o"></i> Set Tertunda
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{route('transactions.status',$item->id)}}?status=SUCCESS" class="btn btn-success btn-block">
                            <i class="fa fa-check"></i> Set Sukses
                        </a>
                    </div>

                    <div class="col-4">
                        <a href="{{route('transactions.status',$item->id)}}?status=FAILED" class="btn btn-danger btn-block">
                            <i class="fa fa-times"></i> Set Gagal
                        </a>
                    </div>
                </div>
            </td>
    </tr>



</table>

