<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriApiController extends Controller
{
    public function index()
    {
        return response()->json(Kategori::all());
    }

    public function show($id)
    {
        return response()->json(Kategori::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kategori,slug',
            'deskripsi' => 'nullable|string',
        ]);
        $kategori = Kategori::create($validated);
        return response()->json($kategori, 201);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:kategori,slug,' . $kategori->id,
            'deskripsi' => 'nullable|string',
        ]);
        $kategori->update($validated);
        return response()->json($kategori);
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return response()->json(['message' => 'Deleted']);
    }
}