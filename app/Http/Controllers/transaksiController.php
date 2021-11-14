<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\sales;
use App\Models\sales_det;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class transaksiController extends Controller
{
    public function index()
    {

        // $posts = sales::with('customer', 'barang')->get();

        $data = sales::all();
        // foreach ($data as $dta) {

        //     dd($dta->sales_det);
        // }


        return view('transaksi.index', compact('data'));
    }
    public function pesan(Request $request)
    {
        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',

        ];
        $request->validate([
            'qty' => 'required|numeric',
            'id' => 'required'

        ], $message);

        $barang = barang::where('id', $request->id)->first();

        // cek apakah ada diskon atau tidak
        if (!empty($request->diskon_pct)) {
            $diskon = $request->diskon_pct;
            $diskon_pct = intval($diskon);
        } else {
            $diskon_pct = 0;
        }

        // menghitung diskon dalam rupiah
        $diskon_rupiah = ($diskon_pct / 100) * $barang->harga;
        // menghitung harga diskon
        $harga_diskon =  $barang->harga - $diskon_rupiah;


        // dd($request, $diskon_pct);

        //masukan ke Table sales_det
        $pesanan = new sales_det();
        $pesanan->sales_id = null;
        $pesanan->barang_id = $request->id;
        $pesanan->harga_bandrol = $barang->harga;
        $pesanan->qty = $request->qty;
        $pesanan->diskon_pct = $diskon_pct;
        $pesanan->diskon_nilai = $diskon_rupiah;
        $pesanan->harga_diskon = $harga_diskon;
        $pesanan->total = $request->qty * $harga_diskon;
        $pesanan->save();

        return redirect('/dashboard');
    }
    public function simpan(Request $request)
    {
        // dd($request);

        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',

        ];
        $request->validate([
            'cust_id' => 'required'

        ], $message);
        $id = DB::table('t_sales')
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->first();
        if (empty($id)) {
            $id = 1;
            // dd($id);
        } else {
            $id = $id->id + 1;
        }
        // dd($id->id);
        // dd($kode);
        $tgl = date("d-M-Y", strtotime(date('M d y')));


        // dd($tgl);



        //masukan ke Table sales
        // $pesanan = new sales();
        $kode = date("Ym" . "-000" . $id);
        // dd(sales::all(), $request->onkir);
        $sales = sales::create([
            'kode' => $kode,
            'tgl' => Carbon::now(),
            'cust_id' => $request->cust_id,
            'subtotal' => $request->subtotal,
            'diskon' => $request->diskon,
            'onkir' => $request->onkir,
            'total_bayar' => $request->total_bayar
        ]);
        $salesDetails = sales_det::where('sales_id', null)->get();
        foreach ($salesDetails as  $details) {
            // dd($details);
            sales_det::where('sales_id', null)
                ->update(['sales_id' => $sales->id]);
            // $details->update([
            //     'sales_id' => $sales->id
            // ]);

            // $details->sales_id = $sales->id;
            // $details->save();
        }

        // $pesanan->kode = $kode;
        // $pesanan->tgl = Carbon::now();
        // $pesanan->cust_id = $request->cust_id;
        // $pesanan->subtotal = $request->subtotal;
        // $pesanan->diskon = $request->diskon;
        // $pesanan->onkir = $request->onkir;
        // $pesanan->total_bayar = $request->total_bayar;
        // $pesanan->save();




        return redirect('/dashboard')->with('pesan', 'data berhasil ditambahkan');
    }
}
