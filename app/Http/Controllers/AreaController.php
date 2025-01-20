<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    // Menampilkan daftar area
    public function index()
    {
        $areas = Area::latest()->paginate(5);
        return view('backend.area.index', compact('areas'));
    }

    // Menampilkan form tambah area
    public function create()
    {
        $kategori = DB::table('kategoris')->get();
        return view('backend.area.add', compact('kategori'));
    }

    // Menyimpan data area baru
    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        Area::create($request->only(['nama_area', 'data', 'ket', 'id_kategori']));

        return redirect('/area')->with('success', 'Data Berhasil Disimpan!');
    }

    // Menampilkan form edit area
    public function edit(Area $area)
    {
        $kategori = DB::table('kategoris')->get();
        return view('backend.area.add', compact('area', 'kategori'));
    }

    // Memperbarui data area
    public function update(Request $request, Area $area)
    {
        $request->validate($this->validationRules());

        $area->update($request->only(['nama_area', 'data', 'ket', 'id_kategori']));

        return redirect('/area')->with('success', 'Data Berhasil Diperbarui!');
    }

    // Menghapus area
    public function destroy(Area $area)
    {
        $area->delete();
        return redirect('/area')->with('success', 'Data Berhasil Dihapus!');
    }

    // Aturan validasi
    private function validationRules()
    {
        return [
            'nama_area' => 'required|min:2', 
            'data' => 'required|min:2',
            'ket' => 'required|min:2',
            'id_kategori' => 'required|integer|min:1',
        ];
    }
}
