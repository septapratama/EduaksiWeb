<?php
namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\GaleriNutrisi;
use App\Models\Nutrisi;
use Carbon\Carbon;
use Exception;
class NutrisiController extends Controller
{
    private static $jsonFile;
    public function __construct(){
        self::$jsonFile = storage_path('app/database/nutrisi.json');
    }
    public function dataCacheFile($data = null, $con, $limit = null, $col = null){
        $fileExist = file_exists(self::$jsonFile);
        //check if file exist
        if (!$fileExist) {
            //if file is delete will make new json file
            $directory = dirname(self::$jsonFile);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            $nutrisiData = json_decode(Nutrisi::get(),true);
            foreach ($nutrisiData as &$item) {
                unset($item['id_nutrisi']);
            }
            if (!file_put_contents(self::$jsonFile,json_encode($nutrisiData, JSON_PRETTY_PRINT))) {
                throw new Exception('Gagal menyimpan file sistem');
            }
        }
        if($con == 'get_id'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = null;
            foreach($jsonData as $key => $item){
                if (isset($item['uuid']) && $item['uuid'] == $data['id_nutrisi']) {
                    $result = $jsonData[$key];
                }
            }
            if($result === null){
                return 0;
            }
            return $result;
        }else if($con == 'get_total'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = null;
            $result = count($jsonData);
            if($result === null){
                throw new Exception('Data Nutrisi tidak ditemukan');
            }
            return $result;
        }else if($con == 'get_limit'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            if(is_array($jsonData)) {
                if($limit !== null && is_int($limit) && $limit > 0) {
                    $jsonData = array_slice($jsonData, 0, $limit);
                }
                if(is_array($col)) {
                    foreach($jsonData as &$entry) {
                        $entry = array_intersect_key($entry, array_flip($col));
                    }
                }
                return $jsonData;
            }
            return null;
        }else if($con == 'tambah'){
            if($fileExist){
                //tambah Nutrisi
                $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
                $new[] = $data;
                $jsonData = array_merge($jsonData, $new);
                file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
            }
        }else if($con == 'update'){
            //update Nutrisi
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['uuid']) && $item['uuid'] == $data['id_nutrisi']) {
                    $newData = [
                        'uuid' => $data['id_nutrisi'],
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
            //hapus Nutrisi
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['uuid']) && $item['uuid'] == $data['id_nutrisi']) {
                    unset($jsonData[$key]);
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }
    }
    public function tambahNutrisi(Request $request){
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
            'deskripsi.required' => 'deskripsi artikel wajib di isi',
            'rentang_usia.required' => 'Rentang usia wajib di isi',
            'foto.required' => 'Foto nutrisi wajib di isi',
            'foto.image' => 'Foto nutrisi harus berupa gambar',
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
            return response()->json(['status'=>'error','message'=>'Foto nutrisi wajib di isi'], 400);
        }
        $file = $request->file('foto');
        if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
            return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
        }
        $fotoName = $file->hashName();
        Storage::disk('nutrisi')->put($fotoName, file_get_contents($file));
        $now = Carbon::now();
        $uuid = Str::uuid();
        $ins = Nutrisi::insert([
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
            return response()->json(['status'=>'error','message'=>'Gagal menambahkan data Nutrisi'], 500);
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
        return response()->json(['status'=>'success','message'=>'Data Nutrisi berhasil ditambahkan']);
    }
    public function editNutrisi(Request $request){
        $validator = Validator::make($request->only('id_nutrisi','judul', 'deskripsi', 'link_video', 'rentang_usia', 'foto'), [
            'id_nutrisi' => 'required',
            'judul' => 'required|min:6|max:50',
            'deskripsi' => 'required',
            'link_video' => 'nullable',
            'rentang_usia' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'id_nutrisi.required' => 'ID nutrisi wajib di isi',
            'judul.required' => 'Judul wajib di isi',
            'judul.min' => 'Judul minimal 6 karakter',
            'judul.max' => 'Judul maksimal 50 karakter',
            'deskripsi.required' => 'deskripsi artikel wajib di isi',
            'rentang_usia.required' => 'Rentang usia wajib di isi',
            'foto.required' => 'Foto nutrisi wajib di isi',
            'foto.image' => 'Foto nutrisi harus berupa gambar',
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
        $nutrisi = Nutrisi::select('foto')->where('uuid',$request->input('id_nutrisi'))->limit(1)->get()[0];
        if (!$nutrisi) {
            return response()->json(['status' =>'error','message'=>'Data Nutrisi tidak ditemukan'], 400);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            $destinationPath = storage_path('app/nutrisi/');
            $fileToDelete = $destinationPath . $nutrisi['foto'];
            if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
                unlink($fileToDelete);
            }
            Storage::disk('nutrisi')->delete($nutrisi['foto']);
            $fotoName = $file->hashName();
            Storage::disk('nutrisi')->put($fotoName, file_get_contents($file));
        }
        $now = Carbon::now();
        $edit = $nutrisi->where('uuid',$request->input('id_nutrisi'))->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $request->hasFile('foto') ? $fotoName : $nutrisi['foto'],
            'updated_at' => $now,
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Nutrisi'], 500);
        }
        $this->dataCacheFile([
            'id_nutrisi' => $request->input('id_nutrisi'),
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $request->hasFile('foto') ? $fotoName : $nutrisi['foto'],
            'updated_at' => $now,
        ],'update');
        return response()->json(['status' =>'success','message'=>'Data Nutrisi berhasil di perbarui']);
    }
    public function deleteNutrisi(Request $request){
        $validator = Validator::make($request->only('id_nutrisi'), [
            'id_nutrisi' => 'required',
        ], [
            'id_nutrisi.required' => 'ID nutrisi wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $nutrisi = Nutrisi::select('foto')->where('uuid',$request->input('id_nutrisi'))->limit(1)->get()[0];
        if (!$nutrisi) {
            return response()->json(['status' => 'error', 'message' => 'Data Nutrisi tidak ditemukan'], 400);
        }
        //delete all photo
        $destinationPath = storage_path('app/nutrisi/');
        $fileToDelete = $destinationPath . $nutrisi->foto;
        if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
            unlink($fileToDelete);
        }
        Storage::disk('nutrisi')->delete('/'.$nutrisi->foto);
        // GaleriNutrisi::where('id_nutrisi',$request->input('id_nutrisi'))->delete();
        if (!Nutrisi::where('uuid',$request->input('id_nutrisi'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Nutrisi'], 500);
        }
        $this->dataCacheFile(['id_nutrisi' => $request->input('id_nutrisi')],'hapus');
        return response()->json(['status' => 'success', 'message' => 'Data Nutrisi berhasil dihapus']);
    }
}