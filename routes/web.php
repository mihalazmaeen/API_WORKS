<?php

use App\Http\Controllers\CodeGenerateController;
use Illuminate\Support\Facades\Route;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Request;

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
Route::get('/print/latest/ajax/{starting_range}', [CodeGenerateController::class, 'PrintFromRange']);
//Route::get('/show-barcode/{value}', [CodeGenerateController::class, 'PrintBarcode'])->name('print.barcode');
Route::post('/store-in-variable', function (Request $request) {
    $data=array();
    $incrementedRange = $request->input('incrementedRange');

    // Store the value in a PHP variable or process it as needed
    session(['incrementedRange' => $incrementedRange]);

    return response()->json(['success' => true]);
})->name('store-in-variable')->middleware('web');
