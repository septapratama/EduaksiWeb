<?php
namespace App\Http\Middleware;
use App\Http\Controllers\Auth\JwtController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use Closure;
class Authenticate
{
    public function handle(Request $request, Closure $next){
        $jwtController = app()->make(JwtController::class);
        $currentPath = '/'.$request->path();
        $previousUrl = url()->previous();
        $path = parse_url($previousUrl, PHP_URL_PATH);
        if($request->hasCookie("token1") && $request->hasCookie("token2") && $request->hasCookie("token3")){
            $token1 = $request->cookie('token1');
            $token2 = $request->cookie('token2');
            $token3 = $request->cookie('token3');
            $tokenDecode1 = json_decode(base64_decode($token1),true);
            $email = $tokenDecode1['email'];
            $number = $tokenDecode1['number'];
            $authPage = ['/login','/','/artikel'];
            if ((in_array($currentPath, $authPage) || strpos($currentPath, '/artikel/') === 0) && $request->isMethod('get')) {
                if (in_array(ltrim($path), $authPage)) {
                    $response = redirect('/dashboard');
                } else {
                    $response = redirect($path);
                }
                $cookies = $response->headers->getCookies();
                foreach ($cookies as $cookie) {
                    if ($cookie->getName() === 'token1') {
                        $expiryTime = $cookie->getExpiresTime();
                        $currentTime = time();
                        if ($expiryTime && $expiryTime < $currentTime) {
                            $response->withCookie(Cookie::forget('token1'));
                            $response->withCookie(Cookie::forget('token2'));
                        }
                    } else if ($cookie->getName() === 'token3') {
                        $expiryTime = $cookie->getExpiresTime();
                        $currentTime = time();
                        if ($expiryTime && $expiryTime < $currentTime) {
                            $response->withCookie(Cookie::forget('token3'));
                        }
                    }
                }
                return $response;
            }
            $decode = [
                'email'=>$email,
                'token'=>$token2,
                'opt'=>'token'
            ];
            $decodeRefresh = [
                'email'=>$email,
                'token'=>$token3,
                'opt'=>'refresh'
            ];
            //check user is exist in database
            if(!User::select('email')->whereRaw("BINARY email = ?",[$email])->limit(1)->exists()){
                return redirect('/login')->withCookies([Cookie::forget('token1'),Cookie::forget('token2'),Cookie::forget('token3')]);
            }
            //check token if exist in database
            if(!$jwtController->checkExistRefreshToken($token3, 'website')){
                //if token is not exist in database
                $delete = $jwtController->deleteRefreshToken($email,$number, 'website');
                if($delete['status'] == 'error'){
                    return redirect('/login')->withCookies([Cookie::forget('token1'),Cookie::forget('token2'),Cookie::forget('token3')]);
                }
                return redirect('/login')->withCookies([Cookie::forget('token1'),Cookie::forget('token2'),Cookie::forget('token3')]);
            }
            //if token exist
            $decodedRefresh = $jwtController->decode($decodeRefresh);
            if($decodedRefresh['status'] == 'error'){
                if($decodedRefresh['message'] == 'Expired token'){
                    return redirect('/login')->withCookies([Cookie::forget('token1'),Cookie::forget('token2'),Cookie::forget('token3')]);
                }else if($decodedRefresh['message'] == 'invalid email'){
                    return redirect('/login')->withCookies([Cookie::forget('token1'), Cookie::forget('token2'),Cookie::forget('token3')]);
                }
                return redirect('/login')->withCookies([Cookie::forget('token1'),Cookie::forget('token2'),Cookie::forget('token3')]);
            }
            //if token refresh success decoded and not expired
            $decoded = $jwtController->decode($decode);
            if($decoded['status'] == 'error'){
                if($decoded['message'] == 'Expired token'){
                    $updated = $jwtController->updateTokenWebsite($decodedRefresh['data']['data']);
                    if($updated['status'] == 'error'){
                        return response()->json(['status'=>'error','message'=>'update token error'],500);
                    }
                    //when working using this
                    $userAuth = $decodedRefresh['data']['data'];
                    $userAuth['number'] = $decodedRefresh['data']['data']['number'];
                    $userAuth['exp'] = $decodedRefresh['data']['exp'];
                    unset($decodedRefresh);
                    $request->merge(['user_auth' => $userAuth]);
                    $response = $next($request);
                    $cookies = $response->headers->getCookies();
                    foreach ($cookies as $cookie) {
                        if ($cookie->getName() === 'token1') {
                            $response->cookie('token1',$token1,$cookie->getExpiresTime());
                        }else if ($cookie->getName() === 'token3') {
                            $response->cookie('token3',$token3,$cookie->getExpiresTime());
                        }
                    }
                    Cookie::forget('token2');
                    $response->cookie('token2', $updated['data'], time() + intval(env('JWT_ACCESS_TOKEN_EXPIRED')));
                    return $response;
                    //when error using this
                    // $userAuth = $decoded['data']['data'];
                    // $userAuth['number'] = $decoded['data']['data']['number'];
                    // $userAuth['exp'] = $decoded['data']['exp'];
                    // unset($decoded);
                    // $request->merge(['user_auth'=>$userAuth]);
                    // return $next($request);
                }
                return response()->json(['status'=>'error','message'=>$decoded['message']],500);
            }
            //if success decode
            if($request->path() === 'users/google' && $request->isMethod("get")){
                $data = [$decoded['data'][0][0]];
                $request->request->add($data);
                return response()->json($request->all());
            }
            //when working using this
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
        }else{
            //if cookie gone
            $page = ['/dashboard', '/profile', '/article', '/article/tambah', '/article/edit', '/disi', '/disi/tambah', '/emotal', '/emotal/tambah', '/nutrisi', '/nutrisi/tambah', '/pengasuhan', '/pengasuhan/tambah', '/konsultasi', '/konsultasi/tambah', '/admin', '/admin/tambah', '/acara', '/acara/tambah'];
            $pagePrefix = ['/disi/edit', '/emotal/edit', '/nutrisi/edit', '/pengasuhan/edit', '/konsultasi/edit', '/admin/edit', '/acara/edit'];
            if(Str::startsWith($currentPath, $pagePrefix) || in_array($currentPath,$page)){
                if($request->hasCookie("token1")){
                    $token1 = $request->cookie('token1');
                    $token1 = json_decode(base64_decode($token1),true);
                    $email = $token1['email'];
                    $number = $token1['number'];
                    $delete = $jwtController->deleteRefreshToken($email,$number, 'website');
                    if($delete['status'] == 'error'){
                        return response()->json(['status'=>'error','message'=>'delete token error'],500);
                    }else{
                        return redirect('/login')->withCookies([Cookie::forget('token1'),Cookie::forget('token2'),Cookie::forget('token3')]);
                    }
                }else{
                    return redirect('/login')->withCookies([Cookie::forget('token1'),Cookie::forget('token2'),Cookie::forget('token3')]);
                }
            }
            return $next($request); 
        }
    }
}