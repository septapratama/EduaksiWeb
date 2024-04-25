<?php
namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\JwtController;
use App\http\controllers\Services\MailController;
use App\Models\User;
use App\Models\Verifikasi;
use App\Models\RefreshToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class MasyarakatController extends Controller
{
    public function getChangePass(Request $request, User $user, $any = null){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'code' =>'nullable'
        ],[
            'email.required'=>'Email wajib di isi',
            'email.email'=>'Email yang anda masukkan invalid',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors = $errorMessages[0];
            }
            return response()->json(['status' => 'error', 'message' => $errors], 400);
        }
        $email = $request->input('email');
        $code = $request->input('code');
        //check email on table user
        $user = User::select('nama_lengkap')->whereRaw("BINARY email = ?",[$request->input('email')])->limit(1)->get()[0];
        if (!$user) {
            return response()->json(['status'=>'error','message'=>'Email tidak terdaftar !'],400);
        }
        if(Str::startsWith($request->path(), 'verify/password') && $request->isMethod('get')){
            $email = $request->query('email');
            //check if user have create reset password
            $verify = Verifikasi::select('link','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'email')->limit(1)->get()[0];
            if (!$verify) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            if ($verify->link !== $any) {
                return response()->json(['status'=>'error','message'=>'Link invalid'],400);
            }
            //check if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (!Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                $deleted = DB::table('verifikasi')->whereRaw("BINARY email = ? AND deskripsi = 'password'", [$email])->delete();
                return response()->json(['status'=>'error','message'=>'link expired'],400);
            }
            return response()->json(['status'=>'success','message'=>'otp anda benar silahkan ganti password']);
        }else{
            //check if user have create reset password
            $verify = Verifikasi::select('kode_otp','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'email')->limit(1)->get()[0];
            if (!$verify) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            if ($verify['kode_otp'] !== $code) {
                return response()->json(['status'=>'error','message'=>'Kode OTP invalid'],400);
            }
            //check if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (!Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                $deleted = DB::table('verifikasi')->whereRaw("BINARY email = ? AND deskripsi = 'password'", [$email])->delete();
                return response()->json(['status'=>'error','message'=>'Kode otp expired'],400);
            }
            return response()->json(['status'=>'success','message'=>'otp anda benar silahkan ganti password']);
        }
    }
    public function changePassEmail(Request $request, User $user, JWTController $jwtController, RefreshToken $refreshToken){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'nama'=>'nullable',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:25',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            'password_confirm' => [
                'required',
                'string',
                'min:8',
                'max:25',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            'code' => 'nullable',
            'link' => 'nullable',
            'description'=>'required'
        ],[
            'email.required'=>'Email wajib di isi',
            'email.email'=>'Email yang anda masukkan invalid',
            'password.required'=>'Password wajib di isi',
            'password.min'=>'Password minimal 8 karakter',
            'password.max'=>'Password maksimal 25 karakter',
            'password.regex'=>'Password baru wajib terdiri dari 1 huruf besar, huruf kecil, angka dan karakter unik',
            'password_confirm.required'=>'Password konfirmasi konfirmasi harus di isi',
            'password_confirm.min'=>'Password konfirmasi minimal 8 karakter',
            'password_confirm.max'=>'Password konfirmasi maksimal 25 karakter',
            'password_confirm.regex'=>'Password konfirmasi terdiri dari 1 huruf besar, huruf kecil, angka dan karakter unik',
            'description.required'=>'Deskripsi wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors = $errorMessages[0];
            }
            return response()->json(['status' => 'error', 'message' => $errors], 400);
        }
        $email = $request->input('email');
        $pass = $request->input("password");
        $pass1 = $request->input("password_confirm");
        $code = $request->input('code');
        $link = $request->input('link');
        $desc = $request->input('description');
        if($pass !== $pass1){
            return response()->json(['status'=>'error','message'=>'Password Harus Sama'],400);
        }
        //check email on table user
        $user = User::select('nama_lengkap')->whereRaw("BINARY email = ?",[$request->input('email')])->limit(1)->get()[0];
        if (!$user) {
            return response()->json(['status'=>'error','message'=>'Email tidak terdaftar !'],400);
        }
        if(is_null($link) || empty($link)){
            //check if user have create reset password
            $verify = Verifikasi::select('kode_otp','send','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'password')->limit(1)->get()[0];
            if (!$verify) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            //check code
            if ($verify['kode_otp'] !== $code) {
                return response()->json(['status'=>'error','message'=>'Code invalid'],400);
            }
            //checking if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (!Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                $deleted = DB::table('verifikasi')->whereRaw("BINARY email = ? AND deskripsi = 'password'",[$email])->delete();
                return response()->json(['status'=>'error','message'=>'token expired'],400);
            }
            if(is_null(DB::table('users')->whereRaw("BINARY email = ?",[$email])->update(['password'=>Hash::make($pass)]))){
                return response()->json(['status'=>'error','message'=>'error update password'],500);
            }
            $deleted = DB::table('verifikasi')->whereRaw("BINARY email = ?",[$email])->delete();
            if(!$deleted){
                return response()->json(['status'=>'error','message'=>'error update password'],500);
            }
            return response()->json(['status'=>'success','message'=>'ganti password berhasil silahkan login']);
        }else{
            //check if user have create reset password
            $verify = Verifikasi::select('link','send','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'password')->limit(1)->get()[0];
            if (!$verify) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            //check link
            if ($verify->link !== $link) {
                return response()->json(['status'=>'error','message'=>'Link invalid'],400);
            }
            //checking if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (!Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                $deleted = DB::table('verifikasi')->whereRaw("BINARY email = ? AND deskripsi = 'password'",[$email])->delete();
                return response()->json(['status'=>'error','message'=>'link expired'],400);
            }
            if(is_null(DB::table('users')->whereRaw("BINARY email = ?",[$email])->update(['password'=>Hash::make($pass)]))){
                return response()->json(['status'=>'error','message'=>'error update password'],500);
            }
            $deleted = DB::table('verifikasi')->whereRaw("BINARY email = ? AND deskripsi = 'password'",[$email])->delete();
            if(!$deleted){
                return response()->json(['status'=>'error','message'=>'error update password'],500);
            }
            return response()->json(['status'=>'success','message'=>'ganti password berhasil silahkan login']);
        }
    }
    public function createUser(Request $request, MailController $mailController, Verifikasi $verify){
        $validator = Validator::make($request->only('nama_lengkap','jenis_kelamin','no_telpon','tanggal_lahir','tempat_lahir','email','password','foto'), [
            'nama_lengkap'=>'required',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
            'no_telpon' => 'nullable|digits_between:10,13',
            'email'=>'required | email',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:25',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\p{P}\p{S}])[\p{L}\p{N}\p{P}\p{S}]+$/u',
            ],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ],[
            'nama_lengkap.required'=>'Nama Lengkap wajib di isi',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'no_telpon.digits_between' => 'Nomor telepon tidak boleh lebih dari 13 karakter',
            'email.required'=>'Email wajib di isi',
            'email.email'=>'Email yang anda masukkan invalid',
            'password.required'=>'Password wajib di isi',
            'password.min'=>'Password minimal 8 karakter',
            'password.max'=>'Password maksimal 25 karakter',
            'password.regex'=>'Password baru wajib terdiri dari 1 huruf besar, huruf kecil, angka dan karakter unik',
            'foto.image' => 'Foto harus berupa gambar',
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
        //check data user
        if (User::select('password','foto')->whereRaw("BINARY email = ?",[$request->input('email')])->exists()) {
            return response()->json(['status' => 'error', 'message' => 'Data masyarakat tidak ditemukan'], 404);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            $destinationPath = storage_path('app/user/');
            $fotoName = $file->hashName();
            $fileData = Crypt::encrypt(file_get_contents($file));
            Storage::disk('user')->put('/' . $fotoName, $fileData);
        }
        //create user
        $insert = User::insert([
            'uuid' =>  Str::uuid(),
            'nama_lengkap' => $request->input('nama_lengkap'),
            'no_telpon' => $request->has('no_telpon') ? $request->input('no_telpon') : '',
            'jenis_kelamin' => $request->input('jenis_kelamin', null),
            'role' => 'user',
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'foto' => $request->hasFile('foto') ? $fotoName : '',
            'verifikasi' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        if (!$insert) {
            return ['status'=>'error','message'=>'gagal register'];
        }
        $email = $mailController->createVerifyEmail($request,$verify);
        if($email['status'] == 'error'){
            return ['status'=>'error','message'=>$email['message']];
        }else{
            return ['status'=>'success','message'=>$email['message'],'data'=>$email['data']];
        }
    }
    public function updateUser(Request $request, MailController $mailController, Verifikasi $verify){
        $validator = Validator::make($request->only('nama_lengkap','jenis_kelamin','no_telpon','tanggal_lahir','tempat_lahir','email_new','password','foto'), [
            'nama_lengkap'=>'required',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_telpon' => 'required|digits_between:10,13',
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:' . now()->toDateString()],
            'tempat_lahir' => 'required',
            'email_new'=>'nullable | email',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:25',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\p{P}\p{S}])[\p{L}\p{N}\p{P}\p{S}]+$/u',
            ],
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ],[
            'nama_lengkap.required'=>'Nama Lengkap wajib di isi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib di isi',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            'no_telpon.required' => 'Nomor telepon wajib di isi',
            'no_telpon.digits_between' => 'Nomor telepon tidak boleh lebih dari 13 karakter',
            'tanggal_lahir.required' => 'Tanggal lahir wajib di isi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            'tanggal_lahir.before_or_equal' => 'Tanggal Lahir harus Sebelum dari tanggal sekarang',
            'tempat_lahir.required' => 'Tempat lahir wajib di isi',
            'email_new.email'=>'Email yang anda masukkan invalid',
            'password.required'=>'Password wajib di isi',
            'password.min'=>'Password minimal 8 karakter',
            'password.max'=>'Password maksimal 25 karakter',
            'password.regex'=>'Password baru wajib terdiri dari 1 huruf besar, huruf kecil, angka dan karakter unik',
            'foto.required' => 'Foto wajib di isi',
            'foto.image' => 'Foto harus berupa gambar',
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
        //check data user
        $user = User::select('password','foto')->whereRaw("BINARY email = ?",[$request->input('email')])->limit(1)->get()[0];
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Data masyarakat tidak ditemukan'], 404);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            $destinationPath = storage_path('app/user/');
            $fileToDelete = $destinationPath . $user['foto'];
            if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
                unlink($fileToDelete);
            }
            Storage::disk('user')->delete('/'.$user['foto']);
            $fotoName = $file->hashName();
            $fileData = Crypt::encrypt(file_get_contents($file));
            Storage::disk('user')->put('/' . $fotoName, $fileData);
        }
        //update user
        $updatedAdmin = User::whereRaw("BINARY email = ?",[$request->input('email')])->update([
            'email'=> (empty($request->input('email_new')) || is_null($request->input('email_new'))) ? $request->input('email') : $request->input('email_new'),
            'nama_lengkap'=>$request->input('nama_lengkap'),
            'no_telpon'=>$request->input('no_telpon'),
            'jenis_kelamin'=>$request->input('jenis_kelamin'),
            // 'tanggal_lahir'=>$request->input('tanggal_lahir'),
            'tanggal_lahir'=>Carbon::createFromFormat('d-m-Y', $request->input('tanggal_lahir'))->format('Y-m-d'),
            'tempat_lahir'=>$request->input('tempat_lahir'),
            'role'=>$request->input('role'),
            'password'=> (empty($request->input('password')) || is_null($request->input('password'))) ? $user['password']: Hash::make($request->input('password')),
            'foto' => $request->hasFile('foto') ? $fotoName : $user['foto'],
            'verifikasi'=>true,
            'updated_at' => Carbon::now(),
        ]);
        if (!$updatedAdmin) {
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data Masyarakat'], 500);
        }
        return response()->json(['status'=>'success','message'=>'Data masyarakat berhasil diperbarui']);
    }
    public function getVerifyEmail(Request $request, User $user, $any = null){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'link' => 'nullable',
        ],[
            'email.required'=>'Email wajib di isi',
            'email.email'=>'Email yang anda masukkan invalid',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors = $errorMessages[0];
            }
            return response()->json(['status' => 'error', 'message' => $errors], 400);
        }
        $email = $request->input('email');
        if(!User::select("email")->whereRaw("BINARY email = ?",[$email])->limit(1)->exists()){
            return response()->json(['status'=>'error','message'=>'Email invalid']);
        }else{
            if($request->path() === '/verify/email/*' && $request->isMethod("get")){
                if(Verifikasi::select("link")->whereRaw("BINARY link = ?",[$any])->limit(1)->exists()){
                    return view('page.verifyEmail');
                }else{
                    return response()->json(['status'=>'error','message'=>'invalid token'],400);
                }
            }
        }
    }
    public function verifyEmail(Request $request, User $user, $any = null){
        $email = $request->query('email');
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'code' =>'nullable'
        ],[
            'email.required'=>'Email wajib di isi',
            'email.email'=>'Email yang anda masukkan invalid',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors = $errorMessages[0]; 
            }
            return response()->json(['status' => 'error', 'message' => $errors], 400);
        }
        $email = $request->input('email');
        $code = $request->input('code');
        //check email on table user
        $user = User::select('nama_lengkap')->whereRaw("BINARY email = ?",[$request->input('email')])->limit(1)->get()[0];
        if (!$user) {
            return response()->json(['status'=>'error','message'=>'Email tidak terdaftar !'],400);
        }
        if(Str::startsWith($request->path(), 'verify/email') && $request->isMethod('get')){
            //check if user have create verify email
            $verify = Verifikasi::select('link','send','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'email')->limit(1)->get()[0];
            if (!$verify) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            //check link
            if ($verify->link !== $any) {
                return response()->json(['status'=>'error','message'=>'link invalid'],400);
            }
            //check if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (!Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                $deleted = DB::table('verifikasi')->whereRaw("BINARY email = ? AND deskripsi = 'email'", [$email])->delete();
                return response()->json(['status'=>'error','message'=>'link expired'],400);
            }
            if(is_null(DB::table('users')->whereRaw("BINARY email = ?",[$email])->update(['email_verified'=>true]))){
                return response()->json(['status'=>'error','message'=>'error verify email'],500);
            }
            $deleted = DB::table('verifikasi')->whereRaw("BINARY email = ?",[$email])->delete();
            if(!$deleted){
                return response()->json(['status'=>'error','message'=>'Error verifikasi Email'],500);
            }else{
                return response()->json(['status'=>'success','message'=>'verifikasi email berhasil silahkan login']);
            }
        }else{
            //check if user have create verify email
            $verify = Verifikasi::select('kode_otp','send','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'email')->limit(1)->get()[0];
            if (!$verify) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            //check code
            if ($verify['kode_otp'] !== $code) {
                return response()->json(['status'=>'error','message'=>'token invalid'],400);
            }
            //check if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (!Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                $deleted = DB::table('verifikasi')->whereRaw("BINARY email = ? AND deskripsi = 'email'", [$email])->delete();
                return response()->json(['status'=>'error','message'=>'token expired'],400);
            }
            if(is_null(DB::table('users')->whereRaw("BINARY email = ?",[$email])->update(['email_verified'=>true]))){
                return response()->json(['status'=>'error','message'=>'error verifikasi email'],500);
            }
            $deleted = DB::table('verifikasi')->whereRaw("BINARY email = ?",[$email])->delete();
            if(!$deleted){
                return response()->json(['status'=>'error','message'=>'error verifikasi email'],500);
            }
            return response()->json(['status'=>'success','message'=>'verifikasi email berhasil silahkan login']);
        }
    }
    public function getProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
        ],[
            'email.required'=>'Email wajib di isi',
            'email.email'=>'Email yang anda masukkan invalid',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors = $errorMessages[0]; 
            }
            return response()->json(['status' => 'error', 'message' => $errors], 400);
        }
        //check email on table user
        $user = User::select('uuid as id_user', 'nama_lengkap', 'jenis_kelamin', 'no_telpon', 'email' ,'foto')->whereRaw("BINARY email = ?",[$request->input('email')])->first();
        if (is_null($user)) {
            return response()->json(['status'=>'error','message'=>'Email tidak terdaftar !'],400);
        }
        return response()->json(['status'=>'error','message'=>'Profile ada', 'data'=>$user],400);
    }
    public function updateProfile(Request $request){
        $userAuth = $request->input('user_auth');
        $validator = Validator::make($request->only('email_new', 'nama_lengkap', 'jenis_kelamin', 'no_telpon', 'foto'),
            [
                'email_new'=>'nullable|email',
                'nama_lengkap' => 'required|max:50',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'no_telpon' => 'required|digits_between:11,13',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            ],[
                'email_new.email'=>'Email yang anda masukkan invalid',
                'nama_lengkap.required' => 'Nama admin wajib di isi',
                'nama_lengkap.max' => 'Nama admin maksimal 50 karakter',
                'jenis_kelamin.required' => 'Jenis kelamin wajib di isi',
                'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
                'no_telpon.required' => 'Nomor telepon wajib di isi',
                'no_telpon.digits_between' => 'Nomor telepon tidak boleh lebih dari 13 karakter',
                'foto.image' => 'Foto Admin harus berupa gambar',
                'foto.mimes' => 'Format foto admin tidak valid. Gunakan format jpeg, png, jpg',
                'foto.max' => 'Ukuran foto admin tidak boleh lebih dari 5MB',
            ],
        );
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        //check email
        $user = User::select('email','foto')->whereRaw("BINARY email = ?",[$request->input('user_auth')['email']])->first();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Admin tidak ditemukan'], 400);
        }
        //process file foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
                return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
            }
            $destinationPath = storage_path('app/admin/');
            $fileToDelete = $destinationPath . $user['foto'];
            if (file_exists($fileToDelete) && !is_dir($fileToDelete)) {
                unlink($fileToDelete);
            }
            Storage::disk('admin')->delete('foto/'.$user['foto']);
            $fotoName = $file->hashName();
            $fileData = Crypt::encrypt(file_get_contents($file));
            Storage::disk('admin')->put('foto/' . $fotoName, $fileData);
        }
        // $passOld = $request->input('password_old');
        // $pass = $request->input('password');
        // $passConfirm = $request->input('password_confirm');
        // if($pass !== $passConfirm){
        //     return response()->json(['status'=>'error','message'=>'Password Harus Sama'],400);
        // }
        // //check email
        // $user = User::select('password')->whereRaw("BINARY email = ?",[$request->input('user_auth')['email']])->first();
        // if (!$user) {
        //     return response()->json(['status' => 'error', 'message' => 'Admin tidak ditemukan'], 400);
        // }
        // if(!password_verify($passOld,$user->password)){
        //     return response()->json(['status'=>'error','message'=>'Password salah'],400);
        // }
        //update profile
        $updateProfile = User::whereRaw("BINARY email = ?",[$request->input('user_auth')['email']])->update([
            'email'=> (empty($request->input('email_new')) || is_null($request->input('email_new'))) ? $request->input('user_auth')['email'] : $request->input('email_new'),
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_telpon' => $request->input('no_telpon'),
            'foto' => $request->hasFile('foto') ? $fotoName : $user['foto'],
            'updated_at'=> Carbon::now()
        ]);
        if (!$updateProfile) {
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui Profile'], 500);
        }
        return response()->json(['status' => 'error', 'message' => 'Profile Anda berhasil diperbarui']);
        //update cookie
        // $jwtController = new JWTController();
        // $email = $request->has('email_new') ? $request->input('email_new') : $request->input('user_auth')['email'];
        // $data = $jwtController->createJWTWebsite($email,new RefreshToken());
        // if(is_null($data)){
        //     return response()->json(['status'=>'error','message'=>'create token error'],500);
        // }else{
        //     if($data['status'] == 'error'){
        //         return response()->json(['status'=>'error','message'=>$data['message']],400);
        //     }else{
        //         $data1 = ['email'=>$email,'number'=>$data['number']];
        //         $encoded = base64_encode(json_encode($data1));
        //         return response()->json(['status'=>'success','message'=>'Profile Anda berhasil di perbarui'])
        //         ->cookie('token1',$encoded,time()+intval(env('JWT_ACCESS_TOKEN_EXPIRED')))
        //         ->cookie('token2',$data['data']['token'],time() + intval(env('JWT_ACCESS_TOKEN_EXPIRED')))
        //         ->cookie('token3',$data['data']['refresh'],time() + intval(env('JWT_REFRESH_TOKEN_EXPIRED')));
        //     }
        // }
    }
    public function logout(Request $request, JWTController $jwtController){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'number' =>'required|max:2|integer'
        ],[
            'email.required'=>'Email wajib di isi',
            'email.email'=>'Email yang anda masukkan invalid',
            'number.required'=>'Token wajib di isi',
            'number.max'=>'Token maksimal 2',
            'number.integer'=>'Token harus berupa angka',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors = $errorMessages[0]; 
            }
            return response()->json(['status' => 'error', 'message' => $errors], 400);
        }
        if (!RefreshToken::whereRaw("BINARY email = ?",[$request->input('email')])->where('number',$request->input('number'))->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal Logout'], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'Logout berhasil silahkan login kembali']);
    }
}
?>