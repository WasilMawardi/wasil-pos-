@extends('layout.app')

@section('title', 'Tambah Customers')

@section('content')

@if (session('pesan'))
<div class="alert alert-success">
    {{ session('pesan') }}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <center>
                    <h5>Data Customers</h5>
                </center>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama Customers</th>
                                <th scope="col">telp</th>
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
                                <td>{{ $dta->telp }}</td>
                                <td>
                                    <form action="{{ url('customers', [$dta->id] ) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                    <!-- <button type="button" class="btn btn-success ">Update</button> -->
                                    <button class="btn btn-success btn-sm " onclick="updateCustomer(this,event)" data-id="{{ $dta->id }}">Update</button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- create/update Customer -->
    <div class="col-md-6">
        <div class="card">
            <center>
                <div class="card-header">
                    <div id="header-customer" class="header-Customer">
                        Tambah Customer
                    </div>
                </div>
            </center>
            <div class="card-body">
                <form action="{{url('simpan-customer')}}" method="post">
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
                            Nama Customer :
                        </label>
                        <input class="form-control" type="text" name="nama" id="nama">
                        @error('nama')
                        <small id="nama" class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telp">
                            telp :
                        </label>
                        <input class="form-control" type="text" name="telp" id="telp">
                        @error('telp')
                        <small id="telp" class="text-danger">{{$message}}</small>

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
    // untuk mengambil data click customer
    function updateCustomer(self, e) {
        e.preventDefault()
        var id = $(self).data("id")
        $.ajax({
            type: "get",
            url: "/updateCustomer/" + id,
            dataType: "json",
            success: function(res) {
                console.log(res)
                document.getElementById("kode").value = res.customer.kode;
                document.getElementById("nama").value = res.customer.nama;
                document.getElementById("telp").value = res.customer.telp;
                document.getElementById("id").value = res.customer.id;
                document.getElementById("header-customer").innerText = "Edit Data Customer";

            }
        })
    }
</script>

@endsection