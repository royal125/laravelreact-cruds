<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\crudController;
use App\Http\Controllers\resource;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/home',[resource::class,'home']);
Route::post('/store',[resource::class,'store'])->name('project.store');
Route::get('project/{crud}/edit',[resource::class,'edit'])->name('project.edit');
Route::put('/project/upgrade/{id}',[resource::class,'upgrade'])->name('project.upgrade');
Route::get('/project/find/{id}',[resource::class,'find'])->name('project.find');
Route::delete('/cruds/{id}',[resource::class,'destruct'])->name('resources.destroy');
