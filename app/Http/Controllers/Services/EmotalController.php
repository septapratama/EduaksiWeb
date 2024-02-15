<?php
namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\GaleriEmosiMental;
use App\Models\Emotal;
<<<<<<< HEAD
use Exception;
class EmotalController extends Controller
{
    private static $jsonFile;
    public function __construct(){
        self::$jsonFile = storage_path('app/database/emotal.json');
    }
    private function dataCacheFile($data, $con){
        $fileExist = file_exists(self::$jsonFile);
        //check if file exist
        if (!$fileExist) {
            //if file is delete will make new json file
            $emotalData = json_decode(Emotal::get(),true);
            if (!file_put_contents(self::$jsonFile,json_encode($emotalData, JSON_PRETTY_PRINT))) {
                throw new Exception('Gagal menyimpan file sistem');
            }
        }
        if($con == 'get'){
            //get kategori seniman
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = null;
            foreach($jsonData as $key => $item){
                if (isset($item['id_emotal']) && $item['id_emotal'] == $data['id_emotal']) {
                    $result = $jsonData[$key];
                }
            }
            if($result === null){
                throw new Exception('Data kategori tidak ditemukan');
            }
            return $result;
        }else if($con == 'tambah'){
            //tambah kategori seniman
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            $new[$data['id_emotal']] = $data;
            $jsonData = array_merge($jsonData, $new);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }else if($con == 'update'){
            //update kategori seniman
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['id_emotal']) && $item['id_emotal'] == $data['id_emotal']) {
                    $newData = [
                        'id_emotal' => $data['id_emotal'],
                        'nama_kategori' => $data['nama_kategori_seniman'],
                        'singkatan_kategori' => $data['singkatan_kategori']
                    ];
                    $jsonData[$key] = $newData;
                    break;
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }else if($con == 'hapus'){
            //hapus kategori seniman
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['id_emotal']) && $item['id_emotal'] == $data['id_emotal']) {
                    unset($jsonData[$key]);
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }
    }
=======
class EmotalController extends Controller
{
>>>>>>> 232e5e39cf66ed80177d83bd2d42a0be4394b069
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
            'deskripsi.required' => 'deskripsi artikel wajib di isi',
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
        Storage::disk('emotal')->put('foto/' . $fotoName, file_get_contents($file));
        $ins = Emotal::insert([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $fotoName
        ]);
        if(!$ins){
            return response()->json(['status'=>'error','message'=>'Gagal menambahkan data Emotal'], 500);
        }
<<<<<<< HEAD
        $this->dataCacheFile([
            'id_emotal' => $ins,
            'nama_kategori_seniman'=>$request->input('nama'),
            'singkatan_kategori'=>strtoupper($request->input('singkatan'))
        ],'tambah');
=======
>>>>>>> 232e5e39cf66ed80177d83bd2d42a0be4394b069
        return response()->json(['status'=>'success','message'=>'Data Emotal berhasil ditambahkan']);
    }
    public function editEmotal(Request $request){
        $validator = Validator::make($request->only('id_emotal','judul', 'deskripsi', 'link_video', 'rentang_usia', 'foto'), [
            'id_emotal' => 'required',
            'judul' => 'required|min:6|max:50',
            'deskripsi' => 'required',
            'link_video' => 'nullable',
            'rentang_usia' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'id_emotal.required' => 'ID emotal wajib di isi',
            'judul.required' => 'Judul wajib di isi',
            'judul.min' => 'Judul minimal 6 karakter',
            'judul.max' => 'Judul maksimal 50 karakter',
            'deskripsi.required' => 'deskripsi artikel wajib di isi',
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
        $emosiMental = Emotal::select('foto')->where('id_emotal',$request->input('id_emotal'))->limit(1)->get()[0];
        if (!$emosiMental) {
            return response()->json(['status' =>'error','message'=>'Data Emotal tidak ditemukan'], 400);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            $destinationPath = storage_path('app/emotal/');
            $fileToDelete = $destinationPath . $emosiMental['foto'];
            if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
                unlink($fileToDelete);
            }
            Storage::disk('emotal')->delete('foto/'. $emosiMental['foto']);
            $fotoName = $file->hashName();
            Storage::disk('emotal')->put('foto/' . $fotoName, file_get_contents($file));
        }
        $edit = $emosiMental->where('id_emotal',$request->input('id_emotal'))->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $request->hasFile('foto') ? $fotoName : $emosiMental['foto'],
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Emotal'], 500);
        }
<<<<<<< HEAD
        $this->dataCacheFile([
            'id_emotal' => $request->input('id_emotal'),
            'nama_kategori_seniman' => $request->input('nama'),
            'singkatan_kategori' => strtoupper($request->input('singkatan'))
        ],'update');
=======
>>>>>>> 232e5e39cf66ed80177d83bd2d42a0be4394b069
        return response()->json(['status' =>'success','message'=>'Data Emotal berhasil di perbarui']);
    }
    public function deleteEmotal(Request $request){
        $validator = Validator::make($request->only('id_emotal'), [
            'id_emotal' => 'required',
        ], [
            'id_emotal.required' => 'ID emotal wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $emosiMental = Emotal::find($request->input('id_emotal'));
        if (!$emosiMental) {
            return response()->json(['status' => 'error', 'message' => 'Data Emotal tidak ditemukan'], 400);
        }
        //delete all photo
        $destinationPath = storage_path('app/emotal/');
        $fileToDelete = $destinationPath . $emosiMental->foto;
        if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
            unlink($fileToDelete);
        }
        Storage::disk('emotal')->delete('/'.$emosiMental->foto);
        // GaleriEmosiMental::where('id_emotal',$request->input('id_emotal'))->delete();
        if (!Emotal::where('id_emotal',$request->input('id_emotal'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Emotal'], 500);
        }
<<<<<<< HEAD
        $this->dataCacheFile(['id_emotal' => $request->input('id_emotal')],'hapus');
=======
>>>>>>> 232e5e39cf66ed80177d83bd2d42a0be4394b069
        return response()->json(['status' => 'success', 'message' => 'Data Emotal berhasil dihapus']);
    }
}