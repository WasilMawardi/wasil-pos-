<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\customer;
use App\Models\sales;
use App\Models\sales_det;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{

    public function index()
    {
        if (!empty(sales::all())) {
            $id_transaksi = 0;
        } else {

            $id_transaksi = sales::all()->last()->id;
        }

        $total  = DB::table('t_sales_det')
            ->where('sales_id', null)
            ->select(DB::raw('SUM(total) as total_sales'))
            ->get();
        $subtotal = $total[0]->total_sales;
        $sales_det = sales_det::where('sales_id', null)->get();

        $barang = barang::all();
        $customer = customer::all();

        if (!empty($sales_det)) {

            return view('dashboard.pembelian', compact('barang', 'customer', 'sales_det', 'subtotal', 'id_transaksi'));
        } else {
            return view('dashboard.pembelian', compact('barang', 'customer'));
        }
    }
    public function detail($id)
    {

        $id_baru = intval($id);
        $barang = barang::where('id', $id_baru)->first();

        return response()->json([
            'barang' => $barang,
        ], 200);
    }
    public function details($id)
    {

        $id_baru = intval($id);
        $customer = customer::where('id', $id_baru)->first();

        return response()->json([
            'customer' => $customer,
        ], 200);
    }
    public function update($id)
    {

        $id_baru = intval($id);
        $sales_det = sales_det::where('id', $id_baru)->first();

        $barang = barang::where('id', $sales_det->barang_id)->first();
        $sales_det->delete();

        return response()->json([
            'barang' => $barang,
        ], 200);
    }

    public function destroy($id)
    {

        $sales_det = sales_det::where('id', $id)->first();
        $sales_det->delete();
        return redirect('/dashboard')->with('pesan', 'berhasil ditambahkan');
    }
}
