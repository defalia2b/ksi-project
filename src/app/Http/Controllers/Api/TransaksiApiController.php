<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Helpers\EncryptionHelper;

class TransaksiApiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        $responseData = [
            'message' => 'Success',
            'data' => $transaksi,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $responseData = [
            'message' => 'Success',
            'data' => $transaksi,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function store(Request $request)
    {
        // Decrypt the incoming data
        $decrypted = EncryptionHelper::decrypt($request->input('data'));
        $payload = json_decode($decrypted, true);

        // Validate the decrypted payload
        $validated = validator($payload, [
            'kode_transaksi' => 'required|string|max:255|unique:transaksis,kode_transaksi',
            'user_id' => 'required|integer|exists:users,id',
            'tipe_transaksi' => 'required|string|max:50',
            'total_harga' => 'required|numeric',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string',
            'status_pembayaran' => 'required|string|max:50',
        ])->validate();

        $transaksi = Transaksi::create($validated);
        $responseData = [
            'message' => 'Transaksi created successfully',
            'data' => $transaksi,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse], 201);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Decrypt the incoming data
        $decrypted = EncryptionHelper::decrypt($request->input('data'));
        $payload = json_decode($decrypted, true);

        // Validate the decrypted payload
        $validated = validator($payload, [
            'kode_transaksi' => 'sometimes|required|string|max:255|unique:transaksis,kode_transaksi,' . $transaksi->id,
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'tipe_transaksi' => 'sometimes|required|string|max:50',
            'total_harga' => 'sometimes|required|numeric',
            'tanggal_transaksi' => 'sometimes|required|date',
            'keterangan' => 'nullable|string',
            'status_pembayaran' => 'sometimes|required|string|max:50',
        ])->validate();

        $transaksi->update($validated);
        $responseData = [
            'message' => 'Transaksi updated successfully',
            'data' => $transaksi,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        $responseData = [
            'message' => 'Transaksi deleted',
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }
}