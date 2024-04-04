<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\PengasuhanController AS ServicePengasuhanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\GaleriPengasuhan;
use App\Models\Pengasuhan;
class PengasuhanController extends Controller
{
    public function showData(Request $request, $err = null){
        if(!is_null($err)){
            return view('page.Pengasuhan.data', ['error' => $err]);
        }
        $dataShow = [
            'dataPengasuhan' => app()->make(ServicePengasuhanController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'judul', 'deskripsi','rentang_usia']),
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Pengasuhan.data',$dataShow);
    }
    public function showTambah(Request $request){
        $dataShow = [
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Pengasuhan.tambah',$dataShow);
    }
    public function showEdit(Request $request, $uuid){
        $pengasuhan = app()->make(ServicePengasuhanController::class)->dataCacheFile(['uuid' => $uuid], 'get_limit', 1, ['uuid', 'judul', 'deskripsi', 'rentang_usia', 'foto', 'link_video']);
        if(is_null($pengasuhan)){
            return $this->showData($request, 'Data Pengasuhan tidak ditemukan');
        }
        $dataShow = [
            'pengasuhan' => $pengasuhan[0],
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Pengasuhan.edit',$dataShow);
    }
}