<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;

use App\Http\Controllers\SocietyController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth','verified','role:user'])->group(function(){
    Route::get('/user/dashboard', function () {
        return view('user/dashboard');})->name('dashboard');
    
});//end group uni middleware


Route::middleware(['auth','verified','role:university'])->group(function(){
    Route::get('/university/dashboard', [UniversityController::class, 'uniDashboard']);
});//end group uni middleware

Route::middleware(['auth','verified','role:society'])->group(function(){
    Route::get('/society/dashboard', [SocietyController::class, 'societyDashboard']);

});//end group society middleware

