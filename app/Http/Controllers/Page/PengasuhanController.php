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
    public function showData(Request $request){
        $dataShow = [
            'dataPengasuhan' => app()->make(ServicePengasuhanController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'judul', 'deskripsi','rentang_usia']),
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Pengasuhan.data',$dataShow);
    }
    public function showTambah(Request $request){
        $dataShow = [
            'dataPengasuhan' => app()->make(ServicePengasuhanController::class)->dataCacheFile(null, 'get_id'),
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Pengasuhan.tambah',$dataShow);
    }
    public function showEdit(Request $request){
        $dataShow = [
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Pengasuhan.edit',$dataShow);
    }
}