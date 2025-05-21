<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PenyesuaianStok;
use Illuminate\Http\Request;

class PenyesuaianStokApiController extends Controller
{
    public function index()
    {
        return response()->json(PenyesuaianStok::all());
    }

    public function show($id)
    {
        return response()->json(PenyesuaianStok::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|integer|exists:produk,id',
            'user_id' => 'required|integer|exists:users,id',
            'tipe_penyesuaian' => 'required|string|max:50',
            'jumlah_perubahan' => 'required|integer',
            'keterangan' => 'nullable|string',
            'tanggal_penyesuaian' => 'required|date',
        ]);
        $penyesuaian = PenyesuaianStok::create($validated);
        return response()->json($penyesuaian, 201);
    }

    public function update(Request $request, $id)
    {
        $penyesuaian = PenyesuaianStok::findOrFail($id);
        $validated = $request->validate([
            'barang_id' => 'sometimes|required|integer|exists:produk,id',
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'tipe_penyesuaian' => 'sometimes|required|string|max:50',
            'jumlah_perubahan' => 'sometimes|required|integer',
            'keterangan' => 'nullable|string',
            'tanggal_penyesuaian' => 'sometimes|required|date',
        ]);
        $penyesuaian->update($validated);
        return response()->json($penyesuaian);
    }

    public function destroy($id)
    {
        $penyesuaian = PenyesuaianStok::findOrFail($id);
        $penyesuaian->delete();
        return response()->json(['message' => 'Deleted']);
    }
}