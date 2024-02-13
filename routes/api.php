<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobile\MasyarakatController;

use App\Http\Controllers\Mobile\Auth\LoginController AS MobileLoginController;
use App\Http\Controllers\Mobile\Auth\RegisterController AS MobileRegisterController;

Route::group(['prefix'=>'/mobile','middleware'=>'authorized'],function(){
    Route::group(['prefix'=>'/send'],function(){
        Route::group(['prefix'=>'/create'],function(){
            Route::post('/password','Mail\MailController@createForgotPassword');
            Route::post('/email','Mail\MailController@createVerifyEmail');
        });
        Route::group(['prefix'=>'/password'],function(){
            Route::get('/{any?}','UserController@getChangePass')->where('any','.*');
            Route::post('/','UserController@changePassEmail');
        });
        Route::group(['prefix'=>'/email'],function(){
            Route::get('/{any?}','UserController@verifyEmail')->where('any','.*');
            Route::post('/','UserController@verifyEmail');
        });
        Route::group(['prefix'=>'/otp'],function(){
            Route::post('/password','UserController@getChangePass');
            Route::post('/email','UserController@verifyEmail');
        });
    });
    Route::group(['prefix'=>'/users'],function(){
        Route::post('/login', [MobileLoginController::class,'Login']);
        Route::post('/login/google', [MobileLoginController::class,'LoginGoogle']);
        Route::post('/register', [MobileRegisterController::class,'Register']);
        Route::put('/update', [MasyarakatController::class,'updateUser']);
        Route::post('/logout', [MasyarakatController::class,'logout']);
    });
    Route::group(['prefix'=>'/emotal'],function(){
        // Route::get('/',[]);
    });
    Route::group(['prefix'=>'/disi'],function(){
        // Route::get('/',[]);
    });
    Route::group(['prefix'=>'/pengasuhan'],function(){
        // Route::get('/',[]);
    });
    Route::group(['prefix'=>'/nutrisi'],function(){
        // Route::get('/',[]);
    });
    Route::group(['prefix'=>'/pencatatan'],function(){
        // Route::get('/',[]);
        // Route::post('/tambah',[]);
        // Route::put('/update',[]);
        // Route::delete('/delete',[]);
    });
});