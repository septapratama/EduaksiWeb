<?php
namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Artikel;
use Carbon\Carbon;
use Exception;
class ArtikelController extends Controller
{
    private static $jsonFile;
    public function __construct(){
        self::$jsonFile = storage_path('app/database/artikel.json');
    }
    public function dataCacheFile($data = null, $con, $limit = null, $col = null){
        $fileExist = file_exists(self::$jsonFile);
        //check if file exist
        if (!$fileExist) {
            //if file is delete will make new json file
            $artikelData = json_decode(Artikel::get(),true);
            foreach ($artikelData as &$item) {
                unset($item['id_artikel']);
            }
            if (!file_put_contents(self::$jsonFile,json_encode($artikelData, JSON_PRETTY_PRINT))) {
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
                throw new Exception('Data artikel tidak ditemukan');
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
                //tambah artikel data
                $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
                $new[] = $data;
                $jsonData = array_merge($jsonData, $new);
                file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
            }
        }else if($con == 'update'){
            //update artikel data
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['uuid']) && $item['uuid'] == $data['uuid']) {
                    $newData = [
                        'uuid' => $data['uuid'],
                        'judul' => $data['judul'],
                        'deskripsi' => $data['deskripsi'],
                        'link_video' => $data['link_video'],
                        'kategori' => $data['kategori'],
                        'foto' => $data['foto'],
                    ];
                    $jsonData[$key] = $newData;
                    break;
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }else if($con == 'hapus'){
            //hapus artikel data
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
    public function tambahArtikel(Request $request){
        $validator = Validator::make($request->only('judul', 'deskripsi', 'link_video', 'kategori', 'foto'), [
            'judul' => 'required|min:6|max:50',
            'deskripsi' => 'required',
            'link_video' => 'nullable',
            'kategori' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'judul.required' => 'Judul wajib di isi',
            'judul.min' => 'Judul minimal 6 karakter',
            'judul.max' => 'Judul maksimal 50 karakter',
            'deskripsi.required' => 'deskripsi artikel wajib di isi',
            'kategori.required' => 'Kategori wajib di isi',
            'foto.required' => 'Foto artikel wajib di isi',
            'foto.image' => 'Foto artikel harus berupa gambar',
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
            return response()->json(['status'=>'error','message'=>'Foto artikel wajib di isi'], 400);
        }
        $file = $request->file('foto');
        if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
            return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
        }
        if(app()->environment('local')){
            $destinationPath = public_path('img/artikel/');
        }else{
            $destinationPath = base_path('../public_html/public/img/artikel/');
        }
        $fotoName = $file->hashName();
        $file->move($destinationPath, $fotoName);
        $now = Carbon::now();
        $uuid = Str::uuid();
        $ins = Artikel::insert([
            'uuid' => $uuid,
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'kategori' => $request->input('kategori'),
            'foto' => $fotoName
        ]);
        if(!$ins){
            return response()->json(['status'=>'error','message'=>'Gagal menambahkan data Artikel'], 500);
        }
        $this->dataCacheFile([
            'uuid' => $uuid,
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'kategori' => $request->input('kategori'),
            'foto' => $fotoName,
            'created_at' => $now,
            'updated_at' => $now,
        ],'tambah');
        return response()->json(['status'=>'success','message'=>'Data Artikel berhasil ditambahkan']);
    }
    public function editArtikel(Request $request){
        $validator = Validator::make($request->only('uuid','judul', 'deskripsi', 'link_video', 'kategori', 'foto'), [
            'uuid' => 'required',
            'judul' => 'required|min:6|max:50',
            'deskripsi' => 'required',
            'link_video' => 'nullable',
            'kategori' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'uuid.required' => 'ID artikel wajib di isi',
            'judul.required' => 'Judul wajib di isi',
            'judul.min' => 'Judul minimal 6 karakter',
            'judul.max' => 'Judul maksimal 50 karakter',
            'deskripsi.required' => 'deskripsi artikel wajib di isi',
            'kategori.required' => 'Kategori wajib di isi',
            'foto.required' => 'Foto artikel wajib di isi',
            'foto.image' => 'Foto artikel harus berupa gambar',
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
        $artikel = Artikel::select('foto')->where('uuid',$request->input('uuid'))->limit(1)->get()[0];
        if (!$artikel) {
            return response()->json(['status' =>'error','message'=>'Data Artikel tidak ditemukan'], 400);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            if(app()->environment('local')){
                $destinationPath = public_path('img/artikel/');
            }else{
                $destinationPath = base_path('../public_html/public/img/artikel/');
            }
            $fileToDelete = $destinationPath . $artikel['foto'];
            if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
                unlink($fileToDelete);
            }
            $fotoName = $file->hashName();
            $file->move($destinationPath, $fotoName);
        }
        $now = Carbon::now();
        $edit = $artikel->where('uuid',$request->input('uuid'))->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'kategori' => $request->input('kategori'),
            'foto' => $request->hasFile('foto') ? $fotoName : $artikel['foto'],
            'updated_at' => $now,
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Artikel'], 500);
        }
        $this->dataCacheFile([
            'uuid' => $request->input('uuid'),
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'kategori' => $request->input('kategori'),
            'foto' => $request->hasFile('foto') ? $fotoName : $artikel['foto'],
            'updated_at' => $now,
        ],'update');
        return response()->json(['status' =>'success','message'=>'Data Artikel berhasil di perbarui']);
    }
    public function deleteArtikel(Request $request){
        $validator = Validator::make($request->only('uuid'), [
            'uuid' => 'required',
        ], [
            'uuid.required' => 'ID artikel wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $artikel = Artikel::select('foto')->where('uuid',$request->input('uuid'))->limit(1)->get()[0];
        if (!$artikel) {
            return response()->json(['status' => 'error', 'message' => 'Data Artikel tidak ditemukan'], 400);
        }
        //delete all photo
        if(app()->environment('local')){
            $destinationPath = public_path('img/artikel/');
        }else{
            $destinationPath = base_path('../public_html/public/img/artikel/');
        }
        $fileToDelete = $destinationPath . $artikel['foto'];
        if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
            unlink($fileToDelete);
        }
        if (!Artikel::where('uuid',$request->input('uuid'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Artikel'], 500);
        }
        $this->dataCacheFile(['uuid' => $request->input('uuid')],'hapus');
        return response()->json(['status' => 'success', 'message' => 'Data Artikel berhasil dihapus']);
    }
}