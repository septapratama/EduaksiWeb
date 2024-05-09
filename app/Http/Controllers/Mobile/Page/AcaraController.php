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
        $dataAcara = app()->make(ServiceEventController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'nama_event']);
        return response()->json(['status' => 'success', 'data' => $dataAcara]);
    }
    public function showEdit(Request $request, $uuid){
        $dataAcara = app()->make(ServiceEventController::class)->dataCacheFile(['uuid' => $uuid], 'get_limit', 1, ['uuid', 'nama_event', 'deskripsi', 'tanggal']);
        if(is_null($dataAcara)){
            return $this->showData($request, 'Data Event tidak ditemukan');
        }
            // 'event' => $event,
        $dataAcara['id_kalender'] = $dataAcara['uuid'];
        unset($dataAcara['uuid']);
        return response()->json(['status' => 'success', 'data' => $dataAcara]);
    }
}