<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\KonsultasiController AS ServiceKonsultasiController;
use Illuminate\Http\Request;
class KonsultasiController extends Controller
{
    public function showData(Request $request, $err = null){
        $dataShow = [
            'dataKonsultasi' => app()->make(ServiceKonsultasiController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'nama_lengkap','no_telpon']),
            'userAuth' => $request->input('user_auth'),
        ];
        if(!is_null($err)){
            return view('page.Konsultasi.data', ['error' => $err]);
        }
        return view('page.Konsultasi.data',$dataShow);
    }
    public function showTambah(Request $request){
        $dataShow = [
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Konsultasi.tambah',$dataShow);
    }
    public function showEdit(Request $request, $uuid){
        $konsultasi = app()->make(ServiceKonsultasiController::class)->dataCacheFile(['uuid' => $uuid], 'get_limit', 1, ['uuid', 'nama_lengkap', 'jenis_kelamin', 'no_telpon', 'alamat', 'email', 'foto'])[0];
        if (!$konsultasi) {
            return $this->showData($request, 'Data Konsultasi tidak ditemukan');
        }
        $dataShow = [
            'konsultasi' => $konsultasi,
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Konsultasi.edit',$dataShow);
    }
}