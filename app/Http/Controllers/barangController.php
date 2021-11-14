<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class barangController extends Controller
{
    public function index()
    {
        $data = barang::all();
        return view('barang/create', compact('data'));
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
            'harga' => 'required|numeric'

        ], $message);
        if (empty($request->id)) {

            $barang = new barang();
            $barang->kode = $request->kode;
            $barang->nama = $request->nama;
            $barang->harga = $request->harga;
            $barang->save();
        } else {
            $barangs = barang::where('id', $request->id)->first();
            $barangs->kode = $request->kode;
            $barangs->nama = $request->nama;
            $barangs->harga = $request->harga;
            $barangs->update();
        }

        return redirect('/TambahBarang')->with('pesan', 'Data berhasil ditambahkan');
    }
    public function destroy($id)
    {
        // dd($id);
        $hapus = barang::where('id', $id)->first();
        $hapus->delete();
        return redirect('/TambahBarang');
    }
    public function update($id)
    {
        $id_baru = intval($id);
        $barang = barang::where('id', $id_baru)->first();

        return response()->json([
            'barang' => $barang,
        ], 200);
    }
}
