<?php
use Illuminate\Support\Facades\Route;   

use App\Http\Controllers\AdminController;

use App\Http\Controllers\Page\HomeController AS ShowHomeController;
use App\Http\Controllers\Page\AdminController AS ShowAdminController;
use App\Http\Controllers\Auth\LoginController;

Route::group(['middleware'=>['auth','authorized']],function(){
    //artikel route
    Route::group(['prefix'=>'/artikel'],function(){
        Route::group(['prefix'=>'/pengasuhan'],function(){
            Route::get('/',[ShowSewaController::class,'showSewa']);
        });
    });
    Route::group(['prefix'=>'/emotal'],function(){
        // Route::get('/',[,'show']);
        // Route::get('/tambah',[,'show']);
        // Route::get('/edit',[,'show']);
    });
    Route::group(['prefix'=>'/disi'],function(){
        // Route::get('/',[,'show']);
        // Route::get('/tambah',[,'show']);
        // Route::get('/edit',[,'show']);
    });
    Route::group(['prefix'=>'/nutrisi'],function(){
        // Route::get('/',[,'show']);
        // Route::get('/tambah',[,'show']);
        // Route::get('/edit',[,'show']);
    });
    Route::group(['prefix'=>'/pengasuhan'],function(){
        // Route::get('/',[,'show']);
        // Route::get('/tambah',[,'show']);
        // Route::get('/edit',[,'show']);
    });
    //admin route
    Route::group(['prefix'=>'/admin'],function(){
        Route::group(['prefix'=>'/emotal'],function(){
            // Route::post('/tambah');
            // Route::put('/update');
            // Route::delete('/delete');
        });
        Route::group(['prefix'=>'/disi'],function(){
            // Route::post('/tambah');
            // Route::put('/update');
            // Route::delete('/delete');
        });
        Route::group(['prefix'=>'/pengasuhan'],function(){
            // Route::post('/tambah');
            // Route::put('/update');
            // Route::delete('/delete');
        });
        Route::group(['prefix'=>'/nutrisi'],function(){
            // Route::post('/tambah');
            // Route::put('/update');
            // Route::delete('/delete');
        });
        Route::group(['prefix'=>'/disi'],function(){
            // Route::post('/tambah');
            // Route::put('/update');
            // Route::delete('/delete');
        });
        Route::group(['prefix'=>'/pengasuhan'],function(){
            // Route::post('/tambah');
            // Route::put('/update');
            // Route::delete('/delete');
        });
        Route::group(['prefix'=>'/nutrisi'],function(){
            // Route::post('/tambah');
            // Route::put('/update');
            // Route::delete('/delete');
        });
        //page
        Route::get('/',[ShowAdminController::class,'showAdmin']);
        Route::get('/tambah',[ShowAdminController::class,'showAdminTambah']);
        Route::get('/edit/{id}',[ShowAdminController::class,'showAdminEdit']);
        // api
        Route::post('/tambah',[AdminController::class,'tambahAdmin']);
        Route::put('/edit',[AdminController::class,'editAdmin']);
        Route::delete('/delete',[AdminController::class,'hapusAdmin']);
        Route::post('/login',[LoginController::class,'Login']);
        Route::post('/logout',[AdminController::class,'logout']);
        Route::group(['prefix'=>'/update'],function(){
            Route::put('/profile', [AdminController::class, 'updateProfile']);
            Route::put('/password', [AdminController::class, 'updatePassword']);
        });
    });
    Route::get('/login', function () {
        return view('page.login');
    })->withoutMiddleware('authorized');
    Route::get('/admin',[ShowAdminController::class,'showAdmin']);
    Route::get('/dashboard',[ShowAdminController::class,'showDashboard']);
    Route::get('/profile',[ShowAdminController::class,'showProfile']);
    Route::get('/',[ShowHomeController::class,'showHome'])->withoutMiddleware('authorized');
});