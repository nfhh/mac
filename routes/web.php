<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    dd(\App\Product::first());
});

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/sn', 'SnController@index')->name('sn.index');
    Route::resource('product', 'ProductController');
    Route::get('/sns', 'SnsController@index')->name('sns.index');
    Route::get('/weight', 'WeightController@index')->name('weight.index');
    Route::post('/store', 'WeightController@store')->name('weight.store');
});

Route::middleware(['auth', 'admin.can'])->group(function () {
    Route::get('/user/index', 'UserController@index')->name('user.index');
    Route::get('/useredit/{user}', 'UserController@useredit')->name('useredit');
    Route::post('/userupdate', 'UserController@userupdate')->name('userupdate');
    Route::get('/user/edit', 'UserController@edit')->name('user.edit');
    Route::post('/user/update', 'UserController@update')->name('user.update');
    Route::get('/user/create', 'UserController@create')->name('user.create');
    Route::post('/user/store', 'UserController@store')->name('user.store');
    Route::delete('/user/{user}', 'UserController@destroy')->name('user.destroy');

    Route::get('/upload/mac', 'UploadController@mac')->name('upload.mac');
    Route::post('/upload/mac', 'UploadController@handleMac')->name('upload.mac');
    Route::get('/upload/snkey', 'UploadController@snkey')->name('upload.snkey');
    Route::post('/upload/snkey', 'UploadController@handleSnkey')->name('upload.snkey');
    Route::get('/upload/pcba', 'UploadController@pcba')->name('upload.pcba');
    Route::post('/upload/pcba', 'UploadController@handlePcba')->name('upload.pcba');
    Route::get('/result', 'ResultController@index')->name('result.index');
    Route::delete('/truncate', 'ResultController@truncate')->name('result.truncate');
    Route::delete('/sns/truncate', function () {
        if(\Illuminate\Support\Facades\Gate::allows('access-admin')){
            \App\Sns::truncate();
            return back()->with('success', '清空数据成功！');
        }
        abort(403);
    })->name('sns.truncate');
    Route::delete('/weight/truncate', function () {
        if(\Illuminate\Support\Facades\Gate::allows('access-admin')){
            \App\Weight::truncate();
            return back()->with('success', '清空数据成功！');
        }
        abort(403);
    })->name('weight.truncate');
    Route::delete('/sn/truncate', function () {
        if(\Illuminate\Support\Facades\Gate::allows('access-admin')){
            \App\Sn::truncate();
            return back()->with('success', '清空数据成功！');
        }
        abort(403);
    })->name('sn.truncate');
    Route::delete('/mac/truncate', function () {
        \App\Mac::truncate();
        return back()->with('success', '清空MAC表成功！');
    })->name('mac.truncate');
    Route::delete('/snkey/truncate', function () {
        \App\Snkey::truncate();
        return back()->with('success', '清空SN&密钥表成功！');
    })->name('snkey.truncate');
    Route::delete('/pcba/truncate', function () {
        \App\Pcba::truncate();
        return back()->with('success', '清空PCBA表成功！');
    })->name('pcba.truncate');
});
