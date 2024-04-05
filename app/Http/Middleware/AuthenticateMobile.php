<?php
namespace App\Http\Middleware;
use App\Http\Controllers\Auth\JWTController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use Closure;
class AuthenticateMobile
{
    public function handle(Request $request, Closure $next){
        $jwtController = app()->make(JWTController::class);
        if($request->hasHeader("Authorization")){
            return response()->json(['status'=>'error','message'=>'delete token error'], 400);
        }
        $authorizationHeader = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $authorizationHeader);
        if(!$jwtController->checkExistRefreshToken($token, 'mobile')){
            return response()->json(['status'=>'error','message'=>'token error must login'], 400);
        }
        $decoded = $jwtController->decodeMobile($token);
        if($decoded['status'] == 'error'){
            if($decoded['message'] == 'Expired token'){
                return response()->json(['status'=>'error','message'=>'token expired must login'], 400);
            }
            return response()->json(['status'=>'error','message'=>'token error'], 400);
        //if success decode
        }else{
            $userAuth = $decoded['data']['data'];
            $userAuth['number'] = $decoded['data']['data']['number'];
            $userAuth['exp'] = $decoded['data']['exp'];
            unset($decoded);
            $request->merge(['user_auth' => $userAuth]);
            $response = $next($request);
            return $response; 
            //when error using this
            // $userAuth = $decoded['data']['data'];
            // $userAuth['number'] = $decoded['data']['data']['number'];
            // $userAuth['exp'] = $decoded['data']['exp'];
            // unset($decoded);
            // $request->merge(['user_auth'=>$userAuth]);
            // return $next($request); 
        }
    }
}