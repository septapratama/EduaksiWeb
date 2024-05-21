<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\ArtikelController;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function dashboard(Request $request){
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['uuid', 'judul', 'foto', 'created_at'], ['id_data', 'judul', 'gambar', 'tanggal']) ?? []);
        shuffle($artikel);
        return response()->json(['status'=>'success', 'data'=> $artikel]);
    }
    public function showArtikel(Request $request){
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', null, ['judul', 'foto', 'created_at'], ['judul', 'foto', 'tanggal']) ?? []);
        $artikel = array_merge(...array_fill(0, 5, $artikel)); // make copy
        shuffle($artikel);
        return response()->json(['status'=>'success', 'data'=> $artikel]);
    }
    public function showDetailArtikel(Request $request, $path){
        $path = str_replace('-', ' ', $path);
        $detailArtikel = app()->make(ArtikelController::class)->dataCacheFile(['judul' => $path], 'get_limit', 1, ['judul', 'deskripsi', 'link_video', 'foto','created_at'], ['judul', 'deskripsi', 'link_video', 'gambar','tanggal']);
        if(is_null($detailArtikel)){
            return response()->json(['status' => 'error', 'message' => 'Artikel tidak ditemukan'], 404);
        }
        $detailArtikel = $detailArtikel[0];
        $detailArtikel['tanggal'] = Carbon::parse($detailArtikel['tanggal'])->translatedFormat('l, d F Y');
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at'], ['judul', 'foto', 'tanggal']) ?? []);
        $artikel = array_merge(...array_fill(0, 5, $artikel)); // make copy
        shuffle($artikel);
        return response()->json(['status'=>'success','data'=>['detail'=>$detailArtikel, 'artikel'=>$artikel]]);
    }
}