@extends('layout.app')

@section('title', 'Dashboard')

@section('content')

<!-- alert masuk data -->
@if (session('pesan'))
<div class="alert alert-success">
    {{ session('pesan') }}
</div>
@endif

@error('cust_id')
<div class="alert alert-warning" role="alert">
    <center>
        Pilih customer !
    </center>
</div>

@enderror

<div class="row">

    <!-- Card Transaksi -->
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3>
                    Transaksi
                </h3>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <!-- <label for="Customer">Pilih Customer :</label> -->
                    <!-- Button trigger modal -->
                    @error('id')
                    <div class="alert alert-warning" role="alert">
                        <center>
                            Pilih barang !
                        </center>
                    </div>

                    @enderror
                    <center>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#barang">
                            Pilih Barang
                        </button>
                        <br>
                    </center>
                    <!-- <small id="name" class="form-text text-muted">masukan nama barang</small> -->

                    @error('no')
                    <small id="no" class="text-danger">{{$message}}</small>

                    @enderror
                </div>
                <div class="table-responsive">
                    <table class="table ">
                        <tbody>

                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td id="nama"> </td>
                            </tr>
                            <tr>
                                <td>harga</td>
                                <td>:</td>
                                <td id="harga">Rp. </td>
                            </tr>
                            <tr>
                                <td>kode</td>
                                <td>:</td>
                                <td id="kode"></td>

                            </tr>
                            <tr>
                                <td>QTY</td>
                                <td>:</td>
                                <td>
                                    <form action="{{url('pesan')}}" method="post">
                                        @csrf
                                        <input type="text" id="id" name="id" class="form-control" hidden>
                                        <input type="text" id="customer_id" name="customer_id" class="form-control" hidden>
                                        <div class="input-group mb-3">
                                            <input type="text" name="qty" class="form-control">
                                        </div>
                                        @error('qty')
                                        <small id="name" class="text-danger">{{$message}}</small> <br>

                                        @enderror
                                        <div class="input-group" style=" width: 100px;">
                                            <div class=" input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">%</span>
                                            </div>
                                            <input type="text" class="form-control " name="diskon_pct" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted">Masukan Diskon Jika ada .</small>


                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-shopping-cart"></i> pesan</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>



    <!-- Menu Checkout -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3>Check Out</h3>
                <div class="col-sm-6 form-group float-right">
                    <label for="no">No : {{ $id_transaksi+1 }} </label>
                    <input type="text" hidden class="form-control @error('no') is-invalid @enderror " name="no" id="no">
                    <br>
                    <label for="tanggal">Tanggal :
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror " name="tanggal" id="no" value="<?= date("Y-m-d") ?>">
                    </label>
                    <!-- <small id="name" class="form-text text-muted">masukan nama barang</small> -->

                    @error('tanggal')
                    <small id="tanggal" class="text-danger">{{$message}}</small>

                    @enderror

                    <!-- <small id="name" class="form-text text-muted">masukan nama barang</small> -->

                </div>


                <div class="col-sm-6 form-group">
                    <label for="Customer"> Customer : <p id="customers"> </p> </label>
                    <!-- Button trigger modal -->
                    <br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#customer">
                        Pilih Customer
                    </button>
                    <!-- <small id="name" class="form-text text-muted">masukan nama barang</small> -->


                </div>
                @error('cust_id')
                <div class="alert alert-warning" role="alert">
                    <center>
                        Pilih customer !
                    </center>
                </div>

                @enderror
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <td><b>no</b></td>
                                <td> <b> Kode Barang</b></td>
                                <td> <b> Nama barang</b></td>
                                <td> <b> QTY</b></td>
                                <td> <b> Harga Bandrol</b></td>
                                <td colspan="2"> <b>
                                        <center>diskon </center>
                                    </b>
                                </td>
                                <td> <b> Harga diskon</b></td>
                                <td> <b> total</b></td>
                                <td> <b> aksi</b></td>

                            </tr>

                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($sales_det as $sls)

                            <tr>


                                <td> {{$no++}}</td>

                                <td> {{ $sls->barang['kode'] }} </td>
                                <td>{{ $sls->barang['nama'] }}</td>
                                <td>{{ $sls->qty }} </td>
                                <td>Rp. {{ number_format($sls->harga_bandrol) }} </td>
                                <td>{{ round($sls->diskon_pct) }} % </td>
                                <td>Rp. {{ number_format($sls->diskon_nilai) }} </td>
                                <td>Rp. {{ number_format($sls->harga_diskon) }} </td>
                                <td>Rp. {{ number_format($sls->total) }} </td>
                                <td>
                                    <form action="{{ url('dboard', [$sls->id] ) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="text" name="keuntungan" value=" " hidden>
                                        <button type="submit" class="btn btn-danger ">Delete</button>
                                    </form>
                                    <br>
                                    <!-- <button type="button" class="btn btn-success ">Update</button> -->
                                    <button class="btn btn-success " onclick="update(this,event)" data-id="{{ $sls->id }}">Update</button>
                                </td>

                            </tr>
                            @endforeach


                        </tbody>

                        <form action="{{url('simpan')}}" method="post">
                            @csrf
                            <tr>
                                <td colspan="8" align="right"><strong> Sub Total :</strong></td>
                                <td> Rp. {{ number_format($subtotal) }} </td>
                                <input type="text" id="subtotal" name="subtotal" value="{{$subtotal}}" hidden>
                                <td></td>

                            </tr>
                            <tr>
                                <!-- id Customer -->
                                <td colspan="7"></td>
                                <td>Diskon </td>
                                <td>
                                    <input onkeyup="myFunction()" type="text" name="diskon" id="diskon" value="0" class="form-control"> <br>
                                    @error('diskon')
                                    <small id="name" class="text-danger">{{$message}}</small> <br>

                                    @enderror
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="7"></td>
                                <td>Onkir </td>
                                <td>
                                    <input onkeyup="myFunction()" type="text" name="onkir" id="onkir" value="0" class="form-control"> <br>
                                    @error('onkir')
                                    <small id="name" class="text-danger">{{$message}}</small> <br>
                                    @enderror
                                </td>
                                <td></td>
                            </tr>
                            <tr>

                                <td colspan="5"></td>
                                <td>Total
                                </td>
                                <td>
                                    Bayar</td>
                                <td>Rp .
                                </td>
                                <td>

                                    <input class="form-control input-sm" type="text" name="total_bayars" id="total_bayars" disabled>
                                    <input class="form-control" type="text" name="total_bayar" id="total_bayar" hidden>
                                </td>
                                <td>
                                    <input type="text" name="cust_id" id="cust_id" hidden>
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Simpan
                                    </button>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>













