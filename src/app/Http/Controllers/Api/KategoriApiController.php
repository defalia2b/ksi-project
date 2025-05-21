<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Helpers\EncryptionHelper;

class KategoriApiController extends Controller
{
    public function index()
    {
        $responseData = [
            'message' => 'Success',
            'data' => Kategori::all(),
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        $responseData = [
            'message' => 'Success',
            'data' => $kategori,
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
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kategori,slug',
            'deskripsi' => 'nullable|string',
        ])->validate();

        $kategori = Kategori::create($validated);
        $responseData = [
            'message' => 'Kategori created successfully',
            'data' => $kategori,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse], 201);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        // Decrypt the incoming data
        $decrypted = EncryptionHelper::decrypt($request->input('data'));
        $payload = json_decode($decrypted, true);

        // Validate the decrypted payload
        $validated = validator($payload, [
            'nama' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:kategori,slug,' . $kategori->id,
            'deskripsi' => 'nullable|string',
        ])->validate();

        $kategori->update($validated);
        $responseData = [
            'message' => 'Kategori updated successfully',
            'data' => $kategori,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        $responseData = [
            'message' => 'Kategori deleted',
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }
}