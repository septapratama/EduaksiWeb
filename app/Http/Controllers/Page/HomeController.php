<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\ArtikelController AS ServiceArtikelController;
use App\Http\Controllers\Services\EventController AS ServiceEventController;
use Illuminate\Http\Request;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function showHome(Request $request){
        $dataShow = [
            'kalender' => app()->make(ServiceEventController::class)->dataCacheFile(null, 'get_limit', null, ['nama_event', 'tanggal_awal', 'tanggal_akhir']),
            'artikel' => array_map(function($item){
                $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
                return $item;
            }, app()->make(ServiceArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at'])),
        ];
        return view('page.home',$dataShow);
    }
    public function showArtikel(Request $request, $rekomendasi = null){
        $artikel = array_map(function($item){
            $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServiceArtikelController::class)->dataCacheFile(null, 'get_limit', null, ['judul', 'foto', 'created_at']));
        // $artikel = array_merge(...array_fill(0, 5, $artikel)); // make copy
        shuffle($artikel);
        return view('page.Artikel.daftar',['artikel'=> $artikel]);
    }
    public function showDetailArtikel(Request $request, $path){
        $path = str_replace('-', ' ', $path);
        $artikel = array_map(function($item){
            $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
            return $item;
        }, app()->make(ServiceArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at']));
        // $artikel = array_merge(...array_fill(0, 5, $artikel)); // make copy
        shuffle($artikel);
        $detailArtikel = app()->make(ServiceArtikelController::class)->dataCacheFile(['judul' => $path], 'get_limit', 1, ['judul', 'deskripsi', 'foto', 'link_video','created_at'])[0];
        $detailArtikel['deskripsi'] = '<p>' . str_replace("\n", '</p><p>', $detailArtikel['deskripsi']) . '</p>';
        $detailArtikel['created_at'] = Carbon::parse($detailArtikel['created_at'])->translatedFormat('l, d F Y');
        $dataShow = [
            'artikel' => $artikel,
            'detailArtikel' => $detailArtikel,
        ];
        return view('page.Artikel.detail',$dataShow);
    }
}