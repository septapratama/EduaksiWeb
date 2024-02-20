<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\DisiController AS ServiceDisiController;
use Illuminate\Http\Request;
class DisiController extends Controller
{
    public function showData(Request $request){
        $dataDisi = app()->make(ServiceDisiController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'judul','rentang_usia']);
        $dataShow = [
            'dataDisi' => $dataDisi,
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Disi.data',$dataShow);
    }
    public function showTambah(Request $request){
        $dataShow = [
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Disi.tambah',$dataShow);
    }
    public function showEdit(Request $request, $id){
        $dataShow = [
            'dataDisi' => app()->make(DisiController::class)->dataCacheFile($id, 'get_id'),
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Disi.edit',$dataShow);
    }
}