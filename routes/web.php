<?php

use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;

use App\Http\Controllers\SocietyController;
use App\Models\University;

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


Route::middleware(['auth','verified','role:participant'])->group(function(){

    Route::get('/participant/createprofile', function () {
        return view('user/createprofile');})->name('createprofile');

    Route::get('/participant/dashboard', [ParticipantController::class, 'read'])->name('dashboard');
    
    Route::post('/participant/create', [ParticipantController::class,'create'])->name('attendee.store');

    Route::get('/participant/updateprofile', [ParticipantController::class, 'showUpdate'])->name('attendee.update');
    Route::post('/participant/updateprofile', [ParticipantController::class, 'update'])->name('attendee.update');
    
    Route::get('/participant/delete', [ParticipantController::class, 'delete'])->name('attendee.delete');

    Route::get('/participant/viewevent', [EventController::class, 'read'])->name('event.read');
    
    Route::get('/participant/joinevent/{id}', [EventController::class, 'join'])->name('event.join');
    Route::get('/participant/viewjoinedevent/', [EventController::class, 'viewJoinedEvents'])->name('event.viewjoinedevents');
    Route::get('/participant/leaveevent/{id}', [EventController::class, 'leave'])->name('event.leave');
    
});//end group uni middleware


Route::middleware(['auth','verified','role:university'])->group(function(){

    Route::get('/university/createprofile', function () {
        return view('university/createprofile');})->name('createprofile');
    Route::get('/university/dashboard', [UniversityController::class, 'read']);

    Route::post('/university/create', [UniversityController::class,'create'])->name('university.store');
    Route::get('/university/updateprofile', [UniversityController::class, 'showUpdate'])->name('university.update');
    Route::post('/university/updateprofile', [UniversityController::class, 'update'])->name('university.update');
    Route::get('/university/delete', [UniversityController::class, 'delete'])->name('university.delete');
    
    Route::get('/university/createevent', [UniversityController::class, 'loadcreateevent'])->name('university.cevent');
    Route::post('/university/createevent', [EventController::class, 'create'])->name('event.create');
    
    Route::get('/university/viewevent', [EventController::class, 'read'])->name('event.read');

    Route::get('/university/editevent/{id}', [EventController::class, 'showUpdate'])->name('event.showedit');
    Route::post('/university/editevent/{id}', [EventController::class, 'update'])->name('event.edit');

    Route::get('/university/deleteevent/{id}', [EventController::class, 'delete'])->name('event.delete');

    Route::post('/university/searchsoc/', [EventController::class, 'searchEvent'])->name('search.soc');

});//end group uni middleware

