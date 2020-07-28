<?php

use App\Mac;
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

Route::get('/', function () {

    $arr = [
        [
            'sn' => '11111',
            'key' => '22222', // yyy
            'mac' => 'abcd', // zzz
        ],
        [
            'sn' => '66666', // xxx
            'key' => '44444',
            'mac' => 'fhksl',
        ],
        [
            'sn' => '66666', // xxx
            'key' => '22222', // yyy
            'mac' => 'abcd', // zzz
        ],
        [
            'sn' => '33333',
            'key' => '55555',
            'mac' => 'abcd', // zzz
        ],
        [
            'sn' => '7890',
            'key' => '34566',
            'mac' => 'abcd', // zzz
        ]
    ];

    $n = ["sn" => "aaa", "key" => "bbb", "mac" => "ccc"];
    $k = count($arr);
    for ($i = 0; $i < $k; $i++) {
        for ($j = ($k - 1); $j > $i; $j--) {
            foreach ($arr[$i] as $key => &$val) {
                foreach ($arr[$j] as $key1 => &$val1) {
                    dump($key, $key1, $val, $val1);
                }
            }
        }
    }
    dump($arr);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/upload/mac', 'UploadController@mac')->name('upload.mac');
    Route::post('/upload/mac', 'UploadController@handleMac')->name('upload.mac');
    Route::get('/upload/snkey', 'UploadController@snkey')->name('upload.snkey');
    Route::post('/upload/snkey', 'UploadController@handleSnkey')->name('upload.snkey');
    Route::get('/upload/pcba', 'UploadController@pcba')->name('upload.pcba');
    Route::post('/upload/pcba', 'UploadController@handlePcba')->name('upload.pcba');
});
