<?php

use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\mailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;

use App\Http\Controllers\SocietyController;
use App\Http\Controllers\TraineeController;
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


Route::middleware(['auth','verified','role:attendee'])->group(function(){

    Route::get('/attendee/createprofile', function () {
        return view('attendee/createprofile');})->name('dashboard');

    Route::get('/attendee/dashboard', [AttendeeController::class, 'index'])->name('dashboard');
    
    Route::post('/attendee/create', [AttendeeController::class,'create'])->name('attendee.store');

    Route::get('/attendee/updateprofile', [AttendeeController::class, 'showUpdate'])->name('attendee.update');
    Route::post('/attendee/updateprofile', [AttendeeController::class, 'update'])->name('attendee.update');

    Route::post('/attendee/joinevent', [EventController::class, 'join'])->name('event.join');

    Route::get('/attendee/delete', [AttendeeController::class, 'delete'])->name('attendee.delete');

    Route::get('/attendee/viewevent', [EventController::class, 'read'])->name('event.read');
        
    Route::get('/attendee/viewjoinedevent/', [EventController::class, 'viewJoinedEvents'])->name('event.viewjoinedevents');
    Route::get('/attendee/leaveevent/{id}', [EventController::class, 'leave'])->name('event.leave');
    
});//end group attendee middleware


Route::middleware(['auth','verified','role:university'])->group(function(){

    Route::get('/university/dashboard', [UniversityController::class, 'read']);

    Route::post('/university/create', [UniversityController::class,'create'])->name('university.store');
    Route::get('/university/updateprofile', [UniversityController::class, 'showUpdate'])->name('university.update');
    Route::post('/university/updateprofile', [UniversityController::class, 'update'])->name('university.update');
    Route::get('/university/delete', [UniversityController::class, 'delete'])->name('university.delete');
    
    Route::post('/university/createevent', [EventController::class, 'create'])->name('event.create');
    
    Route::get('/university/viewevent', [EventController::class, 'read'])->name('event.read');

    Route::get('/university/editevent/{id}', [EventController::class, 'showUpdate'])->name('event.showedit');
    Route::post('/university/editevent/', [EventController::class, 'update'])->name('event.edit');
    Route::post('/university/eventlive/', [EventController::class, 'goLive'])->name('event.live');

    Route::post('/university/getFilteredTrainees', [TraineeController::class, 'getFilteredTraninee'])->name('get.trainee');
    Route::post('/university/getEvents', [UniversityController::class, 'getEvents'])->name('get.event');

    Route::get('/university/deleteevent/{id}', [EventController::class, 'delete'])->name('event.delete');
    Route::get('/university/showtrainee/{id}', [EventController::class, 'showTrainee'])->name('event.trainees');
    Route::get('/university/editevent/{id}/{event}', [EventController::class, 'removetrainee'])->name('trainee.remove');


});//end group uni middleware

Route::middleware(['auth','verified','role:trainee'])->group(function(){

    Route::get('trainee/dashboard', [TraineeController::class, 'read']);
    Route::post('/trainee/create', [TraineeController::class,'create'])->name('trainee.store');

    Route::post('/trainee/updateprofile', [TraineeController::class, 'update'])->name('trainee.update');

    Route::post('/trainee/acceptinvite', [TraineeController::class, 'acceptInvite'])->name('invite.accept');
    Route::post('/trainee/declineinvite', [TraineeController::class, 'declineInvite'])->name('invite.decline');



});//end group trainee middleware

Route::get('/createtrainee', [TraineeController::class, 'loadCreate']);


Route::get('/logintrainee', [TraineeController::class, 'loadLogin']);
Route::post('/logintrainee', [TraineeController::class, 'login'])->name('login.trainee');

Route::get('mail', [mailController::class, 'index']);
Route::post('mail', [mailController::class, 'send_mail'])->name('send_mail');

Route::get('/file_upload', [FileController::class, 'open_file_form']);
Route::get('/show_data', [FileController::class, 'show_file_data']);
Route::get('/view_file/{id}', [FileController::class, 'file_view']);
Route::post('/file_store', [FileController::class, 'store_file'])
->name('file_store');


Route::get('/download_file/{file}', [FileController::class,
'file_download']);


Route::get('/create', [TraineeController::class,'createPage']);

Route::post('/create', [TraineeController::class,'tcreate'])->name("create");
Route::get('/eventusers', [TraineeController::class, 'read']);