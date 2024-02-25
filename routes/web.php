<?php
use App\Http\Controllers\Services\KonsultasiController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Services\DisiController;
use App\Http\Controllers\Services\EmotalController;
use App\Http\Controllers\Services\NutrisiController;
use App\Http\Controllers\Services\PengasuhanController;
use App\Http\Controllers\Services\ArtikelController;

use App\Http\Controllers\Page\DisiController AS ShowDisiController;
use App\Http\Controllers\Page\EmotalController AS ShowEmotalController;
use App\Http\Controllers\Page\NutrisiController AS ShowNutrisiController;
use App\Http\Controllers\Page\PengasuhanController AS ShowPengasuhanController;
use App\Http\Controllers\Page\KonsultasiController AS ShowKonsultasiController;
use App\Http\Controllers\Page\ArtikelController AS ShowArtikelController;
use App\Http\Controllers\Page\HomeController AS ShowHomeController;
use App\Http\Controllers\Page\AdminController AS ShowAdminController;
use App\Http\Controllers\Auth\LoginController;

Route::group(['middleware'=>['auth','authorized']],function(){
    //artikel route
    Route::group(['prefix'=>'/artikel'],function(){
        Route::group(['prefix'=>'/pengasuhan'],function(){
            // Route::get('/',[]);0
        });
    });
    // Route::group(['prefix'=>'/disi'],function(){
    //     Route::get('/',function(){
    //         return view('page.Disi.data');
    //     });
    //     Route::get('/tambah',function(){
    //         return view('page.Disi.tambah');
    //     });
    //     Route::get('/edit',function(){
    //         return view('page.Disi.edit');
    //     });
    // });
    // Route::group(['prefix'=>'/emotal'],function(){
    //     Route::get('/',function(){
    //         return view('page.Emotal.data');
    //     });
    //     Route::get('/tambah',function(){
    //         return view('page.Emotal.tambah');
    //     });
    //     Route::get('/edit',function(){
    //         return view('page.Emotal.edit');
    //     });
    // });
    // Route::group(['prefix'=>'/nutrisi'],function(){
    //     Route::get('/',function(){
    //         return view('page.Nutrisi.data');
    //     });
    //     Route::get('/tambah',function(){
    //         return view('page.Nutrisi.tambah');
    //     });
    //     Route::get('/edit',function(){
    //         return view('page.Nutrisi.edit');
    //     });
    // });
    // Route::group(['prefix'=>'/konsultasi'],function(){
    //     Route::get('/', function () {
    //         return view('page.Konsultasi.data');
    //     })->withoutMiddleware('authorized');
    //     Route::get('/tambah', function () {
    //         return view('page.Konsultasi.tambah');
    //     })->withoutMiddleware('authorized');
    //     Route::get('/edit', function () {
    //         return view('page.Konsultasi.edit');
    //     })->withoutMiddleware('authorized');
    // });
    // Route::group(['prefix'=>'/pengasuhan'],function(){
    //     Route::get('/',function(){
    //         return view('page.Pengasuhan.data');
    //     });
    //     Route::get('/tambah',function(){
    //         return view('page.Pengasuhan.tambah');
    //     });
    //     Route::get('/edit',function(){
    //         return view('page.Pengasuhan.edit');
    //     });
    // });
    Route::group(['prefix'=>'/disi'],function(){
        Route::get('/',[ShowDisiController::class, 'showData']);
        // Route::get('/tambah',[ShowDisiController::class, 'showTambah']);
        Route::get('/edit',[ShowDisiController::class, 'showEdit']);
    });
    Route::group(['prefix'=>'/emotal'],function(){
        Route::get('/',[ShowEmotalController::class, 'showData']);
        // Route::get('/tambah',[ShowEmotalController::class, 'showTambah']);
        Route::get('/edit',[ShowEmotalController::class, 'showEdit']);
    });
    Route::group(['prefix'=>'/nutrisi'],function(){
        Route::get('/',[ShowNutrisiController::class, 'showData']);
        // Route::get('/tambah',[ShowNutrisiController::class, 'showTambah']);
        Route::get('/edit',[ShowNutrisiController::class, 'showEdit']);
    });
    Route::group(['prefix'=>'/pengasuhan'],function(){
        Route::get('/',[ShowPengasuhanController::class, 'showData']);
        // Route::get('/tambah',[ShowPengasuhanController::class, 'showTambah']);
        Route::get('/edit',[ShowPengasuhanController::class, 'showEdit']);
    });
    Route::group(['prefix'=>'/konsultasi'],function(){
        Route::get('/',[ShowKonsultasiController::class, 'showData']);
        Route::get('/tambah',[ShowKonsultasiController::class, 'showTambah']);
        Route::get('/edit',[ShowKonsultasiController::class, 'showEdit']);
    });
    Route::group(['prefix'=>'/artikel'],function(){
        Route::get('/',[ShowArtikelController::class, 'showData']);
        Route::get('/tambah',[ShowArtikelController::class, 'showTambah']);
        Route::get('/edit',[ShowArtikelController::class, 'showEdit']);
    });
    //only admin route
    Route::group(['prefix'=>'/admin'],function(){
        Route::group(['prefix'=>'/emotal'],function(){
            // Route::post('/tambah', [EmotalController::class, 'tambahEmotal']);
            Route::put('/update', [EmotalController::class, 'editEmotal']);
            Route::delete('/delete', [EmotalController::class, 'deleteEmotal']);
        });
        Route::group(['prefix'=>'/disi'],function(){
            // Route::post('/tambah', [DisiController::class, 'tambahDisi']);
            Route::put('/update', [DisiController::class, 'editDisi']);
            Route::delete('/delete', [DisiController::class, 'deleteDisi']);
        });
        Route::group(['prefix'=>'/pengasuhan'],function(){
            // Route::post('/tambah', [PengasuhanController::class, 'tambahPengasuhan']);
            Route::put('/update', [PengasuhanController::class, 'editPengasuhan']);
            Route::delete('/delete', [PengasuhanController::class, 'deletePengasuhan']);
        });
        Route::group(['prefix'=>'/nutrisi'],function(){
            // Route::post('/tambah', [NutrisiController::class, 'tambahNutrisi']);
            Route::put('/update', [NutrisiController::class, 'editNutrisi']);
            Route::delete('/delete', [NutrisiController::class, 'deleteNutrisi']);
        });
        Route::group(['prefix'=>'/konsultasi'],function(){
            Route::post('/tambah', [KonsultasiController::class, 'tambahKonsultasi']);
            Route::put('/update', [KonsultasiController::class, 'editKonsultasi']);
            Route::delete('/delete', [KonsultasiController::class, 'deleteKonsultasi']);
        });
        Route::group(['prefix'=>'/artikel'],function(){
            Route::post('/tambah', [ArtikelController::class, 'tambahArtikel']);
            Route::put('/update', [ArtikelController::class, 'editArtikel']);
            Route::delete('/delete', [ArtikelController::class, 'deleteArtikel']);
        });
        //page admin
        Route::get('/',[ShowAdminController::class,'showAdmin']);
        Route::get('/tambah',[ShowAdminController::class,'showAdminTambah']);
        Route::get('/edit',[ShowAdminController::class,'showAdminEdit']);
        // route for admin
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
    Route::get('/disi/edit', function () {
        return view('page.Disi.edit');
    })->withoutMiddleware('authorized');
    Route::get('/emotal/edit', function () {
        return view('page.Emotal.edit');
    })->withoutMiddleware('authorized');
    Route::get('/nutrisi/edit', function () {
        return view('page.Nutrisi.edit');
    })->withoutMiddleware('authorized');
    Route::get('/pengasuhan/edit', function () {
        return view('page.Pengasuhan.edit');
    })->withoutMiddleware('authorized');
    Route::get('/testing', function () {
        return view('page.testing');
    })->withoutMiddleware('authorized');
    Route::get('/template', function(){
        return view('page.template');
    })->withoutMiddleware('authorized');
    Route::get('/dashboard',[ShowAdminController::class,'showDashboard']);
    Route::get('/profile',[ShowAdminController::class,'showProfile']);
    Route::get('/', function(){
        return view('page.home');
    })->withoutMiddleware('authorized');
    Route::get('/blog', function(){
        return view('page.daftar-artikel');
    })->withoutMiddleware('authorized');
    Route::get('/blog/detail', function(){
        return view('page.detail-artikel');
    })->withoutMiddleware('authorized');
    // Route::get('/',[ShowHomeController::class,'showHome'])->withoutMiddleware('authorized');
});