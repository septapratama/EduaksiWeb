<?php
namespace App\Http\Controllers\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\GaleriDigitalLiterasi;
use App\Models\Disi;
class DisiController extends Controller
{
    public function tambahDisi(Request $request){
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
        Storage::disk('disi')->put('foto/' . $fotoName, file_get_contents($file));
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
        return response()->json(['status'=>'success','message'=>'Data Disi berhasil ditambahkan']);
    }
    public function editDisi(Request $request){
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
        return response()->json(['status' =>'success','message'=>'Data Disi berhasil di perbarui']);
    }
    public function deleteDisi(Request $request){
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
        return response()->json(['status' => 'success', 'message' => 'Data Disi berhasil dihapus']);
    }
}