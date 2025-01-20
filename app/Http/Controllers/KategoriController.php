<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    // Menampilkan data kategori
    public function index()
    {
        $judul = "Kategori";
        $kategoris = Kategori::latest()->paginate(25)->fragment('kategori');
        $nomor = 1;

        return view('backend.kategori.index', compact('kategoris', 'nomor', 'judul'));
    }

    // Menampilkan form untuk menambah data kategori
    public function create()
    {
        $judul = "Tambah Kategori";
        $paren = DB::table('kategoris')->get();

        return view('backend.kategori.add', compact('paren', 'judul'));
    }

    // Menyimpan data kategori baru
    public function store(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'kategori'  => 'required|min:2',
            'icon'      => 'required|min:2',
            'parent_id' => 'nullable|integer',
        ]);

        // Simpan data kategori
        Kategori::create([
            'kategori'  => $request->kategori,
            'icon'      => $request->icon,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    // Menampilkan form untuk mengedit data kategori
    public function edit($id)
    {
        $judul = "Edit Kategori";
        $kategori = Kategori::findOrFail($id);
        $paren = DB::table('kategoris')->get();

        return view('backend.kategori.add', compact('kategori', 'paren', 'judul'));
    }

    // Mengupdate data kategori yang ada
    public function update(Request $request, $id)
    {
        // Validasi input
        $this->validate($request, [
            'kategori'  => 'required|min:2',
            'icon'      => 'required|min:2',
            'parent_id' => 'nullable|integer',
        ]);

        // Update data kategori
        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'kategori'  => $request->kategori,
            'icon'      => $request->icon,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diperbarui!']);
    }

    // Menghapus data kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}