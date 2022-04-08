<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::get('aktif-degil',function(){
    return view('front.offline');
});

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){
    Route::get('giris', 'App\Http\Controllers\Back\AuthController@login')->name('login');
    Route::post('giris', 'App\Http\Controllers\Back\AuthController@loginPost')->name('login.post');
});
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){
    Route::get('panel', 'App\Http\Controllers\Back\Dashboard@index')->name('dashboard');
    // makale route's
    Route::get('makaleler/silinenler', 'App\Http\Controllers\Back\ArticleController@trashed')->name('trashed.article');
    Route::resource('makaleler','App\Http\Controllers\Back\ArticleController');
    Route::get('/switch', 'App\Http\Controllers\Back\ArticleController@switch')->name('switch');
    Route::get('/deletearticle/{id}', 'App\Http\Controllers\Back\ArticleController@delete')->name('delete.article');
    Route::get('/harddeletearticle/{id}', 'App\Http\Controllers\Back\ArticleController@hardDelete')->name('hard.delete.article');
    Route::get('/recoverarticle/{id}', 'App\Http\Controllers\Back\ArticleController@recover')->name('recover.article');
    // category route's
    Route::get('/kategoriler', 'App\Http\Controllers\Back\CategoryController@index')->name('category.index');
    Route::post('/kategoriler/create', 'App\Http\Controllers\Back\CategoryController@create')->name('category.create');
    Route::post('/kategoriler/update', 'App\Http\Controllers\Back\CategoryController@update')->name('category.update');
    Route::post('/kategoriler/delete', 'App\Http\Controllers\Back\CategoryController@delete')->name('category.delete');
    Route::get('/kategori/status', 'App\Http\Controllers\Back\CategoryController@switch')->name('category.switch');
    Route::get('/kategori/getData', 'App\Http\Controllers\Back\CategoryController@getData')->name('category.getdata');
    // page route's
    Route::get('/sayfalar', 'App\Http\Controllers\Back\PageController@index')->name('pages.index');
    Route::get('/sayfalar/olustur', 'App\Http\Controllers\Back\PageController@create')->name('pages.create');
    Route::get('/sayfalar/guncelle/{id}', 'App\Http\Controllers\Back\PageController@update')->name('pages.edit');
    Route::post('/sayfalar/guncelle/{id}', 'App\Http\Controllers\Back\PageController@updatePost')->name('pages.edit.post');
    Route::post('/sayfalar/olustur', 'App\Http\Controllers\Back\PageController@post')->name('pages.create.post');
    Route::get('/sayfa/switch', 'App\Http\Controllers\Back\PageController@switch')->name('page.switch');
    Route::get('/sayfalar/silinenler', 'App\Http\Controllers\Back\PageController@trashed')->name('trashed.page');
    Route::get('/deletepage/{id}', 'App\Http\Controllers\Back\PageController@delete')->name('delete.page');
    Route::get('/harddeletepage/{id}', 'App\Http\Controllers\Back\PageController@hardDelete')->name('hard.delete.page');
    Route::get('/recoverpage/{id}', 'App\Http\Controllers\Back\PageController@recover')->name('recover.page');
    Route::get('/sayfa/siralama', 'App\Http\Controllers\Back\PageController@orders')->name('page.orders');
    // config route's
    Route::get('/ayarlar', 'App\Http\Controllers\Back\ConfigController@index')->name('config.index');
    Route::post('/ayarlar/update', 'App\Http\Controllers\Back\ConfigController@update')->name('config.update');
    //
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
