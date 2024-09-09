<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrameController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('roles', [RoleController::class,'index'])->name('roles');
    Route::get('roles/create', [RoleController::class,'create'])->name('roles.create');
    Route::post('roles/store', [RoleController::class,'store'])->name('roles.store');
    Route::get('roles/destroy/{id}', [RoleController::class,'destroy'])->name('roles.destroy');
    Route::get('roles/edit/{id}', [RoleController::class,'edit'])->name('roles.edit');
    Route::post('roles/update', [RoleController::class,'update'])->name('roles.update');

    Route::get('users', [UserController::class,'index'])->name('users');
    Route::get('user/create', [UserController::class,'create'])->name('user.create');
    Route::post('user/store', [UserController::class,'store'])->name('user.store');
    Route::post('upload/user', [UserController::class,'upload'])->name('upload-user');
    Route::get('user/edit/{position_code}', [UserController::class,'edit'])->name('user.edit');
    Route::post('user/update', [UserController::class,'update'])->name('user.update');
    Route::get('user/delete/{position_code}', [UserController::class,'delete'])->name('user.delete');

    Route::get('frame', [FrameController::class,'index'])->name('frame');
    Route::get('frame/create', [FrameController::class,'create'])->name('frame.create');
    Route::post('frame/preview', [FrameController::class,'preview'])->name('frame.preview');
    Route::post('frame/store', [FrameController::class,'store'])->name('frame.store');
    Route::get('frame/edit/{id}', [FrameController::class,'edit'])->name('frame.edit');
    Route::post('frame/update', [FrameController::class,'update'])->name('frame.update');

    Route::get('user/export/{type}', [UserController::class,'export'])->name('user.export');

    Route::get('user-form', [UserController::class,'userForm'])->name('user-form');

    Route::post('poster/preview', [UserController::class,'posterPreview'])->name('poster.preview');

    Route::post('update/user', [UserController::class,'updateUser'])->name('update.user');

    Route::get('download/{user_id}', [UserController::class,'download'])->name('download');

    Route::get('setting',[SettingController::class,'index'])->name('setting');
});