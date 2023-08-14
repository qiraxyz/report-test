<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class SearchController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('q');
    $results = Barang::where('judul', 'like', "%$query%")
        ->orWhere('laporan', 'like', "%$query%")
        ->get();

    return response()->json($results);
}
}
