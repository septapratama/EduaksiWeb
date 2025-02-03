<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
class UtilityController extends Controller
{
    public static function checkEmail($email){
        $userDB = User::select('id_user', 'role')->whereRaw("BINARY email = ?", [$email])->first();
        if(is_null($userDB)){
            return ['status'=>'error','message'=>'Account not found','code'=>404];
        }
        return ['status'=>'success', 'data' => $userDB->toArray()];
    }
}