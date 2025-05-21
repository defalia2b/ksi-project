<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Helpers\EncryptionHelper;

class SupplierApiController extends Controller
{
    public function index()
    {
        $responseData = [
            'message' => 'Success',
            'data' => Supplier::all(),
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        $responseData = [
            'message' => 'Success',
            'data' => $supplier,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
        ]);
        $supplier = Supplier::create($validated);
        $responseData = [
            'message' => 'Supplier created successfully',
            'data' => $supplier,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse], 201);
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'kontak_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
        ]);
        $supplier->update($validated);
        $responseData = [
            'message' => 'Supplier updated successfully',
            'data' => $supplier,
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        $responseData = [
            'message' => 'Supplier deleted',
        ];
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));
        return response()->json(['data' => $encryptedResponse]);
    }
}