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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <b>
                                                Kode
                                            </b>

                                        </div>
                                        <div class="col-md-4">
                                            <b>nama</b>
                                        </div>
                                        <div class="col-md-4">
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
                                                {{$cst->harga}}
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
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>