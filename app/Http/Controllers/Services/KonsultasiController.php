<?php
namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Konsultasi;
use Exception;
class KonsultasiController extends Controller
{
    private static $jsonFile;
    private static $destinationPath;
    private static $kategoriCol = ['anak','alergi','gigi'];
    public function __construct(){
        self::$jsonFile = storage_path('app/database/konsultasi.json');
        if(env('APP_ENV', 'local') == 'local'){
            self::$destinationPath = public_path('img/konsultasi/');
        }else{
            $path = env('PUBLIC_PATH', '/../public_html/eduaksi');
            self::$destinationPath = base_path($path == '/../public_html/eduaksi' ? $path : '/../public_html/eduaksi') .'/img/konsultasi/';
        }
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
            $konsultanData = json_decode(Konsultasi::get(),true);
            foreach ($konsultanData as &$item) {
                unset($item['id_konsultasi']);
            }
            if (!file_put_contents(self::$jsonFile,json_encode($konsultanData, JSON_PRETTY_PRINT))) {
                return('Gagal menyimpan file sistem');
            }
        }
        if($con == 'get_id'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = null;
            foreach($jsonData as $key => $item){
                if (isset($item['id_konsultasi']) && $item['id_konsultasi'] == $data['id_konsultasi']) {
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
                    $item['desc'] = 'ks';
                }
                return $jsonData;
            }
            return [];
        }else if($con == 'tambah'){
            if($fileExist){
                //tambah konsultasi data
                $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
                $new[] = $data;
                $jsonData = array_merge($jsonData, $new);
                file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
            }
        }else if($con == 'update'){
            //update konsultasi data
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
            //hapus konsultasi data
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
    public function tambahKonsultasi(Request $request){
        $validator = Validator::make($request->only('nama_lengkap', 'jenis_kelamin', 'kategori', 'alamat', 'no_telpon', 'email_konsultasi', 'foto'), [
            'nama_lengkap' => 'required|max:50',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'kategori' => 'required',
            'alamat' => 'required|min:3|max:100',
            'no_telpon' => 'required|digits_between:10,13',                                                                  
            'email_konsultasi'=>'required|email',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib di isi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 50 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib di isi',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'kategori.required' => 'Jenis kelamin wajib di isi',
            'alamat.required' => 'Alamat wajib di isi',
            'alamat.min'=>'Alamat minimal 3 karakter',
            'alamat.max'=>'Alamat maksimal 100 karakter',
            'no_telpon.required' => 'Nomor telepon wajib di isi',
            'no_telpon.digits_between' => 'Nomor telepon tidak boleh lebih dari 13 karakter',
            'email_konsultasi.required' => 'Email Konsultasi wajib di isi',
            'email_konsultasi.email'=>'Email Konsultasi invalid',
            'foto.required' => 'Foto konsultasi wajib di isi',
            'foto.image' => 'Foto konsultasi harus berupa gambar',
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
        //check kategori
        $kategori = '';
        foreach(self::$kategoriCol as $item){
            if (strpos($request->input('kategori'), $item) !== false) {
                $kategori = $item;
                break;
            }
        }
        if(empty($kategori)){
            return response()->json(['status'=>'error', 'message'=>'Kategori invalid'], 400);
        }
        //check email konsultasi on table user
        $emKon = User::select('email')->whereRaw("BINARY email = ? AND role = ?",[$request->input('email_konsultasi'), 'admin'])->first();
        if ($emKon) {
            return response()->json(['status' => 'error', 'message' => 'Email tidak boleh sama dengan Admin'], 400);
        }
        //check email konsultasi on table konsultasi
        $emKon = Konsultasi::select('email')->whereRaw("BINARY email = ?",[$request->input('email_konsultasi')])->first();
        if ($emKon) {
            return response()->json(['status' => 'error', 'message' => 'Email sudah digunakan'], 400);
        }
        //process file foto
        if (!$request->hasFile('foto')) {
            return response()->json(['status'=>'error','message'=>'Foto konsultasi wajib di isi'], 400);
        }
        $file = $request->file('foto');
        if(!($file->isValid() && in_array($file->extension(), ['pdf', 'jpeg', 'png', 'jpg']))){
            return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
        }
        $fotoName = $file->hashName();
        $file->move(self::$destinationPath, $fotoName);
        $uuid = Str::uuid();
        $ins = Konsultasi::insert([
            'uuid' => $uuid,
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'kategori' => $kategori,
            'alamat' => $request->input('alamat'),
            'no_telpon' => $request->input('no_telpon'),
            'email' => $request->input('email_konsultasi'),
            'foto' => $fotoName,
        ]);
        if(!$ins){
            return response()->json(['status'=>'error','message'=>'Gagal menambahkan data Konsultasi'], 500);
        }
        $this->dataCacheFile([
            'uuid' => $uuid,
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'kategori' => $kategori,
            'alamat' => $request->input('alamat'),
            'no_telpon' => $request->input('no_telpon'),
            'email' => $request->input('email_konsultasi'),
            'foto' => $fotoName,
        ],'tambah');
        return response()->json(['status'=>'success','message'=>'Data Konsultasi berhasil ditambahkan']);
    }
    public function editKonsultasi(Request $request){
        $validator = Validator::make($request->only('uuid','nama_lengkap', 'jenis_kelamin', 'kategori', 'alamat', 'no_telpon', 'email_konsultasi', 'foto'), [
            'uuid' => 'required',
            'nama_lengkap' => 'required|max:50',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'kategori' => 'required',
            'alamat' => 'required|min:3|max:100',
            'no_telpon' => 'required|digits_between:10,13',
            'email_konsultasi'=>'required|email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'uuid.required' => 'ID konsultasi wajib di isi',
            'nama_lengkap.required' => 'Nama lengkap wajib di isi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 50 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib di isi',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'kategori.required' => 'Jenis kelamin wajib di isi',
            'alamat.required' => 'Alamat wajib di isi',
            'alamat.min'=>'Alamat minimal 3 karakter',
            'alamat.max'=>'Alamat maksimal 100 karakter',
            'no_telpon.required' => 'Nomor telepon wajib di isi',
            'no_telpon.digits_between' => 'Nomor telepon tidak boleh lebih dari 13 karakter',
            'email_konsultasi.email'=>'Email yang anda masukkan invalid',
            'foto.image' => 'Foto konsultasi harus berupa gambar',
            'foto.mimes' => 'Format foto tidak valid. Gunakan format jpeg, png, jpg, atau gif',
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
        //check kategori
        $kategori = '';
        foreach(self::$kategoriCol as $item){
            if (strpos($request->input('kategori'), $item) !== false) {
                $kategori = $item;
                break;
            }
        }
        if(empty($kategori)){
            return response()->json(['status'=>'error', 'message'=>'Kategori invalid'], 400);
        }
        $konsultasi = Konsultasi::select('email', 'foto')->where('uuid',$request->input('uuid'))->first();
        if (is_null($konsultasi)) {
            return response()->json(['status' =>'error','message'=>'Data Konsultasi tidak ditemukan'], 400);
        }
        //check email konsultasi on table user
        if (User::select('email')->whereRaw("BINARY email = ? AND role = ?",[$request->input('email_konsultasi'), 'admin'])->first()) {
            return response()->json(['status' => 'error', 'message' => 'Email invalid'], 400);
        }
        //check email konsultasi on table konsultasi
        if (Konsultasi::select('email')->whereRaw("BINARY email = ?",[$request->input('email_konsultasi')])->first() && $request->input('email_konsultasi') != $konsultasi['email']) {
            return response()->json(['status' => 'error', 'message' => 'Email sudah digunakan'], 400);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            $fileToDelete = self::$destinationPath . $konsultasi['foto'];
            if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
                unlink($fileToDelete);
            }
            $fotoName = $file->hashName();
            $file->move(self::$destinationPath, $fotoName);
        }
        $edit = Konsultasi::where('uuid',$request->input('uuid'))->update([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'kategori' => $kategori,
            'alamat' => $request->input('alamat'),
            'no_telpon' => $request->input('no_telpon'),
            'email' => $request->input('email_konsultasi'),
            'foto' => $request->hasFile('foto') ? $fotoName : $konsultasi['foto'],
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Konsultasi'], 500);
        }
        $this->dataCacheFile([
            'uuid' => $request->input('uuid'),
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'kategori' => $kategori,
            'alamat' => $request->input('alamat'),
            'no_telpon' => $request->input('no_telpon'),
            'email' => $request->input('email_konsultasi'),
            'foto' => $request->hasFile('foto') ? $fotoName : $konsultasi['foto'],
        ],'update');
        return response()->json(['status' =>'success','message'=>'Data Konsultasi berhasil di perbarui']);
    }
    public function deleteKonsultasi(Request $request){
        $validator = Validator::make($request->only('uuid'), [
            'uuid' => 'required',
        ], [
            'uuid.required' => 'ID konsultasi wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $konsultasi = Konsultasi::select('foto')->where('uuid',$request->input('uuid'))->limit(1)->first();
        if (is_null($konsultasi)) {
            return response()->json(['status' => 'error', 'message' => 'Data Konsultasi tidak ditemukan'], 400);
        }
        //delete all photo
        $fileToDelete = self::$destinationPath . $konsultasi['foto'];
        if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
            unlink($fileToDelete);
        }
        if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
            unlink($fileToDelete);
        }
        if (!Konsultasi::where('uuid',$request->input('uuid'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Pengasuhan'], 500);
        }
        $this->dataCacheFile(['uuid' => $request->input('uuid')],'hapus');
        return response()->json(['status' => 'success', 'message' => 'Data Konsultasi berhasil dihapus']);
    }
}