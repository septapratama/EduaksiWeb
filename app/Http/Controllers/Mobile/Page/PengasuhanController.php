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
        $dataPengasuhan = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServicePengasuhanController::class)->dataCacheFile(null, 'get_limit', 3, ['uuid', 'judul', 'foto', 'created_at'], ['id_data', 'judul', 'gambar', 'tanggal'], true));
        return response()->json(['status' => 'success', 'data' => $dataPengasuhan]);
    }
    public function getPengasuhanArtikel(Request $request){
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServicePengasuhanController::class)->dataCacheFile(null, 'get_limit', null, ['uuid', 'judul', 'foto', 'created_at'], ['id_data', 'judul', 'gambar', 'tanggal'], true));
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
    public function getPengasuhanDetail(Request $request, $idPengasuhan){
        $pengasuhanDetail = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServicePengasuhanController::class)->dataCacheFile(['uuid' => $idPengasuhan], 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'link_video', 'rentang_usia', 'foto', 'created_at'], ['id_data', 'judul', 'deskripsi', 'link_video', 'rentang_usia', 'gambar', 'tanggal']));
        if(is_null($pengasuhanDetail)){
            return response()->json(['status' => 'error', 'message' => 'Pengasuhan tidak ditemukan'], 404);
        }
        $pengasuhanDetail = $pengasuhanDetail[0];
        $dataPengasuhan = array_map(function($item){
            $item['tanggal'] = Carbon   ::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServicePengasuhanController::class)->dataCacheFile(null, 'get_limit', 3, ['uuid', 'judul', 'foto', 'created_at'], ['id_data', 'judul', 'gambar', 'tanggal'], true) ?? []);
        return response()->json(['status' => 'success', 'data' => ['detail' => $pengasuhanDetail, 'artikel' => $dataPengasuhan]]);
    }
}