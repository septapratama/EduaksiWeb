<?php
namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;
use Carbon\Carbon;
use Exception;
class EventController extends Controller
{
    private static $jsonFile;
    public function __construct(){
        self::$jsonFile = storage_path('app/database/acara.json');
    }
    public function dataCacheFile($data = null, $con, $limit = null, $col = null, $alias = null){
        $directory = storage_path('app/database');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $fileExist = file_exists(self::$jsonFile);
        //check if file exist
        if (!$fileExist) {
            //if file is delete will make new json file
            $eventData = json_decode(Event::get(),true);
            foreach ($eventData as &$item) {
                unset($item['id_event']);
            }
            if (!file_put_contents(self::$jsonFile,json_encode($eventData, JSON_PRETTY_PRINT))) {
                throw new Exception('Gagal menyimpan file sistem');
            }
        }
        if($con == 'get_id'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = null;
            foreach($jsonData as $key => $item){
                if (isset($item['id_event']) && $item['id_event'] == $data['id_event']) {
                    $result = $jsonData[$key];
                }
            }
            return $result;
        }else if($con == 'get_total'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = 0;
            $result = count($jsonData);
            return $result;
        }else if($con === 'get_limit') {
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            if(!empty($data) && !is_null($data)) {
                $result = null;
                if (count($data) > 1) {
                    return 'error array key more than 1';
                }
                foreach ($jsonData as $key => $item){
                    $keys = array_keys($data)[0];
                    if (isset($item[$keys]) && $item[$keys] == $data[$keys]) {
                        $result[] = $jsonData[$key];
                    }
                }
                if ($result === null) {
                    return $result;
                }
                $jsonData = [];
                $jsonData = $result;
            }
            if(is_array($jsonData)) {
                if ($limit !== null && is_int($limit) && $limit > 0){
                    $jsonData = array_slice($jsonData, 0, $limit);
                }
                if (is_array($col)) {
                    foreach ($jsonData as &$entry) {
                        $entry = array_intersect_key($entry, array_flip($col));
                    }
                }
                return $jsonData;
            }
            return null;
        }else if($con === 'get_kalender') {
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            usort($jsonData, function($a, $b) {
                return strtotime($b['tanggal_awal']) - strtotime($a['tanggal_awal']);
            });
            if(!empty($data) && !is_null($data)) {
                $result = null;
                if (count($data) > 1) {
                    return 'error array key more than 1';
                }
                foreach ($jsonData as $key => $item){
                    $keys = array_keys($data)[0];
                    if (isset($item[$keys]) && $item[$keys] == $data[$keys]) {
                        $result[] = $jsonData[$key];
                    }
                }
                if ($result === null) {
                    return $result;
                }
                $jsonData = [];
                $jsonData = $result;
            }
            if(is_array($jsonData)) {
                if ($limit !== null && is_int($limit) && $limit > 0){
                    $jsonData = array_slice($jsonData, 0, $limit);
                }
                if (is_array($col)) {
                    foreach ($jsonData as &$entry) {
                        $entry = array_intersect_key($entry, array_flip($col));
                        $entry = is_array($alias) && (count($col) === count($alias)) ? array_combine($alias, array_values($entry)) : $entry;
                    }
                }
                return $jsonData;
            }
            return null;
        }else if($con == 'tambah'){
            if($fileExist){
                //tambah event data
                $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
                $new[] = $data;
                $jsonData = array_merge($jsonData, $new);
                file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
            }
        }else if($con == 'update'){
            //update event data
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['uuid']) && $item['uuid'] == $data['uuid']) {
                    $newData = [
                        'uuid' => $data['uuid'],
                        'nama_event' => $data['nama_event'],
                        'deskripsi' => $data['deskripsi'],
                        'tempat' => $data['tempat'],
                        'tanggal_awal' => $data['tanggal_awal'],
                        'tanggal_akhir' => $data['tanggal_akhir'],
                    ];
                    $jsonData[$key] = $newData;
                    break;
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }else if($con == 'hapus'){
            //hapus event data
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['uuid']) && $item['uuid'] == $data['uuid']) {
                    unset($jsonData[$key]);
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }
    }
    public function tambahEvent(Request $request){
        $validator = Validator::make($request->only('nama_event', 'deskripsi', 'tempat', 'tanggal_awal', 'tanggal_akhir'), [
            'nama_event' => 'required|min:6|max:50',
            'deskripsi' => 'required|max:4000',
            'tempat' => 'required|min:3|max:50',
            'tanggal_awal' => ['required', 'date', 'after_or_equal:' . now()->toDateString()],
            'tanggal_akhir' => ['required', 'date', 'after_or_equal:tanggal_awal', 'after_or_equal:' . now()->toDateString()],
        ], [
            'nama_event.required' => 'Nama event wajib di isi',
            'nama_event.min' => 'Nama event minimal 6 karakter',
            'nama_event.max' => 'Nama event maksimal 50 karakter',
            'deskripsi.required' => 'Deskripsi wajib di isi',
            'deskripsi.max' => 'Deskripsi maksimal 4000 karakter',
            'tempat.required' => 'Tempat event wajib di isi',
            'tempat.min' => 'Tempat event minimal 3 karakter',
            'tempat.max' => 'Tempat event maksimal 50 karakter',
            'tanggal_awal.required' => 'Tanggal awal wajib di isi',
            'tanggal_awal.date' => 'Format tanggal awal tidak valid',
            'tanggal_awal.after_or_equal' => 'Tanggal awal harus setelah atau sama dengan tanggal sekarang',
            'tanggal_akhir.required' => 'Tanggal akhir wajib di isi',
            'tanggal_akhir.date' => 'Format tanggal akhir tidak valid',
            'tanggal_akhir.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal awal',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $uuid = Str::uuid();
        $eventI = Event::insert([
            'uuid' => $uuid,
            'nama_event' => $request->input('nama_event'),
            'deskripsi' => $request->input('deskripsi'),
            'tempat' => $request->input('tempat'),
            'tanggal_awal' => $request->input('tanggal_awal'),
            'tanggal_akhir' => $request->input('tanggal_akhir'),
            // 'tanggal_awal' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_awal'))->format('Y-m-d'),
            // 'tanggal_akhir' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_akhir'))->format('Y-m-d'),
        ]);
        if (!$eventI) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menambahkan data Event'], 500);
        }
        $this->dataCacheFile([
            'uuid' => $uuid,
            'nama_event' => $request->input('nama_event'),
            'deskripsi' => $request->input('deskripsi'),
            'tempat' => $request->input('tempat'),
            'tanggal_awal' => $request->input('tanggal_awal'),
            'tanggal_akhir' => $request->input('tanggal_akhir'),
            // 'tanggal_awal' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_awal'))->format('Y-m-d'),
            // 'tanggal_akhir' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_akhir'))->format('Y-m-d'),
        ],'tambah');
        return response()->json(['status'=>'success','message'=>'Data Event berhasil ditambahkan']);
    }
    public function editEvent(Request $request){
        $validator = Validator::make($request->only('nama_event', 'deskripsi', 'tempat', 'tanggal_awal', 'tanggal_akhir'), [
            'nama_event' => 'required|min:6|max:50',
            'deskripsi' => 'required|max:4000',
            'tempat' => 'required|min:3|max:50',
            'tanggal_awal' => ['required', 'date', 'after_or_equal:' . now()->toDateString()],
            'tanggal_akhir' => ['required', 'date', 'after_or_equal:tanggal_awal', 'after_or_equal:' . now()->toDateString()],
        ], [
            'nama_event.required' => 'Nama event wajib di isi',
            'nama_event.min' => 'Nama event minimal 6 karakter',
            'nama_event.max' => 'Nama event maksimal 50 karakter',
            'deskripsi.required' => 'Deskripsi wajib di isi',
            'deskripsi.max' => 'Deskripsi maksimal 4000 karakter',
            'tempat.required' => 'Tempat event wajib di isi',
            'tempat.min' => 'Tempat event minimal 3 karakter',
            'tempat.max' => 'Tempat event maksimal 50 karakter',
            'tanggal_awal.required' => 'Tanggal awal wajib di isi',
            'tanggal_awal.date' => 'Format tanggal awal tidak valid',
            'tanggal_awal.after_or_equal' => 'Tanggal awal harus setelah atau sama dengan tanggal sekarang',
            'tanggal_akhir.required' => 'Tanggal akhir wajib di isi',
            'tanggal_akhir.date' => 'Format tanggal akhir tidak valid',
            'tanggal_akhir.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal awal',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $event = Event::select('tanggal_akhir')->where('uuid',$request->input('uuid'))->limit(1)->get()[0];
        if (!$event) {
            return response()->json(['status' =>'error','message'=>'Data Event tidak ditemukan'], 400);
        }
        $edit = $event->where('uuid',$request->input('uuid'))->update([
            'nama_event' => $request->input('nama_event'),
            'deskripsi' => $request->input('deskripsi'),
            'tempat' => $request->input('tempat'),
            'tanggal_awal' => $request->input('tanggal_awal'),
            'tanggal_akhir' => $request->input('tanggal_akhir'),
            // 'tanggal_awal' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_awal'))->format('Y-m-d'),
            // 'tanggal_akhir' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_akhir'))->format('Y-m-d'),
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Event'], 500);
        }
        $this->dataCacheFile([
            'uuid' => $request->input('uuid'),
            'nama_event' => $request->input('nama_event'),
            'deskripsi' => $request->input('deskripsi'),
            'tempat' => $request->input('tempat'),
            'tanggal_awal' => $request->input('tanggal_awal'),
            'tanggal_akhir' => $request->input('tanggal_akhir'),
            // 'tanggal_awal' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_awal'))->format('Y-m-d'),
            // 'tanggal_akhir' => Carbon::createFromFormat('d-m-Y', $request->input('tanggal_akhir'))->format('Y-m-d'),
        ],'update');
        return response()->json(['status' =>'success','message'=>'Data Event berhasil di perbarui']);
    }
    public function deleteEvent(Request $request){
        $validator = Validator::make($request->only('uuid'), [
            'uuid' => 'required',
        ], [
            'uuid.required' => 'ID event wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $event = Event::select('tanggal_akhir')->where('uuid',$request->input('uuid'))->limit(1)->get()[0];
        if (!$event) {
            return response()->json(['status' => 'error', 'message' => 'Data Event tidak ditemukan'], 400);
        }
        if (!Event::where('uuid',$request->input('uuid'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Event'], 500);
        }
        $this->dataCacheFile(['uuid' => $request->input('uuid')],'hapus');
        return response()->json(['status' => 'success', 'message' => 'Data Event berhasil dihapus']);
    }
}