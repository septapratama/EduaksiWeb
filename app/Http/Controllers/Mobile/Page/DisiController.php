<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\DisiController AS ServiceDisiController;
use App\Http\Controllers\Services\ArtikelController;
use Carbon\Carbon;
class DisiController extends Controller
{
    public function getDisi(Request $request){
        $dataDisi = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServiceDisiController::class)->dataCacheFile(null, 'get_limit', 3, ['uuid', 'judul', 'foto', 'created_at'], ['id_data', 'judul', 'gambar', 'tanggal'], true));
        return response()->json(['status' => 'success', 'data' => $dataDisi]);
    }
    public function getDisiArtikel(Request $request){
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServiceDisiController::class)->dataCacheFile(null, 'get_limit', null, ['uuid', 'judul', 'foto', 'created_at'], ['id_data', 'judul', 'gambar', 'tanggal'], true) ?? []);
        return response()->json(['status'=>'success', 'data'=> $artikel]);
    }
    public function getDisiUsia(Request $request, $usia){
        $dataDisi = app()->make(ServiceDisiController::class)->dataCacheFile($usia, 'get_limit',1, ['uuid', 'judul','foto']);
        if(is_null($dataDisi)){
            return response()->json(['status' => 'error', 'message' => 'Digital Literasi tidak ditemukan'], 404);
        }
        $dataDisi = $dataDisi[0];
        $dataDisi['id_disi'] = $dataDisi['uuid'];
        unset($dataDisi['uuid']);
        return response()->json(['status' => 'success', 'data' => $dataDisi]);
    }
    public function getDisiDetail(Request $request, $idDisi){
        $disiDetail = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServiceDisiController::class)->dataCacheFile(null, 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'link_video', 'rentang_usia', 'foto', 'created_at'], ['id_data', 'judul', 'deskripsi', 'link_video', 'rentang_usia', 'gambar', 'tanggal']) ?? []);
        if(is_null($disiDetail)){
            return response()->json(['status' => 'error', 'message' => 'Digital Literasi tidak ditemukan'], 404);
        }
        $disiDetail = $disiDetail[0];
        $dataDisi = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServiceDisiController::class)->dataCacheFile(null, 'get_limit', 3, ['uuid', 'judul', 'foto', 'created_at'], ['id_data', 'judul', 'gambar', 'tanggal'], true) ?? []);
        return response()->json(['status' => 'success', 'data' => ['detail' => $disiDetail, 'artikel' => $dataDisi]]);
    }
}