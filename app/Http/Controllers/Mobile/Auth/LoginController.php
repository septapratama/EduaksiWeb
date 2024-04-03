<?php
namespace App\Http\Controllers\Mobile\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{ 
    public function Login(Request $request){
        $validator = Validator::make($request->only('email','password'), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib di isi',
            'email.email' => 'Email yang anda masukkan invalid',
            'password.required' => 'Password wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return ['status' => 'error', 'message' => implode(', ', $errors),'code'=>400];
        }
        $pass = $request->input("password");
        // $pass = "Admin@1234567890";
        //check email
        $user = User::select('nama_lengkap', 'jenis_kelamin', 'no_telpon','email','password','foto')->whereRaw("BINARY email = ?",[$request->input('email')])->whereNot('role', 'admin')->first();
        if (is_null($user)) {
            return response()->json(['status' => 'error', 'message' => 'Email salah'], 400);
        }
        if(!password_verify($pass,$user['password'])){
            return response()->json(['status'=>'error','message'=>'Password salah'],400);
        }
        unset($user['password']);
        return response()->json(['status'=>'success','message'=>'login sukses silahkan masuk dashboard','data'=>$user]);
    }
    public function LoginGoogle(Request $request){
        $validator = Validator::make($request->only('email'), [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib di isi',
            'email.email' => 'Email yang anda masukkan invalid',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return ['status' => 'error', 'message' => implode(', ', $errors),'code'=>400];
        }
        //check email
        $user = User::select('nama_lengkap','jenis_kelamin','no_telpon','email','foto')->whereRaw("BINARY email = ?",[$request->input('email')])->whereNot('role','admin')->first();
        if (is_null($user)) {
            return response()->json(['status' => 'error', 'message' => 'Email salah'], 400);
        }
        return response()->json(['status'=>'success','message'=>'login sukses silahkan masuk dashboard','data'=>$user]);
    }
}
?>