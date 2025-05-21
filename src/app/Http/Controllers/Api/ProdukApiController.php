<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Helpers\EncryptionHelper;

class ProdukApiController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        $responseData = [
            'message' => 'Success',
            'data' => $produk,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        $responseData = [
            'message' => 'Success',
            'data' => $produk,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function store(Request $request)
    {
        // Decrypt input
        $decrypted = EncryptionHelper::decrypt($request->input('data'));
        $payload = json_decode($decrypted, true);

        // Validate decrypted data
        $validated = validator($payload, [
            'nama' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:produk,sku',
            'kategori_id' => 'required|integer|exists:kategori,id',
            'supplier_id' => 'required|integer|exists:supplier,id',
            'deskripsi' => 'nullable|string',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'berat' => 'nullable|numeric',
            'satuan' => 'required|string|max:50',
            'gambar' => 'nullable|string',
            'status' => 'required|string|max:50',
        ])->validate();

        $produk = Produk::create($validated);

        $responseData = [
            'message' => 'Produk created successfully',
            'data' => $produk,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse], 201);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        // Decrypt input
        $decrypted = EncryptionHelper::decrypt($request->input('data'));
        $payload = json_decode($decrypted, true);

        // Validate decrypted data
        $validated = validator($payload, [
            'nama' => 'sometimes|required|string|max:255',
            'sku' => 'sometimes|required|string|max:255|unique:produk,sku,' . $produk->id,
            'kategori_id' => 'sometimes|required|integer|exists:kategori,id',
            'supplier_id' => 'sometimes|required|integer|exists:supplier,id',
            'deskripsi' => 'nullable|string',
            'harga_beli' => 'sometimes|required|numeric',
            'harga_jual' => 'sometimes|required|numeric',
            'stok' => 'sometimes|required|integer',
            'berat' => 'nullable|numeric',
            'satuan' => 'sometimes|required|string|max:50',
            'gambar' => 'nullable|string',
            'status' => 'sometimes|required|string|max:50',
        ])->validate();

        $produk->update($validated);

        $responseData = [
            'message' => 'Produk updated successfully',
            'data' => $produk,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }
}