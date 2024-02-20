<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\EmotalController AS ServiceEmotalController;
use Illuminate\Http\Request;
class EmotalController extends Controller
{
    public function showData(Request $request){
        $dataShow = [
            'dataEmotal' => app()->make(ServiceEmotalController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'judul', 'deskripsi','rentang_usia']),
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
    public function showEdit(Request $request){
        $dataShow = [
            'dataEmotal' => app()->make(ServiceEmotalController::class)->dataCacheFile(null, 'get_id'),
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Emotal.edit',$dataShow);
    }
}