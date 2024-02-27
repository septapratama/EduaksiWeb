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
    public function showEdit(Request $request, $uuid){
        $disi = app()->make(ServiceDisiController::class)->dataCacheFile(['uuid' => $uuid], 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'rentang_usia', 'foto', 'link_video'])[0];
        if (!$disi) {
            return view('page.Disi.data', ['error' => 'Data Disi tidak ditemukan']);
        }
        $dataShow = [
            'disi' => $disi,
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Disi.edit',$dataShow);
    }
}