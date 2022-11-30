<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/photo', function () {
    return view('welcome');
});
Route::get('/', [AuthController::class, 'index']);
        
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/processlogin', [AuthController::class, 'login']);

Route::group(['prefix' => 'department','middleware' => ['isauth']], function() {
    Route::get('/', [DepartmentController::class, 'index']);
    Route::post('/store', [DepartmentController::class, 'store']);
    Route::post('/bycampus', [DepartmentController::class, 'bycampus']);
    Route::post('/one', [DepartmentController::class, 'one']);
    Route::post('/delete', [DepartmentController::class, 'destroy']);
});

Route::group(['prefix' => 'employee','middleware' => ['isauth']], function() {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::post('/store', [EmployeeController::class, 'store']);
    Route::post('/list', [EmployeeController::class, 'show'])->name('employee.list');
    Route::post('/customlist', [EmployeeController::class, 'showinmeeting'])->name('showinmeeting.list');
    Route::post('/one', [EmployeeController::class, 'edit']);
    Route::post('/delete', [EmployeeController::class, 'destroy']);
    Route::post('/cropimage', [EmployeeController::class, 'cropimage']);
});

Route::group(['prefix' => 'dashboard','middleware' => ['isauth']], function() {
    Route::get('/', function () {return view('index'); });
    // Route::post('/store', [EmployeeController::class, 'store']);
    // Route::post('/list', [EmployeeController::class, 'show'])->name('employee.list');
    // Route::post('/one', [EmployeeController::class, 'edit']);
    // Route::post('/delete', [EmployeeController::class, 'destroy']);
});

Route::group(['prefix' => 'meeting','middleware' => ['isauth']], function() {
    Route::get('/', [MeetingController::class, 'index']);
    Route::get('/add', [MeetingController::class, 'addmeeting'])->name('meeting.add');
    Route::post('/store', [MeetingController::class, 'store']);
    Route::post('/list', [MeetingController::class, 'show']);
    Route::post('/save_session_participants', [MeetingController::class, 'save_session_participants']);
    Route::post('/save_participants', [MeetingController::class, 'save_participants']);
    Route::post('/participants_list', [MeetingController::class, 'participants_list']);
    Route::post('/cancel_participants', [MeetingController::class, 'cancel_participants']);
    Route::post('/my-meeting', [MeetingController::class, 'my_meeting']);
    Route::post('/notify-meeting', [MeetingController::class, 'notify_meeting']);
    Route::post('/one', [MeetingController::class, 'one']);
    Route::post('/delete', [MeetingController::class, 'destroy']);
    Route::post('/getvenue', [MeetingController::class, 'getvenue']);
});

Route::group(['prefix' => 'participants','middleware' => ['isauth']], function() {
    Route::get('/', [MeetingController::class, 'participants_list_index']);
    Route::post('/list', [MeetingController::class, 'participants_employeelist']);
    Route::post('/send-sms', [MeetingController::class, 'send_sms']);
});

Route::get('sendmail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('pazjeck14@gmail.com')->send(new \App\Mail\SendMail($details));
   
    dd("Email is Sent.");
});

Route::get('sendSMS', [TwilioSMSController::class, 'index']);

