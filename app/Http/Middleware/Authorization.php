<?php
namespace App\Http\Middleware;
use Illuminate\Support\Str;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\JWTController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use App\Models\User;
use Closure;
class Authorization
{
    private $exceptPage = ['/', '/artikel', '/testing', '/login', '/password/reset',];
    private $exceptWebApi = ['/admin/login', '/admin/logout',];
    private $exceptMobileApi = ['/'];
    private $roleAdmin = ['super admin','admin disi','admin emotal','admin pengasuhan', 'admin nutrisi'];
    public function handle(Request $request, Closure $next){
        $userAuth = $request->input('user_auth');
        $path = '/'.$request->path();
        if(Str::startsWith($path,array_merge($this->exceptPage, $this->exceptWebApi, $this->exceptMobileApi))){
            return $next($request);
        }
        $checkEmail = function() use ($userAuth, $request){
            $email = $userAuth['email'] ?? $request->input('email');
            $validator = Validator::make(['email'=>$email], [
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
            $email = $request->input('email');
            $userDB = User::select('role')->whereRaw("BINARY email = ?", [$request->input('email')])->limit(1)->get();
            if ($userDB->isEmpty()) {
                return ['status'=>'error','message'=>'User not found','code'=>404];
            }
            return ['status'=>'success','data' =>json_decode($userDB, true)[0]['role']];
        };
        if(isset($userAuth) && !empty($userAuth)){
            $role = $userAuth['role'];
            if(empty($role)){
                $cEmail = $checkEmail();
                if($cEmail['status'] == 'error'){
                    $code = $cEmail['code'];
                    unset($cEmail['code']);
                    return response()->json($cEmail,$code);
                }
                $role = $cEmail['data'];
                unset($cEmail);
            }
        }else{
            $cEmail = $checkEmail();
            if($cEmail['status'] == 'error'){
                $code = $cEmail['code'];
                unset($cEmail['code']);
                return response()->json($cEmail,$code);
            }
            $role = $cEmail['data'];
            unset($cEmail);
        }
        //only admin can access admin feature
        if(in_array($role, ['user']) && !Str::startsWith($path, ['/api/mobile'])){
            return response()->json(['status'=>'error','message'=>'User Unauthorized'],403);
        }
        //only super admin can access /admin
        if(in_array($role,['admin disi','admin emotal','admin pengasuhan', 'admin nutrisi', 'user']) && Str::startsWith($path, '/admin')){
            return response()->json(['status'=>'error','message'=>'User Unauthorized'],403);
        }
        //only super admin and admin disi can access /disi
        if(in_array($role,['admin emotal','admin nutrisi', 'admin pengasuhan','user']) && Str::startsWith($path, '/disi')){
            return response()->json(['status'=>'error','message'=>'User Unauthorized'],403);
        }
        //only super admin and admin emotal can access /emotal
        if(in_array($role,['admin disi','admin nutrisi', 'admin pengasuhan','user']) && Str::startsWith($path, '/emotal')){
            return response()->json(['status'=>'error','message'=>'User Unauthorized'],403);
        }
        //only super admin and admin nutrisi can access /nutrisi
        if(in_array($role,['admin disi','admin emotal', 'admin pengasuhan', 'user']) && Str::startsWith($path, '/nutrisi')){
            return response()->json(['status'=>'error','message'=>'User Unauthorized'],403);
        }
        //only super admin and admin pengasuhan can access /pengasuhan
        if(in_array($role,['admin disi','admin emotal', 'admin nutrisi','user']) && Str::startsWith($path, '/pengasuhan')){
            return response()->json(['status'=>'error','message'=>'User Unauthorized'],403);
        }
        //when admin access mobile
        if(in_array($role, $this->roleAdmin) && Str::startsWith($path, '/mobile')){
            return response()->json(['status'=>'error','message'=>'User Unauthorized'],403);
        }
        return $next($request);
    }
}