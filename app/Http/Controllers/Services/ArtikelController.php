<?php
namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\GaleriDigitalLiterasi;
use App\Models\Disi;
use Exception;
class ArtikelController extends Controller
{
    private static $jsonFile;
    public function __construct(){
        self::$jsonFile = storage_path('app/database/disi.json');
    }
    public function dataCacheFile($data = null, $con, $limit = null, $col = null){
        $fileExist = file_exists(self::$jsonFile);
        //check if file exist
        if (!$fileExist) {
            //if file is delete will make new json file
            $disiData = json_decode(Disi::get(),true);
            if (!file_put_contents(self::$jsonFile,json_encode($disiData, JSON_PRETTY_PRINT))) {
                throw new Exception('Gagal menyimpan file sistem');
            }
        }
        if($con == 'get_id'){
            $jsonData = json_decode(file_get_contents(self::$jsonFile), true);
            $result = null;
            foreach($jsonData as $key => $item){
                if (isset($item['id_disi']) && $item['id_disi'] == $data['id_disi']) {
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
                //tambah disi data
                $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
                $new[$data['id_disi']] = $data;
                $jsonData = array_merge($jsonData, $new);
                file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
            }
        }else if($con == 'update'){
            //update disi data
            $jsonData = json_decode(file_get_contents(self::$jsonFile),true);
            foreach($jsonData as $key => $item){
                if (isset($item['id_disi']) && $item['id_disi'] == $data['id_disi']) {
                    $newData = [
                        'uuid' => $data['id_emotal'],
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
                if (isset($item['id_disi']) && $item['id_disi'] == $data['id_disi']) {
                    unset($jsonData[$key]);
                }
            }
            $jsonData = array_values($jsonData);
            file_put_contents(self::$jsonFile,json_encode($jsonData, JSON_PRETTY_PRINT));
        }
    }
    public function tambahArtikel(Request $request){
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
            'foto.required' => 'Foto disi wajib di isi',
            'foto.image' => 'Foto disi harus berupa gambar',
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
            return response()->json(['status'=>'error','message'=>'Foto disi wajib di isi'], 400);
        }
        $file = $request->file('foto');
        if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
            return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
        }
        $fotoName = $file->hashName();
        Storage::disk('disi')->put($fotoName, file_get_contents($file));
        $ins = Disi::insert([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $fotoName
        ]);
        if(!$ins){
            return response()->json(['status'=>'error','message'=>'Gagal menambahkan data Disi'], 500);
        }
        $this->dataCacheFile([
            'id_disi' => $ins,
            'nama_kategori_seniman'=>$request->input('nama'),
            'singkatan_kategori'=>strtoupper($request->input('singkatan'))
        ],'tambah');
        return response()->json(['status'=>'success','message'=>'Data Disi berhasil ditambahkan']);
    }
    public function editArtikel(Request $request){
        $validator = Validator::make($request->only('id_disi','judul', 'deskripsi', 'link_video', 'rentang_usia', 'foto'), [
            'id_disi' => 'required',
            'judul' => 'required|min:6|max:50',
            'deskripsi' => 'required',
            'link_video' => 'nullable',
            'rentang_usia' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'id_disi.required' => 'ID disi wajib di isi',
            'judul.required' => 'Judul wajib di isi',
            'judul.min' => 'Judul minimal 6 karakter',
            'judul.max' => 'Judul maksimal 50 karakter',
            'deskripsi.required' => 'deskripsi artikel wajib di isi',
            'rentang_usia.required' => 'Rentang usia wajib di isi',
            'foto.required' => 'Foto disi wajib di isi',
            'foto.image' => 'Foto disi harus berupa gambar',
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
        $disi = Disi::select('foto')->where('id_disi',$request->input('id_disi'))->limit(1)->get()[0];
        if (!$disi) {
            return response()->json(['status' =>'error','message'=>'Data Disi tidak ditemukan'], 400);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            $destinationPath = storage_path('app/disi/');
            $fileToDelete = $destinationPath . $disi['foto'];
            if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
                unlink($fileToDelete);
            }
            Storage::disk('disi')->delete('foto/'. $disi['foto']);
            $fotoName = $file->hashName();
            Storage::disk('disi')->put('foto/' . $fotoName, file_get_contents($file));
        }
        $edit = $disi->where('id_disi',$request->input('id_disi'))->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $request->hasFile('foto') ? $fotoName : $disi['foto'],
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Disi'], 500);
        }
        $this->dataCacheFile([
            'id_disi' => $request->input('id_disi'),
            'nama_kategori_seniman' => $request->input('nama'),
            'singkatan_kategori' => strtoupper($request->input('singkatan'))
        ],'update');
        return response()->json(['status' =>'success','message'=>'Data Disi berhasil di perbarui']);
    }
    public function deleteArtikel(Request $request){
        $validator = Validator::make($request->only('id_disi'), [
            'id_disi' => 'required',
        ], [
            'id_disi.required' => 'ID disi wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $disi = Disi::find($request->input('id_disi'));
        if (!$disi) {
            return response()->json(['status' => 'error', 'message' => 'Data Disi tidak ditemukan'], 400);
        }
        //delete all photo
        $destinationPath = storage_path('app/disi/');
        $fileToDelete = $destinationPath . $disi->foto;
        if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
            unlink($fileToDelete);
        }
        Storage::disk('disi')->delete('/'.$disi->foto);
        // GaleriDigitalLiterasi::where('id_disi',$request->input('id_disi'))->delete();
        if (!Disi::where('id_disi',$request->input('id_disi'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Disi'], 500);
        }
        $this->dataCacheFile(['id_disi' => $request->input('id_disi')],'hapus');
        return response()->json(['status' => 'success', 'message' => 'Data Disi berhasil dihapus']);
    }
}