<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\NutrisiController AS ServiceNutrisiController;
use App\Http\Controllers\Services\ArtikelController;
use Carbon\Carbon;
class NutrisiController extends Controller
{
    public function getNutrisi(Request $request){
        $dataNutrisi = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServiceNutrisiController::class)->dataCacheFile(null, 'get_limit', 3, ['uuid', 'judul', 'foto', 'created_at'], ['id_data', 'judul', 'gambar', 'tanggal'], true));
        return response()->json(['status' => 'success', 'data' => $dataNutrisi]);
    }
    public function getNutrisiArtikel(Request $request){
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServiceNutrisiController::class)->dataCacheFile(null, 'get_limit', null, ['uuid', 'judul', 'foto', 'created_at'], ['id_data', 'judul', 'foto', 'tanggal'], true));
        return response()->json(['status'=>'success', 'data'=> $artikel]);
    }
    public function getNutrisiUsia(Request $request, $usia){
        $dataNutrisi = app()->make(ServiceNutrisiController::class)->dataCacheFile($usia, 'get_limit',1, ['uuid', 'judul','foto']);
        if(is_null($dataNutrisi)){
            return response()->json(['status' => 'error', 'message' => 'Nutrisi tidak ditemukan'], 404);
        }
        $dataNutrisi = $dataNutrisi[0];
        $dataNutrisi['id_nutrisi'] = $dataNutrisi['uuid'];
        unset($dataNutrisi['uuid']);
        return response()->json(['status' => 'success', 'data' => $dataNutrisi]);
    }
    public function getNutrisiDetail(Request $request, $idNutrisi){
        $nutrisiDetail = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServiceNutrisiController::class)->dataCacheFile(['uuid' => $idNutrisi], 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'link_video', 'rentang_usia', 'foto', 'created_at'], ['id_data', 'judul', 'deskripsi', 'link_video', 'rentang_usia', 'gambar', 'tanggal']));
        if(is_null($nutrisiDetail)){
            return response()->json(['status' => 'error', 'message' => 'Nutrisi tidak ditemukan'], 404);
        }
        $nutrisiDetail = $nutrisiDetail[0];
        $dataNutrisi = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServiceNutrisiController::class)->dataCacheFile(null, 'get_limit', 3, ['uuid', 'judul', 'foto', 'created_at'], ['id_data', 'judul', 'gambar', 'tanggal'], true) ?? []);
        return response()->json(['status' => 'success', 'data' => ['detail'=> $nutrisiDetail, 'artikel' => $dataNutrisi]]);
    }
}