<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Services\MailController;
use App\Http\Controllers\Services\DisiController;
use App\Http\Controllers\Services\EmotalController;
use App\Http\Controllers\Services\NutrisiController;
use App\Http\Controllers\Services\PengasuhanController;
use App\Http\Controllers\Services\ArtikelController;
use App\Http\Controllers\Services\EventController;
use App\Http\Controllers\Services\KonsultasiController;

use App\Http\Controllers\Page\DisiController AS ShowDisiController;
use App\Http\Controllers\Page\EmotalController AS ShowEmotalController;
use App\Http\Controllers\Page\NutrisiController AS ShowNutrisiController;
use App\Http\Controllers\Page\PengasuhanController AS ShowPengasuhanController;
use App\Http\Controllers\Page\KonsultasiController AS ShowKonsultasiController;
use App\Http\Controllers\Page\ArtikelController AS ShowArtikelController;
use App\Http\Controllers\Page\EventController AS ShowEventController;
use App\Http\Controllers\Page\HomeController AS ShowHomeController;
use App\Http\Controllers\Page\AdminController AS ShowAdminController;
use App\Http\Controllers\Auth\LoginController;

Route::group(['middleware'=>['auth','authorized']],function(){
    //artikel public route
    Route::group(['prefix'=>'/artikel'],function(){
        Route::get('/',[ShowHomeController::class,'showArtikel']);
        Route::get('/{any}',[ShowHomeController::class,'showDetailArtikel']);
    });
    //acara only admin route
    Route::group(['prefix'=>'/acara'],function(){
        Route::get('/',[ShowEventController::class, 'showData']);
        Route::get('/tambah',[ShowEventController::class, 'showTambah']);
        Route::get('/edit/{any}',[ShowEventController::class, 'showEdit']);
        Route::get('/edit', function () {
            return view('page.Event.data');
        });
        Route::post('/tambah', [EventController::class, 'tambahEVent']);
        Route::put('/update', [EventController::class, 'editEvent']);
        Route::delete('/delete', [EventController::class, 'deleteEvent']);
    });
    //article only admin route
    Route::group(['prefix'=>'/article'],function(){
        Route::get('/',[ShowArtikelController::class, 'showData']);
        Route::get('/tambah',[ShowArtikelController::class, 'showTambah']);
        Route::get('/edit/{any}',[ShowArtikelController::class, 'showEdit']);
        Route::get('/edit', function () {
            return view('page.Article.data');
        });
        Route::post('/tambah', [ArtikelController::class, 'tambahArtikel']);
        Route::put('/update', [ArtikelController::class, 'editArtikel']);
        Route::delete('/delete', [ArtikelController::class, 'deleteArtikel']);
    });
    //disi only admin route
    Route::group(['prefix'=>'/disi'],function(){
        Route::get('/',[ShowDisiController::class, 'showData']);
        Route::get('/tambah',[ShowDisiController::class, 'showTambah']);
        Route::get('/edit/{any}',[ShowDisiController::class, 'showEdit']);
        Route::get('/edit', function () {
            return view('page.Disi.data');
        });
        Route::post('/tambah', [DisiController::class, 'tambahDisi']);
        Route::put('/update', [DisiController::class, 'editDisi']);
        Route::delete('/delete', [DisiController::class, 'deleteDisi']);
    });
    //emotal only admin route
    Route::group(['prefix'=>'/emotal'],function(){
        Route::get('/',[ShowEmotalController::class, 'showData']);
        Route::get('/tambah',[ShowEmotalController::class, 'showTambah']);
        Route::get('/edit/{any}',[ShowEmotalController::class, 'showEdit']);
        Route::get('/edit', function () {
            return view('page.Emotal.data');
        });
        Route::post('/tambah', [EmotalController::class, 'tambahEmotal']);
        Route::put('/update', [EmotalController::class, 'editEmotal']);
        Route::delete('/delete', [EmotalController::class, 'deleteEmotal']);
    });
    //konsultasi only admin route
    Route::group(['prefix'=>'/konsultasi'],function(){
        Route::get('/',[ShowKonsultasiController::class, 'showData']);
        Route::get('/tambah',[ShowKonsultasiController::class, 'showTambah']);
        Route::get('/edit/{any}',[ShowKonsultasiController::class, 'showEdit']);
        Route::get('/edit', function () {
            return view('page.Konsultasi.data');
        });
        Route::post('/tambah', [KonsultasiController::class, 'tambahKonsultasi']);
        Route::put('/update', [KonsultasiController::class, 'editKonsultasi']);
        Route::delete('/delete', [KonsultasiController::class, 'deleteKonsultasi']);
    });
    //nutrisi only admin route
    Route::group(['prefix'=>'/nutrisi'],function(){
        Route::get('/',[ShowNutrisiController::class, 'showData']);
        Route::get('/tambah',[ShowNutrisiController::class, 'showTambah']);
        Route::get('/edit/{any}',[ShowNutrisiController::class, 'showEdit']);
        Route::get('/edit', function () {
            return view('page.Nutrisi.data');
        });
        Route::post('/tambah', [NutrisiController::class, 'tambahNutrisi']);
        Route::put('/update', [NutrisiController::class, 'editNutrisi']);
        Route::delete('/delete', [NutrisiController::class, 'deleteNutrisi']);
    });
    //pengasuhan only admin route
    Route::group(['prefix'=>'/pengasuhan'],function(){
        Route::get('/',[ShowPengasuhanController::class, 'showData']);
        Route::get('/tambah',[ShowPengasuhanController::class, 'showTambah']);
        Route::get('/edit/{any}',[ShowPengasuhanController::class, 'showEdit']);
        Route::get('/edit', function () {
            return view('page.Pengasuhan.data');
        });
        Route::post('/tambah', [PengasuhanController::class, 'tambahPengasuhan']);
        Route::put('/update', [PengasuhanController::class, 'editPengasuhan']);
        Route::delete('/delete', [PengasuhanController::class, 'deletePengasuhan']);
    });
    Route::get('/riwayat', [ShowAdminController::class, 'showRiwayat']);
    //download only for admin
    Route::group(['prefix'=>'/public'],function(){
        Route::group(['prefix'=>'/download'],function(){
            Route::group(['prefix'=>'/foto'],function(){
                Route::get('/',[AdminController::class,'getFotoProfile'])->name('download.foto');
                Route::get('/default',[AdminController::class,'getDefaultFoto'])->name('download.foto.default');
                Route::get('/{id}',[AdminController::class,'getFotoAdmin'])->name('download.foto.admin');
            });
        });
    });
    //API only admin route
    Route::group(['prefix'=>'/admin'],function(){
        //page admin
        Route::get('/',[ShowAdminController::class,'showAdmin']);
        Route::get('/tambah',[ShowAdminController::class,'showAdminTambah']);
        Route::get('/edit/{any}',[ShowAdminController::class,'showAdminEdit']);
        Route::get('/edit', function () {
            return view('page.admin.data');
        });
        // route for admin
        Route::post('/tambah',[AdminController::class,'tambahAdmin']);
        Route::put('/update',[AdminController::class,'editAdmin']);
        Route::delete('/delete',[AdminController::class,'hapusAdmin']);
        Route::post('/login',[LoginController::class,'Login']);
        Route::post('/logout',[AdminController::class,'logout']);
        Route::group(['prefix'=>'/update'],function(){
            Route::put('/profile', [AdminController::class, 'updateProfile']);
            Route::put('/password', [AdminController::class, 'updatePassword']);
        });
    });
    Route::group(["prefix"=>"/verify"],function(){
        Route::group(['prefix'=>'/create'],function(){
            Route::post('/password',[MailController::class, 'createForgotPassword']);
        });
        Route::group(['prefix'=>'/password'],function(){
            Route::get('/{any?}',[AdminController::class, 'getChangePass'])->where('any','.*');
            Route::post('/',[AdminController::class, 'changePassEmail']);
        });
        Route::group(['prefix'=>'/otp'],function(){
            Route::post('/password',[AdminController::class, 'getChangePass']);
        });
    });
    Route::get('/password/reset',function (){
        return view('page.forgotPassword', ['title'=>'Lupa password']);
    });
    Route::get('/login', function () {
        return view('page.login');
    });
    // Route::get('/testing', function () {
    //     return view('page.testing');
    // });
    // Route::get('/template', function(){
    //     return view('page.template');
    // });
    Route::get('/dashboard',[ShowAdminController::class,'showDashboard']);
    Route::get('/profile',[ShowAdminController::class,'showProfile']);
    Route::get('/',[ShowHomeController::class,'showHome']);
});