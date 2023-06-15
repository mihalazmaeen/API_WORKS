<?php

use App\Http\Controllers\CodeGenerateController;
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
    return view('welcome');
});
Route::get('code', [CodeGenerateController::class, 'CodeGenerate'])->name('code.view');
Route::POST('code', [CodeGenerateController::class, 'CodeGenerateUsingRange'])->name('code.generate');
Route::get('view', [CodeGenerateController::class, 'CodeView'])->name('code.show');
Route::get('/generate/latest/ajax/{code_format}', [CodeGenerateController::class, 'GetLatestRange']);
Route::get('report', [CodeGenerateController::class, 'ShowReport']);
Route::get('azadvai', [CodeGenerateController::class, 'ShowDemo']);
Route::get('print', [CodeGenerateController::class, 'PrintGeneratedBarcode']);
