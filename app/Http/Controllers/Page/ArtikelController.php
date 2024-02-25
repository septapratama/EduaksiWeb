<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\ArtikelController AS ServiceArtikelController;
use Illuminate\Http\Request;
class ArtikelController extends Controller
{
    public function showData(Request $request){
        $dataDisi = app()->make(ServiceArtikelController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'judul','rentang_usia']);
        $dataShow = [
            'dataDisi' => $dataDisi,
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Artikel.data',$dataShow);
    }
    public function showTambah(Request $request){
        $dataShow = [
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Artikel.tambah',$dataShow);
    }
    public function showEdit(Request $request, $id){
        $dataShow = [
            'dataDisi' => app()->make(ServiceArtikelController::class)->dataCacheFile($id, 'get_id'),
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Artikel.edit',$dataShow);
    }
}