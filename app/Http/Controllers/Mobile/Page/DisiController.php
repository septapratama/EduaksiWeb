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
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at'], ['judul', 'gambar', 'tanggal']));
        shuffle($artikel);
        $dataDisi = app()->make(ServiceDisiController::class)->dataCacheFile(null, 'get_limit',10, ['uuid', 'judul','foto']);
        shuffle($dataDisi);
        foreach($dataDisi as &$item){
            $item['id_disi'] = $item['uuid'];
            unset( $item['uuid']);
        }
        return response()->json(['status' => 'success', 'data' => ['artikel'=>$artikel, 'disi'=>$dataDisi]]);
    }
    public function getDisiArtikel(Request $request){
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', null, ['judul', 'foto', 'created_at'], ['judul', 'gambar', 'tanggal']));
        shuffle($artikel);
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
        $disiDetail = app()->make(ServiceDisiController::class)->dataCacheFile(['uuid' => $idDisi], 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'rentang_usia', 'foto', 'link_video']);
        if(is_null($disiDetail)){
            return response()->json(['status' => 'error', 'message' => 'Digital Literasi tidak ditemukan'], 404);
        }
        $disiDetail = $disiDetail[0];
        $disiDetail['id_disi'] = $disiDetail['uuid'];
        unset($disiDetail['uuid']);
        return response()->json(['status' => 'success', 'data' => $disiDetail]);
    }
}