<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiApiController extends Controller
{
    public function index()
    {
        return response()->json(Transaksi::all());
    }

    public function show($id)
    {
        return response()->json(Transaksi::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_transaksi' => 'required|string|max:255|unique:transaksi,kode_transaksi',
            'user_id' => 'required|integer|exists:users,id',
            'tipe_transaksi' => 'required|string|max:50',
            'total_harga' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
            'status_pembayaran' => 'required|string|max:50',
        ]);
        $transaksi = Transaksi::create($validated);
        return response()->json($transaksi, 201);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $validated = $request->validate([
            'kode_transaksi' => 'sometimes|required|string|max:255|unique:transaksi,kode_transaksi,' . $transaksi->id,
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'tipe_transaksi' => 'sometimes|required|string|max:50',
            'total_harga' => 'sometimes|required|numeric',
            'tanggal_transaksi' => 'sometimes|required|date',
            'keterangan' => 'nullable|string',
            'status_pembayaran' => 'sometimes|required|string|max:50',
        ]);
        $transaksi->update($validated);
        return response()->json($transaksi);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return response()->json(['message' => 'Deleted']);
    }
}