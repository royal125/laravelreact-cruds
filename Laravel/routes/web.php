<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\crudController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home',[crudController::class,'index']) ->name('project.home');
Route::get('/create',[crudController::class,'create']);
Route::post('/store',[crudController::class,'store'])->name('project.store');
Route::get('project/{crud}/edit',[crudController::class,'edit'])->name('project.edit');
Route::post('project/deleteSelected',[crudController::class,'deleteSelected'])->name('deleteSelected');
Route::get('/project/delete/{cruds}', [CrudController::class, 'destroy'])->name('project.delete');
Route::put('/project/update/{cruds}', [CrudController::class, 'update'])->name('project.update');


    
