<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Services\MailController;
use App\Http\Controllers\Mobile\MasyarakatController;
use App\Http\Controllers\Mobile\Page\HomeController;
use App\Http\Controllers\Mobile\Page\DisiController;
use App\Http\Controllers\Mobile\Page\EmotalController;
use App\Http\Controllers\Mobile\Page\NutrisiController;
use App\Http\Controllers\Mobile\Page\PengasuhanController;
use App\Http\Controllers\Mobile\Page\KonsultasiController;

use App\Http\Controllers\Mobile\Auth\LoginController AS MobileLoginController;
use App\Http\Controllers\Mobile\Auth\RegisterController AS MobileRegisterController;

Route::group(['prefix'=>'/mobile','middleware'=>'authMobile','authorized'],function(){
    Route::group(['prefix'=>'/verify'],function(){
        Route::group(['prefix'=>'/create'],function(){
            Route::post('/password',[MailController::class, 'createForgotPassword'])->withoutMiddleware(['authMobile', 'authorized']);
            Route::post('/email',[MailController::class, 'createVerifyEmail'])->withoutMiddleware(['authMobile', 'authorized']);
        });
        Route::group(['prefix'=>'/password'],function(){
            Route::get('/{any?}',[MasyarakatController::class, 'getChangePass'])->where('any','.*')->withoutMiddleware(['authMobile', 'authorized']);
            Route::post('/',[MasyarakatController::class, 'changePassEmail'])->withoutMiddleware(['authMobile', 'authorized']);
        });
        Route::group(['prefix'=>'/email'],function(){
            Route::get('/{any?}',[MasyarakatController::class, 'verifyEmail'])->where('any','.*')->withoutMiddleware(['authMobile', 'authorized']);
            Route::post('/',[MasyarakatController::class, 'verifyEmail'])->where('any','.*')->withoutMiddleware(['authMobile', 'authorized']);
        });
        Route::group(['prefix'=>'/otp'],function(){
            Route::post('/password',[MasyarakatController::class, 'getChangePass'])->withoutMiddleware(['authMobile', 'authorized']);
            Route::post('/email',[MasyarakatController::class, 'verifyEmail'])->withoutMiddleware(['authMobile', 'authorized']);
        });
    });
    Route::group(['prefix'=>'/users'],function(){
        Route::post('/login', [MobileLoginController::class,'Login'])->withoutMiddleware(['authMobile', 'authorized']);
        Route::post('/login/google', [MobileLoginController::class,'LoginGoogle'])->withoutMiddleware(['authMobile', 'authorized']);
        Route::post('/register', [MobileRegisterController::class,'Register'])->withoutMiddleware(['authMobile', 'authorized']);
        Route::group(['prefix'=>'/profile'],function(){
            Route::post('/', [MasyarakatController::class, 'getProfile']);
            Route::put('/', [MasyarakatController::class, 'updateProfile']);
            Route::post('/foto', [MasyarakatController::class, 'checkFotoProfile']);
        });
        Route::post('/logout', [MasyarakatController::class,'logout']);
    });
    Route::post('/dashboard',[HomeController::class, 'dashboard']);
    Route::post('/artikel',[HomeController::class, 'showArtikel']);
    Route::post('/artikel/{any}',[HomeController::class, 'showDetailArtikel']);
    Route::group(['prefix'=>'/disi'],function(){
        Route::get('/', [DisiController::class, 'getDisi']);
        Route::get('/artikel', [DisiController::class, 'getDisiArtikel']);
        Route::get('/usia/{Any}', [DisiController::class, 'getDisiUsia']);
        Route::get('/{any}', [DisiController::class, 'getDisiDetail']);
    });
    Route::group(['prefix'=>'/emotal'],function(){
        Route::get('/', [EmotalController::class, 'getEmotal']);
        Route::get('/artikel', [EmotalController::class, 'getEmotalArtikel']);
        Route::get('/usia/{Any}', [EmotalController::class, 'getEmotalUsia']);
        Route::get('/{any}', [EmotalController::class, 'getEmotalDetail']);
    });
    Route::group(['prefix'=>'/nutrisi'],function(){
        Route::get('/', [NutrisiController::class, 'getNutrisi']);
        Route::get('/artikel', [NutrisiController::class, 'getNutrisiArtikel']);
        Route::get('/usia/{Any}', [NutrisiController::class, 'getNutrisiUsia']);
        Route::get('/{any}', [NutrisiController::class, 'getNutrisiDetail']);
    });
    Route::group(['prefix'=>'/pengasuhan'],function(){
        Route::get('/', [PengasuhanController::class, 'getPengasuhan']);
        Route::get('/artikel', [PengasuhanController::class, 'getPengasuhanArtikel']);
        Route::get('/usia/{Any}', [PengasuhanController::class, 'getPengasuhanUsia']);
        Route::get('/{any}', [PengasuhanController::class, 'getPengasuhanDetail']);
    });
    Route::group(['prefix'=>'/konsultasi'],function(){
        Route::get('/', [KonsultasiController::class, 'getKonsultasi']);
        Route::get('/{any}', [KonsultasiController::class, 'getKonsultasiDetail']);
    });
    Route::group(['prefix'=>'/kalender'],function(){
        Route::post('/tambah', [PengasuhanController::class, 'tambahPengasuhan']);
        Route::put('/update', [PengasuhanController::class, 'editPengasuhan']);
        Route::delete('/delete', [PengasuhanController::class, 'deletePengasuhan']);
    });
});