<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointController;

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

Route::resource('points', PointController::class);
Route::post('point-process',[PointController::class, 'process'])->name('point-process');


Route::get('/', function () {
    return view('welcome');
});
