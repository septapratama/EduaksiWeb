<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\EmotalController AS ServiceEmotalController;
use Illuminate\Http\Request;
class EmotalController extends Controller
{
    public function getEmotal(Request $request){
        $dataEmotal = app()->make(ServiceEmotalController::class)->dataCacheFile(null, 'get_limit',10, ['uuid', 'judul','foto']);
        shuffle($dataEmotal);
        foreach($dataEmotal as &$item){
            $item['id_emotal'] = $item['uuid'];
            unset( $item['uuid']);
        }
        return response()->json(['status' => 'success', 'data' => $dataEmotal]);
    }
    public function getEmotalUsia(Request $request, $usia){
        $dataEmotal = app()->make(ServiceEmotalController::class)->dataCacheFile($usia, 'get_limit',1, ['uuid', 'judul','foto']);
        if(is_null($dataEmotal)){
            return response()->json(['status' => 'error', 'message' => 'Emosi Mental tidak ditemukan'], 404);
        }
        $dataEmotal = $dataEmotal[0];
        $dataEmotal['id_emotal'] = $dataEmotal['uuid'];
        unset($dataEmotal['uuid']);
        return response()->json(['status' => 'success', 'data' => $dataEmotal]);
    }
    public function getEmotalDetail(Request $request, $idEmotal){
        $emotalDetail = app()->make(ServiceEmotalController::class)->dataCacheFile(['uuid' => $idEmotal], 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'rentang_usia', 'foto', 'link_video']);
        if(is_null($emotalDetail)){
            return response()->json(['status' => 'error', 'message' => 'Emosi Mental tidak ditemukan'], 404);
        }
        $emotalDetail = $emotalDetail[0];
        $emotalDetail['id_emotal'] = $emotalDetail['uuid'];
        unset($emotalDetail['uuid']);
        return response()->json(['status' => 'success', 'data' => $emotalDetail]);
    }
}