<?php

use App\Http\Controllers\UploadController;
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

#Route::get('/', [TestController]'TestController@showwelcome');

Route::get('/', function () {
    return view('welcome');
});
#Route::get('/upload', function () {
#    return view('upload');
#});

Route::get('/upload', [UploadController::class, 'getUploadPage']);

Route::post('/upload', [UploadController::class, 'newtask_att_up']);