<!-- Modal Customer -->
<div class="modal fade" id="customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <button style="border-style: outset;" class="list-group-item list-group-item-action">
                                    <div class=" d-flex flex-row">
                                        <div class="col-md-4 p2">
                                            <b>
                                                Kode
                                            </b>

                                        </div>
                                        <div class="col-md-4 p2">
                                            <b>nama</b>
                                        </div>
                                        <div class="col-md-4 p2">
                                            <b>Telp</b>
                                        </div>
                                    </div>
                                </button>
                                <hr>
                            </thead>
                            <tbody>
                                @foreach($customer as $cst)
                                <tr>
                                    <button class="list-group-item list-group-item-action" onclick="details(this,event)" data-id="{{ $cst->id }}" data-dismiss="modal">
                                        <div class=" d-flex flex-row">
                                            <div class="col-md-4 p2">
                                                {{$cst->kode}}
                                            </div>
                                            <div class=" col-md-4 p2">
                                                {{$cst->nama}}
                                            </div>
                                            <div class="col-md-4 p2">
                                                {{$cst->telp}}
                                            </div>
                                        </div>

                                    </button>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-primary" href="{{url('customer')}}"> Tambah Customer</a>
            </div>
        </div>
    </div>
</div>




<!-- Modal Barang -->
<div class="modal fade" id="barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <button style="border-style: outset;" class="list-group-item list-group-item-action">
                    <div class=" d-flex flex-row">
                        <div class="col-md-4 p2">
                            <b>
                                Kode
                            </b>

                        </div>
                        <div class="col-md-4 p2">
                            <b> Nama</b>
                        </div>
                        <div class="col-md-4 p2">
                            <b>Harga</b>
                        </div>
                    </div>
                </button>
                <hr>

                @foreach ($barang as $brg)
                <button class="list-group-item list-group-item-action" onclick="detail(this,event)" data-id="{{ $brg->id }}" data-dismiss="modal">

                    <div class=" d-flex flex-row">
                        <div class="col-md-4 p2">
                            {{$brg->kode}}
                        </div>
                        <div class=" col-md-4 p2">
                            {{$brg->nama}}
                        </div>
                        <div class="col-md-4 p2">
                            {{$brg->harga}}
                        </div>
                    </div>

                </button>
                @endforeach

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-primary" href="{{url('TambahBarang')}}"> Tambah Barang</a>
            </div>
        </div>
    </div>
</div>





<script>
    // untuk mengambil data click barang
    function detail(self, e) {
        e.preventDefault()
        var id = $(self).data("id")
        $.ajax({
            type: "get",
            url: "/detail/" + id,
            dataType: "json",
            success: function(res) {
                // console.log(res)
                document.getElementById("nama").innerHTML = res.barang.nama;
                document.getElementById("harga").innerHTML = "Rp." + res.barang.harga;
                document.getElementById("kode").innerHTML = res.barang.kode;
                document.getElementById("id").value = res.barang.id;
            }
        })
    }

    // untuk mengambil data click customer
    function details(self, e) {
        e.preventDefault()
        var id = $(self).data("id")
        $.ajax({
            type: "get",
            url: "/details/" + id,
            dataType: "json",
            success: function(res) {
                // console.log(res)
                document.getElementById("customers").innerHTML = res.customer.nama;
                document.getElementById("customer_id").value = res.customer.id;
                document.getElementById("cust_id").value = res.customer.id;

            }
        })
    }
    // untuk mengambil data click customer
    function update(self, e) {
        e.preventDefault()
        var id = $(self).data("id")
        $.ajax({
            type: "get",
            url: "/update/" + id,
            dataType: "json",
            success: function(res) {
                console.log(res)
                document.getElementById("nama").innerHTML = res.barang.nama;
                document.getElementById("harga").innerHTML = "Rp." + res.barang.harga;
                document.getElementById("kode").innerHTML = res.barang.kode;
                document.getElementById("id").value = res.barang.id;

            }
        })
    }


    // untuk auto output hasil dari diskon dan onkir
    function myFunction() {

        var subtotal = document.getElementById('subtotal').value;
        var diskon = document.getElementById('diskon').value;
        var onkir = document.getElementById('onkir').value;
        var bayar = document.getElementById('total_bayar');


        var tambah = parseInt(subtotal) + parseInt(onkir.length > 0 ? onkir : 0);
        var kurang = tambah - parseInt(diskon.length > 0 ? diskon : 0);

        // mengubah menjadi tampilan rupia rupiah
        var value = (kurang).toLocaleString(
            undefined, {
                minimumFractionDigits: 2
            }
        );
        document.getElementById('total_bayars').value = value;
        document.getElementById('total_bayar').value = kurang;


    }

    // menampilkan fungsi dari diskon dan onkir
    document.addEventListener("DOMContentLoaded", function(event) {
        myFunction();
    });
</script>
@endsection