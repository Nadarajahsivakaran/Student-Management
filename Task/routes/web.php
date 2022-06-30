<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGuardianController;
use App\Http\Controllers\ReportController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Students
Route::get("/",[StudentController::class, 'studentView']);
Route::post("/studentAdd",[StudentController::class, 'studentAdd']);
Route::get("/studentEdit/{id}",[StudentController::class, 'studentEdit']);
Route::get("/studentDelete/{id}",[StudentController::class, 'studentDelete']);

// Students Guardian
Route::get("/view",[StudentGuardianController::class, 'view']);
Route::post("/studentGuardianAdd",[StudentGuardianController::class, 'studentGuardianAdd']);
Route::get("/studentGuardianEdit/{id}",[StudentGuardianController::class, 'studentGuardianEdit']);
Route::get("/guarianDelete/{id}",[StudentGuardianController::class, 'guarianDelete']);

// Reports
Route::get("/getDatas",[ReportController::class, 'getDatas']);
