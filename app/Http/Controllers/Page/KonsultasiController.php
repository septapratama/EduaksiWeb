<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
class KonsultasiController extends Controller
{
    public function showData(Request $request){
        $dataKonsultasi = Konsultasi::select('uuid', 'nama_lengkap','no_telpon')->get();
        if (!$dataKonsultasi) {
            return response()->json(['status' =>'error','message'=>'Data Konsultasi tidak ditemukan'], 400);
        }
        $dataShow = [
            'dataKonsultasi' => $dataKonsultasi,
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Konsultasi.data',$dataShow);
    }
    public function showTambah(Request $request){
        $dataShow = [
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Konsultasi.tambah',$dataShow);
    }
    public function showEdit(Request $request, $uuid){
        $konsultasi = Konsultasi::select('uuid', 'nama_lengkap','no_telpon')->where('uuid',$uuid)->limit(1)->get();
        if (!$konsultasi) {
            return view('page.Konsultasi.data', ['error'=>'Data Konsultasi tidak ditemukan']);
        }
        $dataShow = [
            'konsultasi' => $konsultasi,
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Konsultasi.edit',$dataShow);
    }
}