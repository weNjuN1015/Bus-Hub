<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\Usercontroller;
use App\Http\Controllers\Admin\Admincontroller;
use App\Http\Controllers\AdminMiddleware;
use App\Http\Controllers\UserMiddleware;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reportroad',[HomeController::class,'report2'])->name('report2');
Route::get('/about',[HomeController::class,'about'])->name('about');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','userMiddleware'])->group(function(){
 Route::get('dashboard',[Usercontroller::class,'index'])->name('dashboard');
 Route::get('report',[Usercontroller::class,'report'])->name('report');
 Route::get('route',[Usercontroller::class,'route'])->name('route');
});

Route::middleware(['auth','adminMiddleware'])->group(function(){
    Route::get('/admin/dashboard',[Admincontroller::class,'index'])->name('admin.dashboard');
    Route::get('/admin/bus',[Admincontroller::class,'bus'])->name('admin.bus');
    Route::get('/admin/location',[Admincontroller::class,'location'])->name('admin.location');
    Route::get('/admin/route',[Admincontroller::class,'route'])->name('admin.route');
    Route::get('/admin/status',[Admincontroller::class,'status'])->name('admin.status');

   });