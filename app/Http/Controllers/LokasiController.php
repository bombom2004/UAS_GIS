<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LokasiController extends Controller
{
    // Menampilkan data lokasi
    public function index()
    {
        $judul = "Lokasi";
        $lokasi = DB::table('lokasis')
            ->join('kategoris', 'id_kategori', '=', 'kategoris.id')
            ->select('lokasis.id', 'lokasis.diskripsi', 'lokasis.nama_lokasi', 'lokasis.latitude', 'lokasis.longitude', 'lokasis.gambar', 'lokasis.icon', 'kategoris.kategori')
            ->paginate(25);
        $nomor = 1;
        return view('backend.lokasi.index', compact('lokasi', 'nomor', 'judul'));
    }

    // Menampilkan form untuk menambah data lokasi
    public function create()
    {
        $pengaturan = DB::table('pengaturans')->where('id', 1)->first();
        $kategori = DB::table('kategoris')->get();
        return view('backend.lokasi.add', compact('kategori', 'pengaturan'));
    }

    // Menampilkan form untuk mengedit data lokasi
    public function edit($id)
    {
        // Mengambil data pengaturan berdasarkan ID
        $pengaturan = DB::table('pengaturans')->where('id', 1)->first();

        // Mengambil data kategori
        $kategori = DB::table('kategoris')->get();

        // Mengambil data lokasi yang akan diedit berdasarkan ID
        $lokasi = Lokasi::findOrFail($id);

        // Menampilkan form edit dengan data kategori, pengaturan, dan lokasi
        return view('backend.lokasi.add', compact('kategori', 'pengaturan', 'lokasi'));
    }

    // Menyimpan data lokasi baru
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_lokasi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'diskripsi' => 'required',
            'id_kategori' => 'required',
            'icon' => 'required',
        ]);

        // Upload gambar
        $image = $request->file('gambar');
        $image->storeAs('public/lokasi/', $image->hashName());

        // Menyimpan data lokasi
        Lokasi::create([
            'nama_lokasi' => $request->nama_lokasi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'gambar' => $image->hashName(),
            'diskripsi' => $request->diskripsi,
            'id_kategori' => $request->id_kategori,
            'icon' => $request->icon,
        ]);

        return redirect('/lokasi')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    // Mengupdate data lokasi yang sudah ada
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_lokasi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'diskripsi' => 'required',
            'id_kategori' => 'required',
            'icon' => 'required',
        ]);

        // Mencari lokasi berdasarkan ID
        $lokasi = Lokasi::findOrFail($id);

        // Jika ada gambar baru yang di-upload, upload gambar baru dan hapus gambar lama
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            Storage::delete('public/lokasi/' . basename($lokasi->gambar));

            // Upload gambar baru
            $image = $request->file('gambar');
            $gambarName = $image->hashName();
            $image->storeAs('public/lokasi/', $gambarName);
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $gambarName = $lokasi->gambar;
        }

        // Update data lokasi
        $lokasi->update([
            'nama_lokasi' => $request->nama_lokasi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'gambar' => $gambarName,
            'diskripsi' => $request->diskripsi,
            'id_kategori' => $request->id_kategori,
            'icon' => $request->icon,
        ]);

        return redirect()->route('lokasi.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data lokasi
    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        Storage::delete('public/lokasi/' . basename($lokasi->gambar));
        $lokasi->delete();

        return redirect()->route('lokasi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function show(){
        
    }
}