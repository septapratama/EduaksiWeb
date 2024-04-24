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
        $kalender = app()->make(ServiceEventController::class)->dataCacheFile(null, 'get_limit', null, ['nama_event', 'tanggal_awal', 'tanggal_akhir']);
        $artikel = app()->make(ServiceArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at']);
        $rekomendasi = app()->make(ServiceArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at']);
        foreach($artikel as &$item){
            $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
        }
        foreach($rekomendasi  as &$item){
            $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
        }
        $dataShow = [
            'kalender' => $kalender,
            'artikel' => $artikel,
            'rekomendasi' => $rekomendasi,
        ];
        return view('page.home',$dataShow);
    }
    public function showArtikel(Request $request, $rekomendasi = null){
        $artikel = app()->make(ServiceArtikelController::class)->dataCacheFile(null, 'get_limit', null, ['judul', 'foto', 'created_at']);
        foreach($artikel as &$item){
            $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
        }
        $dataShow = [
            'artikel' => $artikel,
        ];
        return view('page.Artikel.daftar',$dataShow);
    }
    public function showDetailArtikel(Request $request, $path){
        $path = str_replace('-', ' ', $path);
        $artikel = app()->make(ServiceArtikelController::class)->dataCacheFile(null, 'get_limit', 3, ['judul', 'foto', 'created_at']);
        foreach($artikel as &$item){
            $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
        }
        $dataArtikel = app()->make(ServiceArtikelController::class)->dataCacheFile(['judul' => $path], 'get_limit', 1, ['judul', 'deskripsi', 'foto', 'link_video','created_at'])[0];
        $dataArtikel['deskripsi'] = '<p>' . str_replace("\n", '</p><p>', $dataArtikel['deskripsi']) . '</p>';
        $dataArtikel['created_at'] = Carbon::parse($dataArtikel['created_at'])->translatedFormat('l, d F Y');
        $dataShow = [
            'artikel' => $artikel,
            'dataArtikel' => $dataArtikel,
        ];
        return view('page.Artikel.detail',$dataShow);
    }
}