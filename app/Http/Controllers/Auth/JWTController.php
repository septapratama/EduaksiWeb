<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\RefreshToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use UnexpectedValueException;
use DomainException;
use InvalidArgumentException;
use Carbon\Carbon;
class JwtController extends Controller
{
    //cek jumlah login di database
    public function checkTotalLogin($data, $cond){
        $email = $data['email'];
        if(empty($email) || is_null($email)){
            return ['status'=>'error','message'=>'email empty'];
        }
        if(!RefreshToken::select("email")->whereRaw("BINARY email = ? AND device = '$cond'",[$email])->limit(1)->exists()){
            return ['status'=>'error','message'=>'belum login','data'=>0];
        }
        $result = json_decode(json_encode(RefreshToken::whereRaw("BINARY email = ? AND device = '$cond'",[$email])->count()));
        if(is_null($result) || empty($result) || $result <= 0){
            return ['status'=>'success','data'=>0];
        }
        return ['status'=>'success','data'=>$result];
    }
    //check token in database is exist 
    public function checkExistRefreshToken($token, $cond){
        if(empty($token) || is_null($token)){
            return ['status'=>'error','message'=>'token empty'];
        }
        return RefreshToken::select("email")->whereRaw("BINARY token = ? AND device = '$cond'",[$token])->limit(1)->exists();
    }
    //get refresh token from database
    public function getRefreshWebsite(Request $request,Response $response){
        $email = $request->input('email');
        if(empty($email) || is_null($email)){
            return response()->json('email empty',404);
        }else{
            $Itoken = RefreshToken::select('refresh_token')->where('email','=',$email)->limit(1)->get();
            $token = json_decode(json_encode($Itoken));
            if(is_null($token)){
                return response()->json('email not found',404);
            }else{
                return response()->json($token);
            }
        }
    }

