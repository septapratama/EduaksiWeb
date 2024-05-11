<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\PengasuhanController AS ServicePengasuhanController;
use App\Http\Controllers\Services\ArtikelController;
use Carbon\Carbon;
class PengasuhanController extends Controller
{
    public function getPengasuhan(Request $request){
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at'], ['judul', 'gambar', 'tanggal']));
        shuffle($artikel);
        $dataPengasuhan = app()->make(ServicePengasuhanController::class)->dataCacheFile(null, 'get_limit',10, ['uuid', 'judul','foto']);
        shuffle($dataPengasuhan);
        foreach($dataPengasuhan as &$item){
            $item['id_pengasuhan'] = $item['uuid'];
            unset( $item['uuid']);
        }
        return response()->json(['status' => 'success', 'data' => ['artikel'=>$artikel, 'pengasuhan'=>$dataPengasuhan]]);
    }
    public function getPengasuhanArtikel(Request $request){
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', null, ['judul', 'foto', 'created_at'], ['judul', 'gambar', 'tanggal']));
        shuffle($artikel);
        return response()->json(['status'=>'success', 'data'=> $artikel]);
    }
    public function getPengasuhanUsia(Request $request, $usia){
        $dataPengasuhan = app()->make(ServicePengasuhanController::class)->dataCacheFile($usia, 'get_limit',1, ['uuid', 'judul','foto']);
        if(is_null($dataPengasuhan)){
            return response()->json(['status' => 'error', 'message' => 'Pengasuhan tidak ditemukan'], 404);
        }
        $dataPengasuhan = $dataPengasuhan[0];
        $dataPengasuhan['id_pengasuhan'] = $dataPengasuhan['uuid'];
        unset($dataPengasuhan['uuid']);
        return response()->json(['status' => 'success', 'data' => $dataPengasuhan]);
    }
    public function getPengasuhanDetail(Request $request, $idNutrisi){
        $pengasuhanDetail = app()->make(ServicePengasuhanController::class)->dataCacheFile(['uuid' => $idNutrisi], 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'rentang_usia', 'foto', 'link_video']);
        if(is_null($pengasuhanDetail)){
            return response()->json(['status' => 'error', 'message' => 'Pengasuhan tidak ditemukan'], 404);
        }
        $pengasuhanDetail = $pengasuhanDetail[0];
        $pengasuhanDetail['id_pengasuhan'] = $pengasuhanDetail['uuid'];
        unset($pengasuhanDetail['uuid']);
        return response()->json(['status' => 'success', 'data' => $pengasuhanDetail]);
    }
}