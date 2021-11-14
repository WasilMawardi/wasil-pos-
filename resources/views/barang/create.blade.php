@extends('layout.app')

@section('title', 'Tambah Barang')

@section('content')

@if (session('pesan'))
<div class="alert alert-success">
    {{ session('pesan') }}
</div>
@endif

<div class="row">
    <div class="col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-header">
                <center>
                    <h5>Data Barang</h5>
                </center>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">
                                    <center> Aksi </center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($data as $dta)
                            <tr>
                                <th scope="row"> {{ $no++ }} </th>
                                <td>{{ $dta->kode }}</td>
                                <td>{{ $dta->nama }}</td>
                                <td>{{ $dta->harga }}</td>
                                <td>
                                    <form action="{{ url('barangs', [$dta->id] ) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                    <!-- <button type="button" class="btn btn-success ">Update</button> -->
                                    <button class="btn btn-success btn-sm " onclick="updateBarang(this,event)" data-id="{{ $dta->id }}">Update</button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- create/update barang -->
    <div class="col-md-6 col-sm-12 col-12">
        <div class="card">
            <center>
                <div class="card-header">
                    <div id="header-barang" class="header-barang">
                        Tambah Barang
                    </div>
                </div>
            </center>
            <div class="card-body">
                <form action="{{url('simpan-barang')}}" method="post">
                    @csrf

                    <input type="text" name="id" id="id" hidden>
                    <div class="form-group">
                        <label for="kode">
                            Kode :
                        </label>
                        <input class="form-control" type="text" name="kode" id="kode">
                        @error('kode')
                        <small id="kode" class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">
                            Nama Barang :
                        </label>
                        <input class="form-control" type="text" name="nama" id="nama">
                        @error('nama')
                        <small id="nama" class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga">
                            Harga :
                        </label>
                        <input class="form-control" type="text" name="harga" id="harga">
                        @error('harga')
                        <small id="harga" class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    // untuk mengambil data click barang
    function updateBarang(self, e) {
        e.preventDefault()
        var id = $(self).data("id")
        $.ajax({
            type: "get",
            url: "/updateBarang/" + id,
            dataType: "json",
            success: function(res) {
                console.log(res)
                document.getElementById("kode").value = res.barang.kode;
                document.getElementById("nama").value = res.barang.nama;
                document.getElementById("harga").value = res.barang.harga;
                document.getElementById("id").value = res.barang.id;
                document.getElementById("header-barang").innerHTML = "Edit Data Barang";

            }
        })
    }
</script>

@endsection