    //save token refresh to database
    public function saveRefreshWebsite(Request $request, RefreshToken $refreshToken){
        $email = $request->input('email');
        $token = $request->input('refresh_token');
        if(empty($email) || is_null($email)){
            return response()->json('email empty',404);
        }
        if(empty($token) || is_null($token)){
            return response()->json('token empty',404);
        }
        $refreshToken->email = $email;
        $refreshToken->token= $token;
        if($refreshToken->save()){
            return response()->json('saving token success1');
        }else{
            return response()->json('error saving token1',401);
        }
    }
    //create token and refresh token 
    public function createJWTWebsite($email, RefreshToken $refreshToken){
        try{
            $userData = User::select()->whereRaw("BINARY email = ?",[$email])->first();
            if ($userData === null){
                return ['status'=>'error','messsage'=>'email not found','code'=>400];
            }
            //check total login on website
            $number = $this->checkTotalLogin(['email'=>$email], 'website');
            $idUser = $userData['id_user'];
            unset($userData['id_user']);
            unset($userData['password']);
            $exp = time() + intval(env('JWT_ACCESS_TOKEN_EXPIRED'));
            $expRefresh = time() + intval(env('JWT_REFRESH_TOKEN_EXPIRED'));
            $secretKey = env('JWT_SECRET');
            $secretRefreshKey = env('JWT_SECRET_REFRESH_TOKEN');
            if($number['data'] >= 3){
                if(!DB::table('refresh_token')->whereRaw("BINARY email = ? AND device = 'website' AND number = 1",[$email])->delete()){
                    return ['status'=>'error','message'=>'error delete old refresh token', 'code'=>500];
                }
                for($i = 1; $i <= 3; $i++){
                    DB::table('refresh_token')->whereRaw("BINARY email = ? AND device = 'website' AND number = $i",[$email])->update(['number'=>$i-1]);
                }
                $userData['number'] = 3;
                $payloadRefresh = ['data' => $userData, 'exp' => $expRefresh];
                $Rtoken = JWT::encode($payloadRefresh, $secretRefreshKey, 'HS512');
                $payload = ['data' => $userData, 'exp' => $exp];
                $token = JWT::encode($payload, $secretKey,'HS512');
                $refreshToken->email = $email;
                $refreshToken->token = $Rtoken;
                $refreshToken->device = 'website';
                $refreshToken->number = 3;
                $refreshToken->id_user = $idUser;
                if(!$refreshToken->save()){
                    return ['status'=>'error','message'=>'error saving token','code'=>500];
                }
                return ['status'=>'success','data'=> [
                    'token' => $token,
                    'refresh' => $Rtoken
                ],'number'=>3];
            //if user has not login
            }else{
                $refreshToken->email = $email;
                $refreshToken->device = 'website';
                $refreshToken->id_user = $idUser;
                $number = $this->checkTotalLogin(['email'=>$email], 'website');
                if($number['status'] == 'error'){
                    $userData['number'] = 1;
                    $payloadRefresh = ['data' => $userData, 'exp' => $expRefresh];
                    $Rtoken = JWT::encode($payloadRefresh, $secretRefreshKey, 'HS512');
                    $refreshToken->number = 1;
                    $refreshToken->token = $Rtoken;
                    $payload = [ 'data' => $userData,'exp' => $exp];
                    $token = JWT::encode($payload, $secretKey,'HS512');
                    $json = [
                        'status'=>'success',
                        'data'=>
                        [
                            'token' => $token,
                            'refresh' => $Rtoken
                        ],
                        'number' => 1
                    ];
                }else{
                    $userData['number'] = $number['data'] + 1;
                    $payloadRefresh = [ 'data' => $userData, 'exp' => $expRefresh];
                    $Rtoken = JWT::encode($payloadRefresh, $secretRefreshKey, 'HS512');
                    $refreshToken->token = $Rtoken;
                    $payload = [ 'data' => $userData, 'exp' => $exp];
                    $token = JWT::encode($payload, $secretKey,'HS512');
                    $refreshToken->number = $number['data']+1;
                    $json = ['status'=>'success', 'data'=> [
                        'token' => $token,
                        'refresh' => $Rtoken
                    ],'number' => $number['data']+1 ];
                }
                if(!$refreshToken->save()){
                    return ['status'=>'error','message'=>'error saving token','code'=>500];
                }
                return $json;
            }
        }catch(UnexpectedValueException  $e){
            return ['status'=>'error','message'=>$e->getMessage()];
        }
    }
    public function createJWTMobile($email, RefreshToken $refreshToken){
        try{
            $userData = User::select()->whereRaw("BINARY email = ?",[$email])->first();
            if ($userData === null){
                return ['status'=>'error','messsage'=>'email not found','code'=>400];
            }
            //check total login on mobile
            $number = $this->checkTotalLogin(['email'=>$email], 'mobile');
            $idUser = $userData['id_user'];
            unset($userData['id_user']);
            unset($userData['password']);
            $exp = time() + intval(env('JWT_MOBILE_ACCESS_TOKEN_EXPIRED'));
            $secretKey = env('JWT_SECRET_MOBILE');
            if($number['data'] >= 2){
                if(!DB::table('refresh_token')->whereRaw("BINARY email = ? AND device = 'mobile' AND number = 1",[$email])->delete()){
                    return ['status'=>'error','message'=>'error delete old refresh token', 'code'=>500];
                }
                for($i = 1; $i <= 2; $i++){
                    DB::table('refresh_token')->whereRaw("BINARY email = ? AND device = 'mobile' AND number = $i",[$email])->update(['number'=>$i-1]);
                }
                $userData['number'] = 2;
                $payload = ['data' => $userData, 'exp' => $exp];
                $token = JWT::encode($payload, $secretKey,'HS512');
                $refreshToken->email = $email;
                $refreshToken->token = $token;
                $refreshToken->device = 'mobile';
                $refreshToken->number = 2;
                $refreshToken->id_user = $idUser;
                if(!$refreshToken->save()){
                    return ['status'=>'error','message'=>'error saving token','code'=>500];
                }
                return ['status' => 'success','data' => $token,'number'=>3];
            //if user has not login
            }else{
                $refreshToken->email = $email;
                $refreshToken->device = 'mobile';
                $refreshToken->id_user = $idUser;
                $number = $this->checkTotalLogin(['email'=>$email], 'mobile');
                if($number['status'] == 'error'){
                    $userData['number'] = 1;
                    $payload = [ 'data' => $userData,'exp' => $exp];
                    $token = JWT::encode($payload, $secretKey,'HS512');
                    $refreshToken->number = 1;
                    $refreshToken->token = $token;
                    $json = ['status' => 'success', 'data' => $token,'number' => 1];
                }else{
                    $userData['number'] = $number['data'] + 1;
                    $payload = [ 'data' => $userData, 'exp' => $exp];
                    $token = JWT::encode($payload, $secretKey,'HS512');
                    $refreshToken->token = $token;
                    $refreshToken->number = $number['data'] + 1;
                    $json = ['status' => 'success', 'data' => $token,'number' => $number['data'] + 1];
                }
                if(!$refreshToken->save()){
                    return ['status'=>'error','message'=>'error saving token','code'=>500];
                }
                return $json;
            }
        }catch(UnexpectedValueException  $e){
            return ['status'=>'error','message'=>$e->getMessage()];
        }
    }
    //decode token website
    public function decode($data){
        try{
            $email = $data['email'];
            $token = $data['token'];
            $opt = $data['opt'];
            if(empty($email) || is_null($email)){
                return ['status'=>'error','message'=>'email empty'];
            }else if(empty($token) || is_null($token)){
                return ['status'=>'error','message'=>'token empty'];
            }else if(empty($opt) || is_null($opt)){
                return ['status'=>'error','message'=>'option empty'];
            }else{
                if($opt == 'token'){
                    $decode = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS512'));
                    $decoded = json_decode(json_encode($decode), true);
                    if(strcmp($email,$decoded['data']['email'] ?? null) === 0){
                        return ['status'=>'success','data'=>json_decode(json_encode($decode), true)];
                    }
                    return ['status'=>'error','message'=>'invalid email'];
                }else if($opt == 'refresh'){
                    $decode = JWT::decode($token, new Key(env('JWT_SECRET_REFRESH_TOKEN'), 'HS512'));
                    $decoded = json_decode(json_encode($decode), true);
                    if(strcmp($email,$decoded['data']['email'] ?? null) === 0){
                        return ['status'=>'success','data'=>json_decode(json_encode($decode), true)];
                    }
                    return ['status'=>'error','message'=>'invalid email'];
                }else{
                    return ['status'=>'error','message'=>'invalid data'];
                }
            }
        }catch(ExpiredException $e){
            return ['status'=>'error','message'=>$e->getMessage()];
        } catch (SignatureInvalidException $e) {
            return ['status'=>'error','message'=>$e->getMessage()];
        } catch (BeforeValidException $e) {
            return ['status'=>'error','message'=>$e->getMessage()];
        }catch(UnexpectedValueException $e){
            return ['status'=>'error','message'=>$e->getMessage()];
        } catch (InvalidArgumentException $e) {
            return ['status'=>'error','message'=>$e->getMessage()];
        } catch (DomainException $e) {
            return ['status'=>'error','message'=>$e->getMessage()];
        } catch (\Exception $e) {
            return ['status'=>'error','message'=>$e->getMessage()];
        }
    }
    //decode token mobile
    public function decodeMobile($token){
        try{
            return ['status'=>'success','data'=>json_decode(json_encode(JWT::decode($token, new Key(env('JWT_SECRET_MOBILE'), 'HS512'))), true)];
        }catch(ExpiredException $e){
            return ['status'=>'error','message'=>$e->getMessage()];
        } catch (SignatureInvalidException $e) {
            return ['status'=>'error','message'=>$e->getMessage()];
        } catch (BeforeValidException $e) {
            return ['status'=>'error','message'=>$e->getMessage()];
        }catch(UnexpectedValueException $e){
            return ['status'=>'error','message'=>$e->getMessage()];
        } catch (InvalidArgumentException $e) {
            return ['status'=>'error','message'=>$e->getMessage()];
        } catch (DomainException $e) {
            return ['status'=>'error','message'=>$e->getMessage()];
        } catch (\Exception $e) {
            return ['status'=>'error','message'=>$e->getMessage()];
        }
    }
    public function updateTokenWebsite($data){
        try{
            if(empty($data) || is_null($data)){
                return ['status'=>'error','message'=>'data empty'];
            }else{
                $exp = time() + intval(env('JWT_ACCESS_TOKEN_EXPIRED'));
                $payload = ['data'=>$data, 'exp'=>$exp];
                $secretKey = env('JWT_SECRET');
                $token = JWT::encode($payload, $secretKey,'HS512');
                return ['status'=>'success','data'=>json_decode(json_encode($token),true)];
            }
        }catch(UnexpectedValueException $e){
            return ['status'=>'error','message'=>$e->getMessage()];
        }
    }
    //update refresh token website
    public function updateRefreshWebsite($email){
        try{
            if(empty($email) || is_null($email)){
                return ['status'=>'error','message'=>'email adios'];
            }else{
                $dataDb = User::select()->whereRaw("BINARY email = ?",[$email])->limit(1)->get();
                $data = json_decode(json_encode($dataDb));
                $expRefresh = time() + intval(env('JWT_REFRESH_TOKEN_EXPIRED'));
                $payloadRefresh = [ $data, 'exp'=>$expRefresh];
                $secretRefreshKey = env('JWT_SECRET_REFRESH_TOKEN');
                $token = JWT::encode($payloadRefresh, $secretRefreshKey, 'HS512');
                if(is_null(DB::table('refresh_token')->whereRaw("BINARY email = ?",[$email])->update(['token'=>$token, 'updated_at' => Carbon::now()]))){
                    return ['status'=>'error','message'=>'error update refresh token'];
                }else{
                    return ['status'=>'success','message'=>'success update refresh token'];
                }
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'error','message'=>$e->getMessage()],500);
        }
    }

    //delete refresh token website 
    public function deleteRefreshToken($email,$number = null, $cond){
        try{
            if(empty($email) || is_null($email)){
                return ['status'=>'error','message'=>'email empty','code'=>400];
            }
            if($number == null){
                if($number == null && $cond == 'mobile'){
                    return ['status'=>'error','message'=>'failed delete refresh token','code'=>500];
                }
                if(!DB::table('refresh_token')->whereRaw("BINARY email = ? AND device = 'website'",[$email])->delete()){
                    return ['status'=>'error','message'=>'failed delete refresh token','code'=>500];
                }
                return ['status'=>'success','message'=>'success delete refresh token','code'=>200];
            }else{
                if(!DB::table('refresh_token')->whereRaw("BINARY email = ? AND number = $number AND device = '$cond'", [$email])->delete()){
                    return ['status'=>'error','message'=>'failed delete refresh token','code'=>500];
                }
                return ['status'=>'success','message'=>'success delete refresh token','code'=>200];
            }
        }catch(\Exception $e){
            return ['status'=>'error','message'=>$e->getMessage()];
        }
    }
}
?>