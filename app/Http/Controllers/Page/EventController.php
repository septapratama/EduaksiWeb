<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Services\EventController AS ServiceEventController;
use Illuminate\Http\Request;
class EventController extends Controller
{
    public function showData(Request $request, $err = null){
        if(!is_null($err)){
            return view('page.Event.data', ['error' => $err]);
        }
        $dataEvent = app()->make(ServiceEventController::class)->dataCacheFile(null, 'get_limit',null, ['uuid', 'nama_event']);
        $dataShow = [
            'dataEvent' => $dataEvent,
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Event.data',$dataShow);
    }
    public function showTambah(Request $request){
        $dataShow = [
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Event.tambah',$dataShow);
    }
    public function showEdit(Request $request, $uuid){
        $event = app()->make(ServiceEventController::class)->dataCacheFile(['uuid' => $uuid], 'get_limit', 1, ['uuid', 'nama_event', 'deskripsi', 'tempat', 'tanggal_awal', 'tanggal_akhir']);
        if(is_null($event)){
            return $this->showData($request, 'Data Event tidak ditemukan');
        }
        $dataShow = [
            'event' => $event[0],
            'userAuth' => $request->input('user_auth'),
        ];
        return view('page.Event.edit',$dataShow);
    }
}