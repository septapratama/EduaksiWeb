<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\NutrisiController AS ServiceNutrisiController;
class NutrisiController extends Controller
{
    public function getNutrisi(Request $request){
        $dataNutrisi = app()->make(ServiceNutrisiController::class)->dataCacheFile(null, 'get_limit',10, ['uuid', 'judul','foto']);
        shuffle($dataNutrisi);
        foreach($dataNutrisi as &$item){
            $item['id_nutrisi'] = $item['uuid'];
            unset( $item['uuid']);
        }
        return response()->json(['status' => 'success', 'data' => $dataNutrisi]);
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
        $nutrisiDetail = app()->make(ServiceNutrisiController::class)->dataCacheFile(['uuid' => $idNutrisi], 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'rentang_usia', 'foto', 'link_video']);
        if(is_null($nutrisiDetail)){
            return response()->json(['status' => 'error', 'message' => 'Nutrisi tidak ditemukan'], 404);
        }
        $nutrisiDetail = $nutrisiDetail[0];
        $nutrisiDetail['id_nutrisi'] = $nutrisiDetail['uuid'];
        unset($nutrisiDetail['uuid']);
        return response()->json(['status' => 'success', 'data' => $nutrisiDetail]);
    }
}