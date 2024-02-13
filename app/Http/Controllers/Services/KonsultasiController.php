<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Konsultasi;
class KonsultasiController extends Controller
{
    public function tambahKonsultasi(Request $request){
        $validator = Validator::make($request->only('id_konsultasi', 'nama_lengkap', 'jenis_kelamin', 'alamat', 'no_telpon', 'email_konsultasi', 'foto'), [
            'id_konsultasi' => 'required',
            'nama_lengkap' => 'required|max:50',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required',
            'no_telpon' => 'required|digits_between:10,13',
            'email_konsultasi'=>'required|email',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
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
        Storage::disk('konsultasi')->put('foto/' . $fotoName, file_get_contents($file));
        $ins = Konsultasi::insert([
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
            Storage::disk('konsultasi')->delete('foto/'. $konsultasi['foto']);
            $fotoName = $file->hashName();
            Storage::disk('konsultasi')->put('foto/' . $fotoName, file_get_contents($file));
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
        $konsultasi = Konsultasi::find($request->input('id_konsultasi'));
        if (!$konsultasi) {
            return response()->json(['status' => 'error', 'message' => 'Data Konsultasi tidak ditemukan'], 400);
        }
        if (app()->environment('local')) {
            $destinationPath = public_path('img/konsultasi');
        } else {
            $destinationPath = base_path('../public_html/public/img/konsultasi/');
        }
        if (file_exists($destinationPath . $konsultasi->foto_tempat)) {
            unlink($destinationPath . $konsultasi->foto_tempat);
        }
        $konsultasi->delete();
        return response()->json(['status' => 'success', 'message' => 'Data Konsultasi berhasil dihapus']);
    }
}