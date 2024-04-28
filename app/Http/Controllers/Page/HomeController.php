<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\DisiController AS ServiceDisiController;
use App\Http\Controllers\Services\EmotalController AS ServiceEmotalController;
use App\Http\Controllers\Services\NutrisiController AS ServiceNutrisiController;
use App\Http\Controllers\Services\PengasuhanController AS ServicePengasuhanController;
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
    public function showRiwayat(Request $request){
        $disi = app()->make(ServiceDisiController::class)->dataCacheFile(null, 'get_riwayat', 3, ['uuid', 'judul', 'created_at']);
        $emotal = app()->make(ServiceEmotalController::class)->dataCacheFile(null, 'get_riwayat', 3, ['uuid', 'judul', 'created_at']);
        $nutrisi = app()->make(ServiceNutrisiController::class)->dataCacheFile(null, 'get_riwayat', 3, ['uuid', 'judul', 'created_at']);
        $pengasuhan = app()->make(ServicePengasuhanController::class)->dataCacheFile(null, 'get_riwayat', 3, ['uuid', 'judul', 'created_at']);
        $artikel = app()->make(ServiceArtikelController::class)->dataCacheFile(null, 'get_riwayat', 3, ['uuid', 'judul', 'created_at']);
        $dataAll = array_merge($disi, $emotal, $nutrisi, $pengasuhan, $artikel);
        usort($dataAll, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        $dataAll = array_map(function($item){
            $item['created_at'] = Carbon::parse($item['created_at'])->translatedFormat('l, d F Y');
            return $item;
        }, $dataAll);
        return view('page.riwayat',['userAuth' => $request->input('user_auth'), 'dataRiwayat' => $dataAll]);
    }
}