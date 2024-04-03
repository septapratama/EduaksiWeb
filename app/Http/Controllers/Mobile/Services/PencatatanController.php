<?php
namespace App\Http\Controllers\Mobile\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Pencatatan;
use Carbon\Carbon;
class PencatatanController extends Controller
{
    public function tambahPencatatan(Request $request){
        $validator = Validator::make($request->only('nama_anak', 'umur', 'golongan_darah', 'hasil_gizi'), [
            'nama_anak' => 'required|string|min:6|max:50',
            'umur' => 'required|integer',
            'golongan_darah' => 'nullable|string|in:A,A-,B,B-,AB,AB-,O,O-',
            'hasil_gizi' => 'required|string',
        ], [
            'nama_anak.required' => 'Nama Anak wajib di isi',
            'nama_anak.min' => 'Nama Anak minimal 6 karakter',
            'nama_anak.max' => 'Nama Anak maksimal 50 karakter',
            'umur.integer' => 'Umur harus berupa angka',
            'umur.required' => 'Umur wajib di isi',
            'golongan_darah.in' => 'Golongan Darah tidak valid',
            'hasil_gizi.required' => 'Rentang usia wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $user = User::select('id_user')->whereRaw("BINARY email = ?",[$request->input('email_admin')])->limit(1)->get()[0];
        $ins = Pencatatan::insert([
            'nama_anak' => $request->input('nama_anak'),
            'umur' => $request->input('umur'),
            'gol_darah' => $request->input('golongan_darah'),
            'hasil_gizi' => $request->input('hasil_gizi'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'id_user' => $user->id_user,
        ]);
        if(!$ins){
            return response()->json(['status'=>'error','message'=>'Gagal menambahkan data Pencatatan'], 500);
        }
        return response()->json(['status'=>'success','message'=>'Data Pencatatan berhasil ditambahkan']);
    }
    public function editPencatatan(Request $request){
        $validator = Validator::make($request->only('nama_anak', 'umur', 'golongan_darah', 'hasil_gizi'), [
            'nama_anak' => 'required|string|min:6|max:50',
            'umur' => 'required|integer',
            'golongan_darah' => 'nullable|string|in:A,A-,B,B-,AB,AB-,O,O-',
            'hasil_gizi' => 'required|string',
        ], [
            'nama_anak.required' => 'Nama Anak wajib di isi',
            'nama_anak.min' => 'Nama Anak minimal 6 karakter',
            'nama_anak.max' => 'Nama Anak maksimal 50 karakter',
            'umur.integer' => 'Umur harus berupa angka',
            'umur.required' => 'Umur wajib di isi',
            'golongan_darah.in' => 'Golongan Darah tidak valid',
            'hasil_gizi.required' => 'Rentang usia wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $pencatatan = Pencatatan::select('foto')->where('id_pencatatan',$request->input('id_pencatatan'))->limit(1)->get()[0];
        if (!$pencatatan) {
            return response()->json(['status' =>'error','message'=>'Data Pencatatan tidak ditemukan'], 400);
        }
        $user = User::select('id_user')->whereRaw("BINARY email = ?",[$request->input('email_admin')])->limit(1)->get()[0];
        $edit = $pencatatan->where('id_pencatatan',$request->input('id_pencatatan'))->update([
            'nama_anak' => $request->input('nama_anak'),
            'umur' => $request->input('umur'),
            'gol_darah' => $request->input('golongan_darah'),
            'hasil_gizi' => $request->input('hasil_gizi'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'id_user' => $user->id_user,
        ]);
        if(!$edit){
            return response()->json(['status' =>'error','message'=>'Gagal memperbarui data Pencatatan'], 500);
        }
        return response()->json(['status' =>'success','message'=>'Data Pencatatan berhasil di perbarui']);
    }
    public function deletePencatatan(Request $request){
        $validator = Validator::make($request->only('id_pencatatan'), [
            'id_pencatatan' => 'required',
        ], [
            'id_pencatatan.required' => 'ID pencatatan wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $pencatatan = Pencatatan::find($request->input('id_pencatatan'));
        if (!$pencatatan) {
            return response()->json(['status' => 'error', 'message' => 'Data Pencatatan tidak ditemukan'], 400);
        }
        if (!Pencatatan::where('id_pencatatan',$request->input('id_pencatatan'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menghapus data Pencatatan'], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'Data Pencatatan berhasil dihapus']);
    }
}