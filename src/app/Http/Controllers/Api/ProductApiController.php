<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        // TANPA PENJAGAAN APA APA
        $products = Product::get();
        return response()->json($products);

        // UNTUK PENJAGAAN KEAMANAN PERTAMA
        // $client = $request->get('authenticated_client');
        // return response()->json($client->products()->get());

    }
}
