@extends('layout.app')

@section('title', 'Riwayat transaki')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>
            <center>Riwayat Transaksi</center>
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">No Transaksi</th>
                        <th scope="col">Tanggal </th>
                        <th scope="col"> Nama Customer</th>
                        <th scope="col"> Jumlah Barang</th>
                        <th scope="col"> Sub Total</th>
                        <th scope="col"> Diskon</th>
                        <th scope="col"> Onkir</th>
                        <th scope="col"> Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($data as $dta)
                    <tr>
                        <th scope="row"> {{ $no++ }} </th>
                        <td>{{$dta->kode}}</td>
                        <td>{{$dta->tgl}}</td>
                        <td>{{$dta->customer->nama}}</td>
                        <td>
                            @foreach ($dta->sales_det as $sales)
                            @endforeach
                            <center>
                                {{$sales->where('sales_id',$dta->id)->sum('qty')}}
                            </center>
                        </td>
                        <td>{{number_format($dta->subtotal)}}</td>
                        <td>{{number_format($dta->diskon)}}</td>
                        <td>{{number_format($dta->onkir)}}</td>
                        <td>{{number_format($dta->total_bayar)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection