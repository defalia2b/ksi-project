<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use App\Helpers\EncryptionHelper;

class DetailTransaksiApiController extends Controller
{
    public function index()
    {
        $details = DetailTransaksi::all();
        $responseData = [
            'message' => 'Success',
            'data' => $details,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function show($id)
    {
        $detail = DetailTransaksi::findOrFail($id);
        $responseData = [
            'message' => 'Success',
            'data' => $detail,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaksi_id' => 'required|integer|exists:transaksis,id',
            'barang_id' => 'required|integer|exists:produks,id',
            'jumlah' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);
        $detail = DetailTransaksi::create($validated);
        $responseData = [
            'message' => 'Detail transaksi created successfully',
            'data' => $detail,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse], 201);
    }

    public function update(Request $request, $id)
    {
        $detail = DetailTransaksi::findOrFail($id);
        $validated = $request->validate([
            'transaksi_id' => 'sometimes|required|integer|exists:transaksis,id',
            'barang_id' => 'sometimes|required|integer|exists:produks,id',
            'jumlah' => 'sometimes|required|integer',
            'harga_satuan' => 'sometimes|required|numeric',
            'subtotal' => 'sometimes|required|numeric',
            'keterangan' => 'nullable|string',
        ]);
        $detail->update($validated);
        $responseData = [
            'message' => 'Detail transaksi updated successfully',
            'data' => $detail,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function destroy($id)
    {
        $detail = DetailTransaksi::findOrFail($id);
        $detail->delete();
        $responseData = [
            'message' => 'Detail transaksi deleted',
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }
}