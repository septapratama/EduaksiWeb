<?php
namespace App\Http\Controllers\Mobile\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\JwtController;
use App\Models\User;
use App\Models\RefreshToken;
class LoginController extends Controller
{ 
    public function Login(Request $request, JWTController $jwtController, RefreshToken $refreshToken){
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
        $emaill = $request->input("email");
        $pass = $request->input("password");
        $emaill = "UserTesting2@gmail.com";
        $pass = "Admin@1234567890";
        //check email
        $user = User::select('password')->whereRaw("BINARY email = ?",[$emaill])->first();
        if (is_null($user)) {
            return response()->json(['status' => 'error', 'message' => 'Pengguna tidak ditemukan'], 400);
        }
        if(!password_verify($pass, $user['password'])){
            return response()->json(['status'=>'error','message'=>'Password salah'],400);
        }
        $jwtData = $jwtController->createJWTMobile($emaill,$refreshToken);
        if($jwtData['status'] == 'error'){
            return response()->json(['status'=>'error','message'=>$jwtData['message']],400);
        }
        return response()->json(['status'=>'success','message'=>'login sukses silahkan masuk', 'data' => $jwtData['data']]);
    }
    public function LoginGoogle(Request $request, JWTController $jwtController, RefreshToken $refreshToken){
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
        $user = User::select('password')->whereRaw("BINARY email = ?",[$request->input('email')])->first();
        if (is_null($user)) {
            return response()->json(['status' => 'error', 'message' => 'Email salah'], 400);
        }
        $jwtData = $jwtController->createJWTMobile($request->input('email'),$refreshToken);
        if($jwtData['status'] == 'error'){
            return response()->json(['status'=>'error','message'=>$jwtData['message']],400);
        }
        return response()->json(['status'=>'success','message'=>'login sukses silahkan masuk', 'data' => $jwtData['data']]);
    }
}
?>