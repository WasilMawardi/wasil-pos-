<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function index()
    {
        $data = customer::all();
        // dd($data);
        return view('customer.create', compact('data'));
    }
    public function simpan(Request $request)
    {
        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',

        ];
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'telp' => 'required|numeric'

        ], $message);
        if (empty($request->id)) {

            $customer = new customer();
            $customer->kode = $request->kode;
            $customer->nama = $request->nama;
            $customer->telp = $request->telp;
            $customer->save();
        } else {
            $customers = customer::where('id', $request->id)->first();
            $customers->kode = $request->kode;
            $customers->nama = $request->nama;
            $customers->telp = $request->telp;
            $customers->update();
        }

        return redirect('/customer')->with('pesan', 'Data berhasil ditambahkan');
    }
    public function destroy($id)
    {
        // dd($id);
        $hapus = customer::where('id', $id)->first();
        $hapus->delete();
        return redirect('/customer');
    }
    public function update($id)
    {
        $id_baru = intval($id);
        $customer = customer::where('id', $id_baru)->first();

        return response()->json([
            'customer' => $customer,
        ], 200);
    }
}
