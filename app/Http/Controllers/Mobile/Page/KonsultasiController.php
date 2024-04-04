<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Konsultasi;
class KonsultasiController extends Controller
{
    public function getKonsultasi(Request $request){    
        return response()->json(DB::table('konsultasi')->selectRaw('uuid as id_konsultasi, nama_lengkap, foto')->inRandomOrder()->limit(10)->get());
    }
    public function getKonsultasiDetail(Request $request, $idKonsultasi){
        $konsultasiDetail = Konsultasi::select('uuid', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'no_telpon', 'email', 'foto')->whereRaw("BINARY uuid = ?", $idKonsultasi)->first();
        if(is_null($konsultasiDetail)){
            return response()->json(['status' => 'error', 'message' => 'Konsultasi tidak ditemukan'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $konsultasiDetail]);
    }
}