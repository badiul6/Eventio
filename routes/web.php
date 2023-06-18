<?php

use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\mailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;

use App\Http\Controllers\TraineeController;
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

Route::middleware(['auth','verified','role:attendee'])->group(function(){


    Route::get('/attendee/dashboard', [AttendeeController::class, 'index'])->name('dashboard');
    Route::post('/attendee/create', [AttendeeController::class,'create'])->name('attendee.store');
    Route::post('/attendee/joinevent', [EventController::class, 'join'])->name('event.join');
    Route::post('/attendee/uploadcover', [ProfileController::class, 'upload_cover'])->name('attendee.upload.cover');
    Route::post('/attendee/uploaddp', [ProfileController::class, 'upload_dp'])->name('attendee.upload.dp');
    Route::post('/attendee/updateprofile', [AttendeeController::class, 'update'])->name('attendee.update');


});//end group attendee middleware


Route::middleware(['auth','verified','role:university'])->group(function(){

    Route::get('/university/dashboard', [UniversityController::class, 'read']);
    Route::post('/university/createevent', [EventController::class, 'create'])->name('event.create');
    Route::post('/university/create', [UniversityController::class,'create'])->name('university.store');
    Route::post('/university/uploadcover', [ProfileController::class, 'upload_cover'])->name('university.upload.cover');
    Route::post('/university/uploaddp', [ProfileController::class, 'upload_dp'])->name('university.upload.dp');
    Route::post('/university/eventlive/', [EventController::class, 'goLive'])->name('event.live');
    Route::post('/university/editevent/', [EventController::class, 'update'])->name('event.edit');
    Route::post('/university/deleteevent', [EventController::class, 'delete'])->name('event.delete');
    Route::post('/university/updateprofile', [UniversityController::class, 'update'])->name('university.update');
    Route::post('/university/getFilteredTrainees', [TraineeController::class, 'getFilteredTraninee'])->name('get.trainee');
    Route::post('/university/getEvents', [UniversityController::class, 'getEvents'])->name('get.event');



});//end group uni middleware

Route::middleware(['auth','verified','role:trainee'])->group(function(){

    Route::get('trainee/dashboard', [TraineeController::class, 'read']);
    Route::post('/trainee/create', [TraineeController::class,'create'])->name('trainee.store');
    Route::post('/trainee/acceptinvite', [TraineeController::class, 'acceptInvite'])->name('invite.accept');
    Route::post('/trainee/declineinvite', [TraineeController::class, 'declineInvite'])->name('invite.decline');
    Route::post('/trainee/updateprofile', [TraineeController::class, 'update'])->name('trainee.update');
    Route::post('/trainee/uploaddp', [ProfileController::class, 'upload_dp'])->name('trainee.upload.dp');
    Route::post('/trainee/uploadcover', [ProfileController::class, 'upload_cover'])->name('trainee.upload.cover');



});//end group trainee middleware