<div class="modal fade" id="barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <button style="border-style: outset;" class="list-group-item list-group-item-action">
                    <div class="row">
                        <div class="col-md-4">
                            <b>
                                Nama Barang
                            </b>

                        </div>
                        <div class="col-md-4">
                            <b>harga</b>
                        </div>
                        <div class="col-md-4">
                            <b>Stok</b>
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
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>