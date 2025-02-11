<?php
namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\JWTController;
use App\Http\Controllers\Services\MailController;
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
    private function getMimeType($extension)
    {
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            // Add other extensions and MIME types as needed
        ];
        return $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    }
    public function checkFotoProfile(Request $request){
        $userAuth = $request->input('user_auth');
        $userDb = User::select('foto')->whereRaw("BINARY email = ?",[$userAuth['email']])->first();
        if (is_null($userDb)) {
            return response()->json(['status'=>'error','message'=>'Email tidak terdaftar !'],400);
        }
        $filePath = storage_path('app/user/foto/' . $userAuth['foto']);
        if (!empty($userAuth['foto'] && !is_null($userAuth['foto'])) && file_exists($filePath) && is_file($filePath)) {
            return response(Crypt::decrypt(file_get_contents($filePath)))->header('Content-Type', $this->getMimeType(pathinfo($filePath, PATHINFO_EXTENSION)));
        }
        return response()->json(['status'=>'error','message'=>'foto not found'], 404);
    }
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
        $user = User::select('nama_lengkap')->whereRaw("BINARY email = ?",[$request->input('email')])->first();
        if (is_null($user)) {
            return response()->json(['status'=>'error','message'=>'Email tidak terdaftar !'],400);
        }
        if(Str::startsWith($request->path(), 'verify/password') && $request->isMethod('get')){
            $email = $request->query('email');
            //check if user have create reset password
            $verify = Verifikasi::select('link', 'send','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'password')->first();
            if (is_null($verify)) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            if ($verify->link !== $any) {
                return response()->json(['status'=>'error','message'=>'Link invalid'],400);
            }
            //check if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                return response()->json(['status'=>'error','message'=>'link expired'],400);
            }
            return response()->json(['status'=>'success','message'=>'otp anda benar silahkan ganti password']);
        }else{
            //check if user have create reset password
            $verify = Verifikasi::select('kode_otp', 'send','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'password')->first();
            if (is_null($verify)) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            if ($verify['kode_otp'] != $code) {
                return response()->json(['status'=>'error','message'=>'Kode OTP invalid'],400);
            }
            //check if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                return response()->json(['status'=>'error','message'=>'Kode otp expired'],400);
            }
            return response()->json(['status'=>'success','message'=>'otp anda benar silahkan ganti password']);
        }
    }
    public function changePassEmail(Request $request, User $user, JWTController $jwtController, RefreshToken $refreshToken){
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
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
        if($pass !== $pass1){
            return response()->json(['status'=>'error','message'=>'Password Harus Sama'],400);
        }
        //check email on table user
        $user = User::select('nama_lengkap')->whereRaw("BINARY email = ?",[$request->input('email')])->first();
        if (is_null($user)) {
            return response()->json(['status'=>'error','message'=>'Email tidak terdaftar !'],400);
        }
        if(is_null($link) || empty($link)){
            //check if user have create reset password
            $verify = Verifikasi::select('kode_otp','send','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'password')->first();
            if (is_null($verify)) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            //check code
            if ($verify['kode_otp'] != $code) {
                return response()->json(['status'=>'error','message'=>'kode otp invalid'],400);
            }
            //checking if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                return response()->json(['status'=>'error','message'=>'kode otp expired'],400);
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
            $verify = Verifikasi::select('link','send','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'password')->first();
            if (is_null($verify)) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            //check link
            if ($verify->link !== $link) {
                return response()->json(['status'=>'error','message'=>'Link invalid'],400);
            }
            //checking if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
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
        // if ($request->hasFile('foto')) {
        //     $file = $request->file('foto');
        //     if(!($file->isValid() && in_array($file->extension(), ['jpeg', 'png', 'jpg']))){
        //         return response()->json(['status'=>'error','message'=>'Format Foto tidak valid. Gunakan format jpeg, png, jpg'], 400);
        //     }
        //     $destinationPath = storage_path('app/user/');
        //     $fotoName = $file->hashName();
        //     $fileData = Crypt::encrypt(file_get_contents($file));
        //     Storage::disk('user')->put('/' . $fotoName, $fileData);
        // }
        //create user
        $insert = User::insert([
            'uuid' =>  Str::uuid(),
            'nama_lengkap' => $request->input('nama_lengkap'),
            'no_telpon' => $request->has('no_telpon') ? $request->input('no_telpon') : '',
            'jenis_kelamin' => $request->input('jenis_kelamin', null),
            'role' => 'user',
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            // 'foto' => $request->hasFile('foto') ? $fotoName : '',
            'foto' => '',
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
        $user = User::select('nama_lengkap')->whereRaw("BINARY email = ?",[$request->input('email')])->first();
        if (is_null($user)) {
            return response()->json(['status'=>'error','message'=>'Email tidak terdaftar !'],400);
        }
        if(Str::startsWith($request->path(), 'verify/email') && $request->isMethod('get')){
            //check if user have create verify email
            $verify = Verifikasi::select('link','send','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'email')->first();
            if (is_null($verify)) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            //check link
            if ($verify->link !== $any) {
                return response()->json(['status'=>'error','message'=>'link invalid'],400);
            }
            //check if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                return response()->json(['status'=>'error','message'=>'link expired'],400);
            }
            if(is_null(DB::table('users')->whereRaw("BINARY email = ?",[$email])->update(['verifikasi'=>true]))){
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
            $verify = Verifikasi::select('kode_otp','send','updated_at')->whereRaw("BINARY email = ?",[$request->input('email')])->where('deskripsi', 'email')->first();
            if (is_null($verify)) {
                return response()->json(['status'=>'error','message'=>'Email invalid'],400);
            }
            //check code
            if ($verify['kode_otp'] != $code) {
                return response()->json(['status'=>'error','message'=>'kode otp invalid'],400);
            }
            //check if mail not expired
            $expTime = MailController::getConditionOTP()[($verify->send - 1)];
            if (Carbon::parse($verify->updated_at)->diffInMinutes(Carbon::now()) >= $expTime) {
                return response()->json(['status'=>'error','message'=>'kode otp expired'],400);
            }
            if(is_null(DB::table('users')->whereRaw("BINARY email = ?",[$email])->update(['verifikasi'=>true]))){
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
        $validator = Validator::make($request->only('email_new', 'nama_lengkap', 'jenis_kelamin', 'no_telpon', 'foto', 'password_old', 'password', 'password_confirm'),
            [
                'email_new'=>'nullable|email',
                'nama_lengkap' => 'required|min:3|max:50',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'no_telpon' => 'required|digits_between:11,13',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
                'password_old' => 'nullable',
                'password' => [
                    'nullable',
                    'string',
                    'min:8',
                    'max:25',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\p{P}\p{S}])[\p{L}\p{N}\p{P}\p{S}]+$/u',
                ],
                'password_confirm' => [
                    'nullable',
                    'string',
                    'min:8',
                    'max:25',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\p{P}\p{S}])[\p{L}\p{N}\p{P}\p{S}]+$/u',
                ],
            ],[
                'email_new.email'=>'Email yang anda masukkan invalid',
                'nama_lengkap.required' => 'Nama user wajib di isi',
                'nama_lengkap.min' => 'Nama user minimal 3 karakter',
                'nama_lengkap.max' => 'Nama user maksimal 50 karakter',
                'jenis_kelamin.required' => 'Jenis kelamin wajib di isi',
                'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
                'no_telpon.required' => 'Nomor telepon wajib di isi',
                'no_telpon.digits_between' => 'Nomor telepon tidak boleh lebih dari 13 karakter',
                'foto.image' => 'Foto Admin harus berupa gambar',
                'foto.mimes' => 'Format foto user tidak valid. Gunakan format jpeg, png, jpg',
                'foto.max' => 'Ukuran foto user tidak boleh lebih dari 5MB',
                'password.min'=>'Password minimal 8 karakter',
                'password.max'=>'Password maksimal 25 karakter',
                'password.regex'=>'Password terdiri dari 1 huruf besar, huruf kecil, angka dan karakter unik',
                'password_confirm.min'=>'Password konfirmasi minimal 8 karakter',
                'password_confirm.max'=>'Password konfirmasi maksimal 25 karakter',
                'password_confirm.regex'=>'Password konfirmasi terdiri dari 1 huruf besar, huruf kecil, angka dan karakter unik',
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
        $user = User::select('email', 'password', 'foto')->whereRaw("BINARY email = ?",[$request->input('user_auth')['email']])->first();
        if (is_null($user)) {
            return response()->json(['status' => 'error', 'message' => 'User tidak ditemukan'], 400);
        }
        //check email on table user
        if(!is_null($request->input('email_new') || !empty($request->input('email_new'))) &&User::select('role')->whereRaw("BINARY email = ?",[$request->input('email_new')])->first() && $request->input('email_new') != $request->input('user_auth')['email']){
            return response()->json(['status' => 'error', 'message' => 'Email sudah digunakan'], 400);
        }
        // check password
        if($request->has('password') && !empty($request->input('password')) && !is_null($request->input('password'))){
            $passOld = $request->input('password_old');
            $pass = $request->input('password_confirm');
            $passConfirm = $request->input('password_confirm');
            if(!password_verify($passOld,$user['password'])){
                return response()->json(['status'=>'error','message'=>'Password salah'],400);
            }
            if($pass !== $passConfirm){
                return response()->json(['status'=>'error','message'=>'Password Harus Sama'],400);
            }
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
            Storage::disk('user')->delete('foto/'.$user['foto']);
            $fotoName = $file->hashName();
            $fileData = Crypt::encrypt(file_get_contents($file));
            Storage::disk('user')->put('foto/' . $fotoName, $fileData);
        }
        //update profile
        $updateProfile = User::whereRaw("BINARY email = ?",[$request->input('user_auth')['email']])->update([
            'email'=> (empty($request->input('email_new')) || is_null($request->input('email_new'))) ? $request->input('user_auth')['email'] : $request->input('email_new'),
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_telpon' => $request->input('no_telpon'),
            'password' => (empty($request->input('password')) || is_null($request->input('password'))) ? $user['password'] : Hash::make($pass),
            'foto' => $request->hasFile('foto') ? $fotoName : $user['foto'],
            'updated_at'=> Carbon::now()
        ]);
        if (!$updateProfile) {
            return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui Profile'], 500);
        }
        //update jwt
        $jwtData = app()->make(JWTController::class)->createJWTMobile($request->input('email_new'), app()->make(RefreshToken::class));
        // return response()->json(['status'=>'error','message'=>$jwtData],400);
        if($jwtData['status'] == 'error'){
            return response()->json(['status'=>'error','message'=>$jwtData['message']],400);
        }
        return response()->json(['status' => 'success', 'message' => 'Profile Anda berhasil diperbarui', 'data'=>$jwtData['data']]);
    }
    public function logout(Request $request, JWTController $jwtController){
        $userAuth = $request->input('user_auth');
        if (!RefreshToken::whereRaw("BINARY email = ?",[$userAuth['email']])->where('number',$userAuth['number'])->delete()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal Logout'], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'Logout berhasil silahkan login kembali']);
    }
}
?>