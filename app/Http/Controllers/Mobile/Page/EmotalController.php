<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\EmotalController AS ServiceEmotalController;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\ArtikelController;
use Carbon\Carbon;
class EmotalController extends Controller
{
    public function getEmotal(Request $request){
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at'], ['judul', 'gambar', 'tanggal']));
        shuffle($artikel);
        $dataEmotal = app()->make(ServiceEmotalController::class)->dataCacheFile(null, 'get_limit',10, ['uuid', 'judul','foto']);
        shuffle($dataEmotal);
        foreach($dataEmotal as &$item){
            $item['id_emotal'] = $item['uuid'];
            unset( $item['uuid']);
        }
        return response()->json(['status' => 'success', 'data' => ['artikel'=>$artikel, 'emotal'=>$dataEmotal]]);
    }
    public function getEmotalArtikel(Request $request){
        $artikel = array_map(function($item){
            $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', null, ['judul', 'foto', 'created_at'], ['judul', 'gambar', 'tanggal']));
        shuffle($artikel);
        return response()->json(['status'=>'success', 'data'=> $artikel]);
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