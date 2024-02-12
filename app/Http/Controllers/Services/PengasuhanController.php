<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\GaleriPengasuhan;
use App\Models\Pengasuhan;
class PengasuhanController extends Controller
{
    public function tambahPengasuhan(Request $request){
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
            'foto.required' => 'Foto pengasuhan wajib di isi',
            'foto.image' => 'Foto pengasuhan harus berupa gambar',
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
            return response()->json(['status'=>'error','message'=>'Foto pengasuhan wajib di isi'], 400);
        }
        $file = $request->file('foto');
        if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
            return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
        }
        $fotoName = $file->hashName();
        Storage::disk('pengasuhan')->put('foto/' . $fotoName, file_get_contents($file));
        $ins = Pengasuhan::insert([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $fotoName
        ]);
        if(!$ins){
            return response()->json(['status'=>'error','message'=>'Gagal menambahkan data Pengasuhan'], 500);
        }
        return response()->json(['status'=>'success','message'=>'Data Pengasuhan berhasil ditambahkan']);
    }
    public function editPengasuhan(Request $request){
        $validator = Validator::make($request->only('id_pengasuhan','judul', 'deskripsi', 'link_video', 'rentang_usia', 'foto'), [
            'id_pengasuhan' => 'required',
            'judul' => 'required|min:6|max:50',
            'deskripsi' => 'required',
            'link_video' => 'nullable',
            'rentang_usia' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ], [
            'id_pengasuhan.required' => 'ID pengasuhan wajib di isi',
            'judul.required' => 'Judul wajib di isi',
            'judul.min' => 'Judul minimal 6 karakter',
            'judul.max' => 'Judul maksimal 50 karakter',
            'deskripsi.required' => 'deskripsi artikel wajib di isi',
            'rentang_usia.required' => 'Rentang usia wajib di isi',
            'foto.required' => 'Foto pengasuhan wajib di isi',
            'foto.image' => 'Foto pengasuhan harus berupa gambar',
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
        $pengasuhan = Pengasuhan::select('foto')->where('id_pengasuhan',$request->input('id_pengasuhan'))->limit(1)->get()[0];
        if (!$pengasuhan) {
            return response()->json(['status' =>'error','message'=>'Data Pengasuhan tidak ditemukan'], 400);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            $destinationPath = storage_path('app/pengasuhan/');
            $fileToDelete = $destinationPath . $pengasuhan['foto'];
            if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
                unlink($fileToDelete);
            }
            Storage::disk('pengasuhan')->delete('foto/'. $pengasuhan['foto']);
            $fotoName = $file->hashName();
            Storage::disk('pengasuhan')->put('foto/' . $fotoName, file_get_contents($file));
        }
        $edit = $pengasuhan->where('id_pengasuhan',$request->input('id_pengasuhan'))->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link_video' => $request->input('link_video'),
            'rentang_usia' => $request->input('rentang_usia'),
            'foto' => $request->hasFile('foto') ? $fotoName : $pengasuhan['foto'],
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Pengasuhan'], 500);
        }
        return response()->json(['status' =>'success','message'=>'Data Pengasuhan berhasil di perbarui']);
    }
    public function deletePengasuhan(Request $request){
        $validator = Validator::make($request->only('id_pengasuhan'), [
            'id_pengasuhan' => 'required',
        ], [
            'id_pengasuhan.required' => 'ID pengasuhan wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $pengasuhan = Pengasuhan::find($request->input('id_pengasuhan'));
        if (!$pengasuhan) {
            return response()->json(['status' => 'error', 'message' => 'Data Pengasuhan tidak ditemukan'], 400);
        }
        //delete all photo
        $destinationPath = storage_path('app/pengasuhan/');
        $fileToDelete = $destinationPath . $pengasuhan->foto;
        if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
            unlink($fileToDelete);
        }
        Storage::disk('pengasuhan')->delete('/'.$pengasuhan->foto);
        GaleriPengasuhan::where('id_pengasuhan',$request->input('id_pengasuhan'))->delete();
        if (!Pengasuhan::where('id_pengasuhan',$request->input('id_pengasuhan'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Product'], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'Data Pengasuhan berhasil dihapus']);
    }
}