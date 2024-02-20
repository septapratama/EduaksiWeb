<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\NutrisiController AS ServiceNutrisiController;
use Illuminate\Http\Request;
class NutrisiController extends Controller
{
    public function showData(Request $request){
        $dataShow = [
            'dataNutrisi' => app()->make(ServiceNutrisiController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'judul', 'deskripsi','rentang_usia']),
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Nutrisi.data',$dataShow);
    }
    public function showTambah(Request $request){
        $dataShow = [
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Nutrisi.tambah',$dataShow);
    }
    public function showEdit(Request $request){
        $dataShow = [
            'dataNutrisi' => app()->make(NutrisiController::class)->dataCacheFile(null, 'get_id'),
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Nutrisi.edit',$dataShow);
    }
}