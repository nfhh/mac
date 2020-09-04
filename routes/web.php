<?php

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

});

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/edit', 'UserController@edit')->name('user.edit');
    Route::post('/user/update', 'UserController@update')->name('user.update');
    Route::get('/upload/mac', 'UploadController@mac')->name('upload.mac');
    Route::post('/upload/mac', 'UploadController@handleMac')->name('upload.mac');
    Route::get('/upload/snkey', 'UploadController@snkey')->name('upload.snkey');
    Route::post('/upload/snkey', 'UploadController@handleSnkey')->name('upload.snkey');
    Route::get('/upload/pcba', 'UploadController@pcba')->name('upload.pcba');
    Route::post('/upload/pcba', 'UploadController@handlePcba')->name('upload.pcba');
    Route::get('/result', 'ResultController@index')->name('result.index');
    Route::delete('/truncate', 'ResultController@truncate')->name('result.truncate');
    Route::get('/sn', 'SnController@index')->name('sn.index');
    Route::get('/sns', 'SnsController@index')->name('sns.index');
    Route::get('/weight', 'WeightController@index')->name('weight.index');
    Route::post('/store', 'WeightController@store')->name('weight.store');
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
