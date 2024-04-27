<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Services\ArtikelController;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function dashboard(Request $request){
        return response()->json(['status'=>'success', 'data'=> array_map(function($item){
            $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at']))]);
    }
    public function showArtikel(Request $request){
        $artikel = array_map(function($item){
            $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', null, ['judul', 'foto', 'created_at']));
        $artikel = array_merge(...array_fill(0, 5, $artikel)); // make copy
        shuffle($artikel);
        return response()->json(['status'=>'success', 'data'=> $artikel]);
    }
    public function showDetailArtikel(Request $request, $path){
        $path = str_replace('-', ' ', $path);
        $artikel = array_map(function($item){
            $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at']));
        $artikel = array_merge(...array_fill(0, 5, $artikel)); // make copy
        shuffle($artikel);
        $detailArtikel = app()->make(ArtikelController::class)->dataCacheFile(['judul' => $path], 'get_limit', 1, ['judul', 'deskripsi', 'foto', 'link_video','created_at'])[0];
        $detailArtikel['deskripsi'] = '<p>' . str_replace("\n", '</p><p>', $detailArtikel['deskripsi']) . '</p>';
        $detailArtikel['created_at'] = Carbon::parse($detailArtikel['created_at'])->translatedFormat('l, d F Y');
        $dataShow = [
            'artikel' => $artikel,
            'detail' => $detailArtikel,
        ];
        return view('page.Artikel.detail',$dataShow);
    }
}