<?php
namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Konsultasi;
use Exception;
class KonsultasiController extends Controller
{
    private static $jsonFile;
    public function __construct(){
        self::$jsonFile = storage_path('app/database/konsultasi.json');
    }
    public function dataCacheFile($data = null, $con, $limit = null, $col = null){
        $fileExist = file_exists(self::$jsonFile);
        //check if file exist
        if (!$fileExist) {
            //if file is delete will make new json file
            $konsultanData = json_decode(Konsultasi::get(),true);
            foreach ($konsultanData as &$item) {
                unset($item['id_konsultasi']);
            }
            if (!file_put_contents(self::$jsonFile,json_encode($konsultanData, JSON_PRETTY_PRINT))) {
                throw new Exception('Gagal menyimpan file sistem');
            }
        }
        if($con == 'get_id'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = null;
            foreach($jsonData as $key => $item){
                if (isset($item['id_artikel']) && $item['id_artikel'] == $data['id_artikel']) {
                    $result = $jsonData[$key];
                }
            }
            if($result === null){
                throw new Exception('Data disi tidak ditemukan');
            }
            return $result;
        }else if($con == 'get_total'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = null;
            $result = count($jsonData);
            if($result === null){
                return 0;
            }
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
                        $result = $jsonData[$key];
                        break;
                    }
                }
                if ($result === null) {
                    throw new Exception('Data artikel tidak ditemukan');
                }
                $jsonData = [];
                $jsonData[] = $result;
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
        }else if($con == 'tambah'){
            if($fileExist){
                //tambah disi data
                $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
                $new[] = $data;
                $jsonData = array_merge($jsonData, $new);
                file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
            }
        }else if($con == 'update'){
            //update disi data
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['id_artikel']) && $item['id_artikel'] == $data['id_artikel']) {
                    $newData = [
                        'uuid' => $data['id_artikel'],
                        'judul' => $data['judul'],
                        'deskripsi' => $data['deskripsi'],
                        'link_video' => $data['link_video'],
                        'rentang_usia' => $data['rentang_usia'],
                        'foto' => $data['foto'],
                    ];
                    $jsonData[$key] = $newData;
                    break;
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }else if($con == 'hapus'){
            //hapus disi data
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['id_artikel']) && $item['id_artikel'] == $data['id_artikel']) {
                    unset($jsonData[$key]);
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }
    }
    public function tambahKonsultasi(Request $request){
        $validator = Validator::make($request->only('nama_lengkap', 'jenis_kelamin', 'alamat', 'no_telpon', 'email_konsultasi', 'foto'), [
            'nama_lengkap' => 'required|max:50',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required',
            'no_telpon' => 'required|digits_between:10,13',
            'email_konsultasi'=>'required|email',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib di isi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 50 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib di isi',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'alamat.required' => 'Alamat wajib di isi',
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
        //process file foto
        if (!$request->hasFile('foto')) {
            return response()->json(['status'=>'error','message'=>'Foto konsultasi wajib di isi'], 400);
        }
        $file = $request->file('foto');
        if(!($file->isValid() && in_array($file->extension(), ['pdf', 'jpeg', 'png', 'jpg']))){
            return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
        }
        $fotoName = $file->hashName();
        Storage::disk('konsultasi')->put($fotoName, file_get_contents($file));
        $ins = Konsultasi::insert([
            'uuid' => Str::uuid(),
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat' => $request->input('alamat'),
            'no_telpon' => $request->input('no_telpon'),
            'email' => $request->input('email_konsultasi'),
            'foto' => $fotoName,
        ]);
        if(!$ins){
            return response()->json(['status'=>'error','message'=>'Gagal menambahkan data Konsultasi'], 500);
        }
        return response()->json(['status'=>'success','message'=>'Data Konsultasi berhasil ditambahkan']);
    }
    public function editKonsultasi(Request $request){
        $validator = Validator::make($request->only('id_konsultasi','nama_lengkap', 'jenis_kelamin', 'alamat', 'no_telpon', 'email_konsultasi', 'foto'), [
            'id_konsultasi' => 'required',
            'nama_lengkap' => 'required|max:50',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required',
            'no_telpon' => 'required|digits_between:10,13',
            'email_konsultasi'=>'required|email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'id_konsultasi.required' => 'ID konsultasi wajib di isi',
            'nama_lengkap.required' => 'Nama lengkap wajib di isi',
            'nama_lengkap.max' => 'Nama lengkap maksimal 50 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib di isi',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'alamat.required' => 'Alamat wajib di isi',
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
        $konsultasi = Konsultasi::select('foto')->where('id_konsultasi',$request->input('id_konsultasi'))->limit(1)->get()[0];
        if (!$konsultasi) {
            return response()->json(['status' =>'error','message'=>'Data Konsultasi tidak ditemukan'], 400);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            $destinationPath = storage_path('app/konsultasi/');
            $fileToDelete = $destinationPath . $konsultasi['foto'];
            if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
                unlink($fileToDelete);
            }
            Storage::disk('konsultasi')->delete($konsultasi['foto']);
            $fotoName = $file->hashName();
            Storage::disk('konsultasi')->put($fotoName, file_get_contents($file));
        }
        $edit = $konsultasi->where('id_konsultasi',$request->input('id_konsultasi'))->update([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'alamat' => $request->input('alamat'),
            'no_telpon' => $request->input('no_telpon'),
            'email' => $request->input('email_konsultasi'),
            'foto' => $request->hasFile('foto') ? $fotoName : $konsultasi['foto'],
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Konsultasi'], 500);
        }
        return response()->json(['status' =>'success','message'=>'Data Konsultasi berhasil di perbarui']);
    }
    public function deleteKonsultasi(Request $request){
        $validator = Validator::make($request->only('id_konsultasi'), [
            'id_konsultasi' => 'required',
        ], [
            'id_konsultasi.required' => 'ID konsultasi wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $konsultasi = Konsultasi::select('foto')->where('uuid',$request->input('id_konsultasi'))->limit(1)->get()[0];
        if (!$konsultasi) {
            return response()->json(['status' => 'error', 'message' => 'Data Konsultasi tidak ditemukan'], 400);
        }
        //delete all photo
        $destinationPath = storage_path('app/konsultasi/');
        $fileToDelete = $destinationPath . $konsultasi->foto;
        if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
            unlink($fileToDelete);
        }
        Storage::disk('konsultasi')->delete('/'.$konsultasi->foto);
        if (!Konsultasi::where('uuid',$request->input('id_pengasuhan'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Pengasuhan'], 500);
        }
        $konsultasi->delete();
        return response()->json(['status' => 'success', 'message' => 'Data Konsultasi berhasil dihapus']);
    }
}