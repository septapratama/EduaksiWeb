<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\ArtikelController AS ServiceArtikelController;
use Illuminate\Http\Request;
class ArtikelController extends Controller
{
    public function showData(Request $request){
        $dataArtikel = app()->make(ServiceArtikelController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'judul','rentang_usia']);
        $dataShow = [
            'dataArtikel' => $dataArtikel,
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Article.data',$dataShow);
    }
    public function showTambah(Request $request){
        $dataShow = [
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Article.tambah',$dataShow);
    }
    public function showEdit(Request $request, $uuid){
        $artikel = app()->make(ServiceArtikelController::class)->dataCacheFile(['uuid' => $uuid], 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'kategori', 'foto', 'link_video']);
        if(is_null($artikel)){
            return redirect('/article')->with('error', 'Data Artikel tidak ditemukan');
        }
        $dataShow = [
            'artikel' => $artikel[0],
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Article.edit',$dataShow);
    }
}