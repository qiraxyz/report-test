<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class LaporBarangController extends Controller
{
    public function index()
    {
        $data_laporan = Barang::all();
        return view('dashboard', compact('data_laporan'));
    }
    public function store(Request $request)
    {
        $data = new Barang();
        $data->judul = $request->input('judul');
        $data->laporan = $request->input('laporan');
        $data->no_seri = $request->input('no_seri');
        $data->status = $request->input('status');
        $data->save();

        return Redirect::route('dashboard_index');
    }
    public function delete($id)
    {
        $del_data = Barang::find($id);
        $del_data->delete();

        return Redirect::route('dashboard_index');
    }
    public function edit($id)
    {
        $laporan = Barang::find($id);
        return view('action.edit', compact('laporan'));
    }
    public function update(Request $request, $id) {
        $edit = Barang::find($id);

        $dt1 = [
            'judul' => $request->judul,
            'laporan' => $request->laporan,
            'no_resi' => $request->no_resi,
            'status' => $request->status,
        ];
        $edit->update($dt1);

        return redirect('/');
    }
}
