<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PenyesuaianStok;
use Illuminate\Http\Request;
use App\Helpers\EncryptionHelper;

class PenyesuaianStokApiController extends Controller
{
    public function index()
    {
        $responseData = [
            'message' => 'Success',
            'data' => PenyesuaianStok::all(),
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function show($id)
    {
        $penyesuaian = PenyesuaianStok::findOrFail($id);
        $responseData = [
            'message' => 'Success',
            'data' => $penyesuaian,
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
            'barang_id' => 'required|integer|exists:produk,id',
            'user_id' => 'required|integer|exists:users,id',
            'tipe_penyesuaian' => 'required|string|max:50',
            'jumlah_perubahan' => 'required|integer',
            'keterangan' => 'nullable|string',
            'tanggal_penyesuaian' => 'required|date',
        ])->validate();

        $penyesuaian = PenyesuaianStok::create($validated);
        $responseData = [
            'message' => 'Penyesuaian stok created successfully',
            'data' => $penyesuaian,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse], 201);
    }

    public function update(Request $request, $id)
    {
        $penyesuaian = PenyesuaianStok::findOrFail($id);

        // Decrypt the incoming data
        $decrypted = EncryptionHelper::decrypt($request->input('data'));
        $payload = json_decode($decrypted, true);

        // Validate the decrypted payload
        $validated = validator($payload, [
            'barang_id' => 'sometimes|required|integer|exists:produk,id',
            'user_id' => 'sometimes|required|integer|exists:users,id',
            'tipe_penyesuaian' => 'sometimes|required|string|max:50',
            'jumlah_perubahan' => 'sometimes|required|integer',
            'keterangan' => 'nullable|string',
            'tanggal_penyesuaian' => 'sometimes|required|date',
        ])->validate();

        $penyesuaian->update($validated);
        $responseData = [
            'message' => 'Penyesuaian stok updated successfully',
            'data' => $penyesuaian,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function destroy($id)
    {
        $penyesuaian = PenyesuaianStok::findOrFail($id);
        $penyesuaian->delete();
        $responseData = [
            'message' => 'Penyesuaian stok deleted',
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }
}