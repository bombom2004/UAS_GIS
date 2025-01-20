<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $setting = DB::table('pengaturans')->where('id', 1)->first();
        $lokasi =DB::table('lokasis')
                ->join('kategoris', 'id_kategori', '=', 'kategoris.id')
                ->select('lokasis.id','lokasis.gambar','lokasis.diskripsi','lokasis.nama_lokasi','lokasis.latitude','lokasis.longitude','lokasis.gambar','lokasis.icon','kategoris.kategori')
                ->get();
        $kategori = DB::table('lokasis')
                ->join('kategoris', 'lokasis.id_kategori', '=', 'kategoris.id')
                ->select('kategoris.kategori')
                ->groupby('kategoris.kategori')
                ->get();

                // SELECT kategori FROM `lokasis` INNER JOIN `kategoris` ON `lokasis`.`id_kategori` = `kategoris`.`id` GROUP BY `kategoris`.`id`;
        return view('index',compact('setting','lokasi','kategori') );
    }
}
