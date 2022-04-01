<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
    Route::get('giris', 'App\Http\Controllers\Back\AuthController@login')->name('login');
    Route::post('giris', 'App\Http\Controllers\Back\AuthController@loginPost')->name('login.post');
});
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('panel', 'App\Http\Controllers\Back\Dashboard@index')->name('dashboard');
    Route::resource('makaleler','App\Http\Controllers\Back\ArticleController');
    Route::get('/switch', 'App\Http\Controllers\Back\ArticleController@switch')->name('switch');
    Route::get('cikis', 'App\Http\Controllers\Back\AuthController@logout')->name('logout');
});


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('sayfa','App\Http\Controllers\Front\Homepage@index');
Route::get('/kategori/{category}','App\Http\Controllers\Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}','App\Http\Controllers\Front\Homepage@single')->name('single');
Route::get('/iletisim', 'App\Http\Controllers\Front\Homepage@contact')->name('contact');
Route::post('/iletisim', 'App\Http\Controllers\Front\Homepage@contactpost')->name('contact.post');
Route::get('/{sayfa}', 'App\Http\Controllers\Front\Homepage@page')->name('page');
