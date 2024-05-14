<?php
namespace App\Http\Controllers\Mobile\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Acara;
use Carbon\Carbon;
use Exception;
class AcaraController extends Controller
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
            $eventData = json_decode(Acara::get(),true);
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
                return strtotime($b['tanggal']) - strtotime($a['tanggal']);
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
                //tambah acara data
                $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
                $new[] = $data;
                $jsonData = array_merge($jsonData, $new);
                file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
            }
        }else if($con == 'update'){
            //update acara data
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['id_acara']) && $item['id_acara'] == $data['id_acara']) {
                    $newData = [
                        'id_acara' => $data['id_acara'],
                        'nama_acara' => $data['nama_acara'],
                        'deskripsi' => $data['deskripsi'],
                        'tanggal' => $data['tanggal'],
                    ];
                    $jsonData[$key] = $newData;
                    break;
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }else if($con == 'hapus'){
            //hapus acara data
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['id_acara']) && $item['id_acara'] == $data['id_acara']) {
                    unset($jsonData[$key]);
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }
    }
    public function getAcara(Request $request){
        //
    }
    public function tambahAcara(Request $request){
        $validator = Validator::make($request->only('nama_acara', 'deskripsi', 'kategori', 'tanggal'), [
            'nama_acara' => 'required|min:6|max:50',
            'deskripsi' => 'required|max:4000',
            'kategori' => 'required|in:umum,keluarga,penting',
            'tanggal' => 'required',
        ], [
            'nama_acara.required' => 'Nama acara harus di isi',
            'nama_acara.min' => 'Nama acara minimal 6 karakter',
            'nama_acara.max' => 'Nama acara maksimal 50 karakter',
            'deskripsi.required' => 'Deskripsi harus di isi',
            'deskripsi.max' => 'Deskripsi maksimal 4000 karakter',
            'kategori.required' => 'Kategori harus di isi',
            'kategori.in' => 'Kategori invalid',
            'tanggal.required' => 'Tanggal harus di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        //check tanggal
        $inpTanggal = Carbon::createFromFormat('d-m-Y i:H', $request->input('tanggal'));
        if($inpTanggal->lt(Carbon::now())){
            return response()->json(['status'=>'error','message'=>'Data Acara harus lebh dari sekarang'], 400);
        }
        if ($inpTanggal->diffInMinutes(Carbon::now()) < 5) {
            return response()->json(['status'=>'error','message'=>'Data Acara minimal 5 menit dari sekarang'], 400);
        }
        //check email
        $user = User::select('id_user')->whereRaw("BINARY email = ?",[$request->input('user_auth')['email']])->first();
        if (is_null($user)) {
            return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan'], 400);
        }
        $eventI = Acara::insertGetId([
            'nama_acara' => $request->input('nama_acara'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
            'tanggal' => $inpTanggal->format('Y-m-d H:i:s'),
            'id_user' => $user['id_user'],
        ]);
        if (is_null($eventI) || empty($eventI) || $eventI <= 0) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menambahkan data Acara'], 500);
        }
        $this->dataCacheFile([
            'id_acara' => $eventI,
            'nama_acara' => $request->input('nama_acara'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
            'tanggal' => $inpTanggal->format('Y-m-d H:i:s'),
            'id_user' => $user['id_user'],
        ], 'tambah');
        return response()->json(['status'=>'success','message'=>'Data Acara berhasil ditambahkan', 'data'=> $eventI]);
    }
    public function editAcara(Request $request){
        $validator = Validator::make($request->only('nama_acara', 'deskripsi', 'kategori', 'tanggal'), [
            'nama_acara' => 'required|min:6|max:50',
            'deskripsi' => 'required|max:4000',
            'kategori' => 'required|in:umum,keluarga,penting',
            'kategori.required' => 'Kategori harus di isi',
            'kategori.in' => 'Kategori invalid',
            'tanggal' => 'required',
        ], [
            'nama_acara.required' => 'Nama acara harus di isi',
            'nama_acara.min' => 'Nama acara minimal 6 karakter',
            'nama_acara.max' => 'Nama acara maksimal 50 karakter',
            'deskripsi.required' => 'Deskripsi harus di isi',
            'deskripsi.max' => 'Deskripsi maksimal 4000 karakter',
            'tanggal.required' => 'Tanggal harus di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        //check email
        $user = User::select('id_user')->whereRaw("BINARY email = ?",[$request->input('user_auth')['email']])->first();
        if (is_null($user)) {
            return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan'], 400);
        }
        //check tanggal
        $inpTanggal = Carbon::createFromFormat('d-m-Y i:H', $request->input('tanggal'));
        if($inpTanggal->lt(Carbon::now())){
            return response()->json(['status'=>'error','message'=>'Data Acara harus lebh dari sekarang'], 400);
        }
        if ($inpTanggal->diffInMinutes(Carbon::now()) < 5) {
            return response()->json(['status'=>'error','message'=>'Data Acara minimal 5 menit dari sekarang'], 400);
        }
        $acara = Acara::select('tanggal')->where('id_acara',$request->input('id_acara'))->first();
        if (is_null($acara)){
            return response()->json(['status' =>'error','message'=>'Data Acara tidak ditemukan'], 400);
        }
        $edit = $acara->where('id_acara',$request->input('id_acara'))->update([
            'nama_acara' => $request->input('nama_acara'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
            'tanggal' => $inpTanggal->format('Y-m-d H:i:s'),
            'id_user' => $user['id_user'],
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Acara'], 500);
        }
        $this->dataCacheFile([
            'nama_acara' => $request->input('nama_acara'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
            'tanggal' => $inpTanggal->format('Y-m-d H:i:s'),
            'id_user' => $user['id_user'],
        ],'update');
        return response()->json(['status' =>'success','message'=>'Data Acara berhasil di perbarui']);
    }
    public function deleteAcara(Request $request){
        $validator = Validator::make($request->only('id_acara'), [
            'id_acara' => 'required',
        ], [
            'id_acara.required' => 'ID acara harus di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        if (is_null(Acara::select('tanggal')->where('id_acara',$request->input('id_acara'))->first())) {
            return response()->json(['status' => 'error', 'message' => 'Data Acara tidak ditemukan'], 400);
        }
        if (!Acara::where('id_acara',$request->input('id_acara'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Acara'], 500);
        }
        $this->dataCacheFile(['id_acara' => $request->input('id_acara')],'hapus');
        return response()->json(['status' => 'success', 'message' => 'Data Acara berhasil dihapus']);
    }
}