<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;

class DetailTransaksiApiController extends Controller
{
    public function index()
    {
        return response()->json(DetailTransaksi::all());
    }

    public function show($id)
    {
        return response()->json(DetailTransaksi::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaksi_id' => 'required|integer|exists:transaksi,id',
            'barang_id' => 'required|integer|exists:produk,id',
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);
        $detail = DetailTransaksi::create($validated);
        return response()->json($detail, 201);
    }

    public function update(Request $request, $id)
    {
        $detail = DetailTransaksi::findOrFail($id);
        $validated = $request->validate([
            'transaksi_id' => 'sometimes|required|integer|exists:transaksi,id',
            'barang_id' => 'sometimes|required|integer|exists:produk,id',
            'jumlah' => 'sometimes|required|integer',
            'harga_satuan' => 'sometimes|required|numeric',
            'subtotal' => 'sometimes|required|numeric',
            'keterangan' => 'nullable|string',
        ]);
        $detail->update($validated);
        return response()->json($detail);
    }

    public function destroy($id)
    {
        $detail = DetailTransaksi::findOrFail($id);
        $detail->delete();
        return response()->json(['message' => 'Deleted']);
    }
}