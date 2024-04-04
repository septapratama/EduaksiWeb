<?php
use App\Http\Controllers\Mobile\Page\DisiController;
use App\Http\Controllers\Mobile\Page\KonsultasiController;
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
            Route::get('/{any?}','MasyarakatController@getChangePass')->where('any','.*');
            Route::post('/','MasyarakatController@changePassEmail');
        });
        Route::group(['prefix'=>'/email'],function(){
            Route::get('/{any?}','MasyarakatController@verifyEmail')->where('any','.*');
            Route::post('/','MasyarakatController@verifyEmail');
        });
        Route::group(['prefix'=>'/otp'],function(){
            Route::post('/password','MasyarakatController@getChangePass');
            Route::post('/email','MasyarakatController@verifyEmail');
        });
    });
    Route::group(['prefix'=>'/users'],function(){
        Route::post('/login', [MobileLoginController::class,'Login']);
        Route::post('/login/google', [MobileLoginController::class,'LoginGoogle']);
        Route::post('/register', [MobileRegisterController::class,'Register'])->withoutMiddleware('authorized');
        Route::put('/profile', [MasyarakatController::class, 'getProfile']);
        Route::put('/update', [MasyarakatController::class, 'updateProfile']);
        Route::post('/logout', [MasyarakatController::class,'logout']);
    });
    Route::group(['prefix'=>'/disi'],function(){
        Route::get('/', [DisiController::class, 'getDisi']);
        Route::get('/usia/{Any}', [DisiController::class, 'getDisiUsia']);
        Route::get('/{any}', [DisiController::class, 'getDisiDetail']);
    });
    Route::group(['prefix'=>'/emotal'],function(){
        // Route::get('/',[]);
    });
    Route::group(['prefix'=>'/pengasuhan'],function(){
        // Route::get('/',[]);
    });
    Route::group(['prefix'=>'/nutrisi'],function(){
        // Route::get('/',[]);
    });
    Route::group(['prefix'=>'/konsultasi'],function(){
        Route::get('/', [KonsultasiController::class, 'getKonsultasi']);
        Route::get('/{any}', [KonsultasiController::class, 'getKonsultasiDetail']);
    });
    Route::group(['prefix'=>'/pencatatan'],function(){
        // Route::get('/',[]);
        // Route::post('/tambah',[]);
        // Route::put('/update',[]);
        // Route::delete('/delete',[]);
        Route::get('/',[]);
    });
    Route::group(['prefix'=>'/pencatatan'],function(){
        Route::get('/',[]);
        Route::post('/tambah',[]);
        Route::put('/update',[]);
        Route::delete('/delete',[]);
    });
});