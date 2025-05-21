<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;

// menggunakan encryption helper utk enkripsi dan dekripsi data
use App\Helpers\EncryptionHelper;

class BarangApiController extends Controller
{
    public function index()
    {
        // Fetch all barangs from the database
        // $barang = Barang::get();
        // // dd($barang);
        // return response()->json($barang);

        // TANPA PENJAGAAN APA APA
        // $products = Product::get();
        // return response()->json($products);

        // UNTUK PENJAGAAN KEAMANAN PERTAMA
        // $client = $request->get('authenticated_client');
        // return response()->json($client->products()->get());

        // Ambil client yang terautentikasi dari middleware
        $client = $request->get('authenticated_client'); // Pastikan middleware ClientAuth bekerja

        // Ambil data barang yang terkait dengan client
        $barangs = Barang::where('client_id', $client->id)->get(); // Asumsikan tabel Barang memiliki kolom client_id

        // Siapkan data untuk response
        $responseData = [
            'message' => 'Success',
            'data' => $barangs,
        ];

        // Enkripsi data response
        $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));

        // Kembalikan response terenkripsi
        return response()->json(['data' => $encryptedResponse]);
    
    }    

    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:255|unique:barangs,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        try {
            // Ambil client yang terautentikasi
            $client = $request->get('authenticated_client');

            // Buat data barang baru yang terkait dengan client
            $barang = Barang::create([
                'kode_barang' => $validated['kode_barang'],
                'nama_barang' => $validated['nama_barang'],
                'satuan' => $validated['satuan'],
                'kategori' => $validated['kategori'],
                'keterangan' => $validated['keterangan'],
                'client_id' => $client->id, // Asumsikan tabel Barang memiliki kolom client_id
            ]);

            // Siapkan data untuk response
            $responseData = [
                'message' => 'Barang created successfully',
                'data' => $barang,
            ];

            // Enkripsi data response sebelum dikembalikan
            $encryptedResponse = EncryptionHelper::encrypt(json_encode($responseData));

            // Kembalikan response terenkripsi
            return response()->json(['data' => $encryptedResponse]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan pesan error
            return response()->json([
                'error' => 'Error storing barang: ' . $e->getMessage(),
            ], 500);
        }
    }
}