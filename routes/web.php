<?php

use App\Http\Controllers\Admin\DataUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// route biasa
route::get('/santri', function() {
    return('Haii Namaku Unaisah');
});

// Route Parameter
Route::get('/halo/{nama}', function($nama){
    return 'Selamat Datang ' . $nama;
});

// Route Name
Route::get('/buah', function(){
    return 'mangga, Jeruk, Apel';
})->name ('fruit');

// contoh route dengan view
// jika file htmlnya ada didalam folder maka panggil dulu nama foldernya
// contoh : namaFolder.NamaFile
// tetapi jika file htmlnya langsung menyentuh folder view maka langsung saja panggil nama filenya
Route::get('/landing-page', function(){
    return view ('Test.landingpage');
});

// admin ke 2 itu yang di alias -> ada di app.php
// auth = autentikasi -> login register
// kalo bikin route harus pake function
Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    Route::get('/dashboardAdmin', function (){
        return view('admin_.dashboardAdmin');
    });
    Route::controller(DataUserController::class)->group(function(){
        Route::get('/data_user','index')->name('index.data_user');
        // ini untuk menampilkan form data user
        Route::get('/form_data_user','formDataUser')->name('form.data_user');
        // ini rroute 8ntuk proses create/tambah data
        Route::post('/create_data_user','createDataUser')->name('create.data_user');
        // ini route untuk menampilkan form edit
        Route::get('/edit_data_user/{id}','editDataUser')->name('edit.data_user');
        // ini route update data user
        Route::put('/update_data_user/{id}','updateDataUser')->name('update.data_user');
        Route::delete('/delete_data_user/{id}','deleteDataUser')->name('delete.data_user');
    });
});

// route user
Route::prefix('user')->middleware(['auth','user'])->group(function(){
    Route::get('/dashboardUser', function (){
        return view('user_.dashboardUser');
    });
  
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
