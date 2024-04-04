<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\DisiController AS ServiceDisiController;
use Illuminate\Http\Request;
class DisiController extends Controller
{
    public function getDisi(Request $request){
        $dataDisi = app()->make(ServiceDisiController::class)->dataCacheFile(null, 'get_limit',10, ['uuid', 'nama_lengkap','foto']);
        shuffle($dataDisi);
        foreach($dataDisi as &$item){
            $item['id_disi'] = $item['uuid'];
            unset( $item['uuid']);
        }
        return response()->json(['status' => 'success', 'data' => $dataDisi]);
    }
    public function getDisiUsia(Request $request, $usia){
        $dataDisi = app()->make(ServiceDisiController::class)->dataCacheFile($usia, 'get_limit',1, ['uuid', 'nama_lengkap','foto']);
        if(is_null($dataDisi)){
            return response()->json(['status' => 'error', 'message' => 'Konsultasi tidak ditemukan'], 404);
        }
        $dataDisi = $dataDisi[0];
        $dataDisi['id_disi'] = $dataDisi['uuid'];
        unset($dataDisi['uuid']);
        return response()->json(['status' => 'success', 'data' => $dataDisi]);
    }
    public function getDisiDetail(Request $request, $idDisi){
        $disiDetail = app()->make(ServiceDisiController::class)->dataCacheFile(['uuid' => $idDisi], 'get_limit', 1, ['uuid', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'no_telpon', 'email', 'foto']);
        if(is_null($disiDetail)){
            return response()->json(['status' => 'error', 'message' => 'Konsultasi tidak ditemukan'], 404);
        }
        $disiDetail = $disiDetail[0];
        $disiDetail['id_disi'] = $disiDetail['uuid'];
        unset($disiDetail['uuid']);
        return response()->json(['status' => 'success', 'data' => $disiDetail]);
    }
}