<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\EmotalController AS ServiceEmotalController;
use Illuminate\Http\Request;
class EmotalController extends Controller
{
    public function showData(Request $request, $err = null){
        if(!is_null($err)){
            return view('page.Emotal.data', ['error' => $err]);
        }
        $dataShow = [
            'dataEmotal' => app()->make(ServiceEmotalController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'judul','rentang_usia']),
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Emotal.data',$dataShow);
    }
    public function showTambah(Request $request){
        $dataShow = [
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Emotal.tambah',$dataShow);
    }
    public function showEdit(Request $request, $uuid){
        $emotal = app()->make(ServiceEmotalController::class)->dataCacheFile(['uuid' => $uuid], 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'rentang_usia', 'foto', 'link_video']);
        if (is_null($emotal)) {
            return $this->showData($request, 'Data Emotal tidak ditemukan');
        }
        $dataShow = [
            'emotal' => $emotal[0],
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Emotal.edit',$dataShow);
    }
}