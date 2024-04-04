<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\KonsultasiController AS ServiceKonsultasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Konsultasi;
class KonsultasiController extends Controller
{
    public function getKonsultasi(Request $request){
        $dataArtikel = app()->make(ServiceKonsultasiController::class)->dataCacheFile(null, 'get_limit',10, ['uuid', 'nama_lengkap','foto']);
        shuffle($dataArtikel);
        foreach($dataArtikel as &$item){
            $item['id_konsultasi'] = $item['uuid'];
            unset( $item['uuid']);
        }
        return response()->json($dataArtikel);
    }
    public function getKonsultasiDetail(Request $request, $idKonsultasi){
        $konsultasiDetail = app()->make(ServiceKonsultasiController::class)->dataCacheFile(['uuid' => $idKonsultasi], 'get_limit', 1, ['uuid', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'no_telpon', 'email', 'foto']);
        if(is_null($konsultasiDetail)){
            return response()->json(['status' => 'error', 'message' => 'Konsultasi tidak ditemukan'], 404);
        }
        $konsultasiDetail = $konsultasiDetail[0];
        $konsultasiDetail['id_konsultasi'] = $konsultasiDetail['uuid'];
        unset($konsultasiDetail['uuid']);
        return response()->json(['status' => 'success', 'data' => $konsultasiDetail]);
    }
}