<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\GaleriNutrisi;
use App\Models\Nutrisi;
class NutrisiController extends Controller
{
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
        Storage::disk('nutrisi')->put('foto/' . $fotoName, file_get_contents($file));
        $ins = Nutrisi::insert([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $fotoName
        ]);
        if(!$ins){
            return response()->json(['status'=>'error','message'=>'Gagal menambahkan data Nutrisi'], 500);
        }
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
        $nutrisi = Nutrisi::select('foto')->where('id_nutrisi',$request->input('id_nutrisi'))->limit(1)->get()[0];
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
            Storage::disk('nutrisi')->delete('foto/'. $nutrisi['foto']);
            $fotoName = $file->hashName();
            Storage::disk('nutrisi')->put('foto/' . $fotoName, file_get_contents($file));
        }
        $edit = $nutrisi->where('id_nutrisi',$request->input('id_nutrisi'))->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $request->hasFile('foto') ? $fotoName : $nutrisi['foto'],
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Nutrisi'], 500);
        }
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
        $nutrisi = Nutrisi::find($request->input('id_nutrisi'));
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
        GaleriNutrisi::where('id_nutrisi',$request->input('id_nutrisi'))->delete();
        if (!Nutrisi::where('id_nutrisi',$request->input('id_nutrisi'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Nutrisi'], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'Data Nutrisi berhasil dihapus']);
    }
}