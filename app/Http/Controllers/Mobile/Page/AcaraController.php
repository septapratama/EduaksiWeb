<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\EventController AS ServiceEventController;
use Illuminate\Http\Request;
class AcaraController extends Controller
{
    public function showData(Request $request, $err = null){
        if(!is_null($err)){
            return view('page.Event.data', ['error' => $err]);
        }
        $dataAcara = app()->make(ServiceEventController::class)->dataCacheFile(null, 'get_limit',null, ['id_acara', 'nama_event']);
        return response()->json(['status' => 'success', 'data' => $dataAcara]);
    }
    public function showEdit(Request $request, $id_acara){
        $dataAcara = app()->make(ServiceEventController::class)->dataCacheFile(['id_acara' => $id_acara], 'get_limit', 1, ['id_acara', 'nama_event', 'deskripsi', 'tanggal']);
        if(is_null($dataAcara)){
            return $this->showData($request, 'Data Event tidak ditemukan');
        }
        // $dataAcara['id_acara'] = $dataAcara['id_acara'];
        unset($dataAcara['id_acara']);
        return response()->json(['status' => 'success', 'data' => $dataAcara]);
    }
}