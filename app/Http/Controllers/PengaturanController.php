<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    //
    public function index(){
        $pengaturan = DB::table('pengaturans')->where('id', 1)->first();
        return view('backend.pengaturan.index', compact('pengaturan'));
    }
    public function update(Request $request){
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg,svg,gif|max:2048',
        ]);
        //Priksa jika gambar tidak kosong
        $pengaturan = DB::table('pengaturans')->where('id',$request->id)->first();
        if ($request->hasFile('logo')) {
            //upload gambar
            $image = $request->file('logo');
            $image->storeAs('public/logo/', $image->hashName());
            //hapus gambar sebelumnya
            Storage::delete('public/logo/'.basename($pengaturan->logo));
            //update gambar dengan informasi yang lain
            DB::table('pengaturans')->where('id',$request->id)->update([
                'nama_app' => $request->nama_app,
                'singkatan' => $request->singkatan,
                'logo' => $image->hashName(),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'zoom' => $request->zoom
            ]);
        } else {
            //update 
            DB::table('pengaturans')->where('id',$request->id)->update([
                'nama_app' => $request->nama_app,
                'singkatan' => $request->singkatan,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'zoom' => $request->zoom
            ]);
        }
        return redirect('/pengaturan');
    }
}
