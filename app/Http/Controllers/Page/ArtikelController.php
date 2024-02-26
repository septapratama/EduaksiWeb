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
    public function showEdit(Request $request, $id){
        $dataShow = [
            'dataArtikel' => app()->make(ServiceArtikelController::class)->dataCacheFile($id, 'get_id'),
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Article.edit',$dataShow);
    }
}