<?php
namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Emotal;
use Carbon\Carbon;
use Exception;
class EmotalController extends Controller
{
    private static $jsonFile;
    private static $destinationPath;
    public function __construct(){
        self::$jsonFile = storage_path('app/database/emotal.json');
        if(env('APP_ENV', 'local') == 'local'){
            self::$destinationPath = public_path('img/emosi_mental/');
        }else{
            $path = env('PUBLIC_PATH', '/../public_html/eduaksi');
            self::$destinationPath = base_path($path == '/../public_html/eduaksi' ? $path : '/../public_html/eduaksi' ) .'/img/emosi_mental/';
        }
    }
    public function dataCacheFile($data = null, $con, $limit = null, $col = null, $alias = null, $shuffle = false){
        $directory = storage_path('app/database');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        $fileExist = file_exists(self::$jsonFile);
        //check if file exist
        if (!$fileExist) {
            //if file is delete will make new json file
            $emotalData = json_decode(Emotal::get(),true);
            foreach ($emotalData as &$item) {
                unset($item['id_emotal']);
            }
            if (!file_put_contents(self::$jsonFile,json_encode($emotalData, JSON_PRETTY_PRINT))) {
                return('Gagal menyimpan file sistem');
            }
        }
        if($con == 'get_id'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = null;
            foreach($jsonData as $key => $item){
                if (isset($item['uuid']) && $item['uuid'] == $data['id_emotal']) {
                    $result = $jsonData[$key];
                }
            }
            return $result;
        }else if($con == 'get_total'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = 0;
            $result = count($jsonData);
            return $result;
        }else if($con == 'get_limit'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            //for searching
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
                $shuffle ? shuffle($jsonData) : null;
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
        }else if($con == 'get_usia'){
            $inpUsia = null;
            $constUsia = ['0-3', '4-6', '7-9', '10-12'];
            if (in_array($data, $constUsia)) {
                $inpUsia = $data . ' tahun';
            } elseif (is_numeric($data)) {
                $data = (int)$data;
                foreach ($constUsia as $range) {
                    list($min, $max) = explode('-', $range);
                    if ($data >= $min && $data <= $max) {
                        $inpUsia = $range . ' tahun';
                        break;
                    }
                }
            }
            if(is_null($inpUsia)){
                return null;
            }
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = null;
            foreach($jsonData as $key => $item){
                if (isset($item['rentang_usia']) && $item['rentang_usia'] == $inpUsia) {
                    $result[] = $jsonData[$key];
                }
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
        }else if($con == 'get_riwayat'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            usort($jsonData, function($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
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
                foreach ($jsonData as &$item){
                    $item['desc'] = 'em';
                }
                return $jsonData;
            }
            return [];
        }else if($con == 'tambah'){
            if($fileExist){
                //tambah Emosi Mental
                $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
                $new[] = $data;
                $jsonData = array_merge($jsonData, $new);
                file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
            }
        }else if($con == 'update'){
            //update Emosi Mental
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['uuid']) && $item['uuid'] == $data['uuid']) {
                    foreach ($item as $column => $value) {
                        if (array_key_exists($column, $data)) {
                            $item[$column] = $data[$column];
                        }
                    }
                    $jsonData[$key] = $item;
                    break;
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }else if($con == 'hapus'){
            //hapus Emosi Mental
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
    public function tambahEmotal(Request $request){
        $validator = Validator::make($request->only('judul', 'deskripsi', 'link_video', 'rentang_usia', 'foto'), [
            'judul' => 'required|min:6|max:50',
            'deskripsi' => 'required',
            'link_video' => 'nullable',
            'rentang_usia' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'judul.required' => 'Judul wajib di isi',
            'judul.min' => 'Judul minimal 6 karakter',
            'judul.max' => 'Judul maksimal 50 karakter',
            'deskripsi.required' => 'deskripsi emotal wajib di isi',
            'rentang_usia.required' => 'Rentang usia wajib di isi',
            'foto.required' => 'Foto emotal wajib di isi',
            'foto.image' => 'Foto emotal harus berupa gambar',
            'foto.mimes' => 'Format foto tidak valid. Gunakan format jpeg, png, jpg',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 5MB',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        //process file foto
        if (!$request->hasFile('foto')) {
            return response()->json(['status'=>'error','message'=>'Foto emotal wajib di isi'], 400);
        }
        $file = $request->file('foto');
        if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
            return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
        }
        $fotoName = $file->hashName();
        $file->move(self::$destinationPath, $fotoName);
        $now = Carbon::now();
        $uuid = Str::uuid();
        $ins = Emotal::insert([
            'uuid' => $uuid,
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $fotoName,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        if(!$ins){
            return response()->json(['status'=>'error','message'=>'Gagal menambahkan data Emotal'], 500);
        }
        $this->dataCacheFile([
            'uuid' => $uuid,
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $fotoName,
            'created_at' => $now,
            'updated_at' => $now,
        ],'tambah');
        return response()->json(['status'=>'success','message'=>'Data Emotal berhasil ditambahkan']);
    }
    public function editEmotal(Request $request){
        $validator = Validator::make($request->only('uuid','judul', 'deskripsi', 'link_video', 'rentang_usia', 'foto'), [
            'uuid' => 'required',
            'judul' => 'required|min:6|max:50',
            'deskripsi' => 'required',
            'link_video' => 'nullable',
            'rentang_usia' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'uuid.required' => 'ID emotal wajib di isi',
            'judul.required' => 'Judul wajib di isi',
            'judul.min' => 'Judul minimal 6 karakter',
            'judul.max' => 'Judul maksimal 50 karakter',
            'deskripsi.required' => 'deskripsi emotal wajib di isi',
            'rentang_usia.required' => 'Rentang usia wajib di isi',
            'foto.image' => 'Foto emotal harus berupa gambar',
            'foto.mimes' => 'Format foto tidak valid. Gunakan format jpeg, png, jpg',
            'foto.max' => 'Ukuran foto tidak boleh lebih dari 5MB',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $emosiMental = Emotal::select('foto')->where('uuid',$request->input('uuid'))->limit(1)->first();
        if (is_null($emosiMental)) {
            return response()->json(['status' =>'error','message'=>'Data Emotal tidak ditemukan'], 400);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            $fileToDelete = self::$destinationPath . $emosiMental['foto'];
            if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
                unlink($fileToDelete);
            }
            $fotoName = $file->hashName();
            $file->move(self::$destinationPath, $fotoName);
        }
        $now = Carbon::now();
        $edit = $emosiMental->where('uuid',$request->input('uuid'))->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $request->hasFile('foto') ? $fotoName : $emosiMental['foto'],
            'updated_at' => $now,
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Emotal'], 500);
        }
        $this->dataCacheFile([
            'uuid' => $request->input('uuid'),
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $request->hasFile('foto') ? $fotoName : $emosiMental['foto'],
            'updated_at' => $now,
        ],'update');
        return response()->json(['status' =>'success','message'=>'Data Emotal berhasil di perbarui']);
    }
    public function deleteEmotal(Request $request){
        $validator = Validator::make($request->only('uuid'), [
            'uuid' => 'required',
        ], [
            'uuid.required' => 'ID emotal wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $emosiMental = Emotal::select('foto')->where('uuid',$request->input('uuid'))->limit(1)->first();
        if (is_null($emosiMental)) {
            return response()->json(['status' =>'error','message'=>'Data Emotal tidak ditemukan'], 400);
        }
        //delete all photo
        $fileToDelete = self::$destinationPath . $emosiMental['foto'];
        if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
            unlink($fileToDelete);
        }
        if (!Emotal::where('uuid',$request->input('uuid'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Emotal'], 500);
        }
        $this->dataCacheFile(['uuid' => $request->input('uuid')],'hapus');
        return response()->json(['status' => 'success', 'message' => 'Data Emotal berhasil dihapus']);
    }
}