<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RecordController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/patient/view/doctors',[PatientController::class,'viewDoctors'])->name('patient.view.doctors');
Route::get('/patient/view/doctor/appointments/{id}',[AppointmentController::class,'listDoctorAppointments'])->name('patient.view.doctor.appointments');

Route::get('/patient/registration',[PatientController::class,'create'])->name('patient.registration');
Route::post('/patient/registration',[PatientController::class,'store'])->name('patient.registration');

/*
 * -----------------------------------------------------------------------------------
 * patient Routes
 * -----------------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth']], function (){


    Route::get('/patient/profile/edit',[PatientController::class,'edit'])->name('patient.profile.edit');
    Route::post('/patient/profile/update',[PatientController::class,'update'])->name('patient.profile.update');


    Route::get('/patient/view/appointment/{id}',[AppointmentController::class,'viewAppointment'])->name('patient.view.appointment');
    Route::post('/patient/reserve/appointment',[AppointmentController::class,'reserveAppointment'])->name('patient.reserve.appointment');
    Route::post('/patient/cancel/appointment',[AppointmentController::class,'cancelAppointment'])->name('patient.cancel.appointment');

    Route::post('/patient/modify/appointment',[AppointmentController::class,'modifyAppointmentForm'])->name('patient.modify.appointment');
    Route::post('/patient/modify/appointment/confirm',[AppointmentController::class,'modifyAppointment'])->name('patient.modify.appointment.confirm');


    Route::get('/patient/appointments',[PatientController::class,'myAppointments'])->name('patient.appointments');
    Route::post('/patient/view/prescription',[RecordController::class,'viewPrescription'])->name('patient.view.prescription');




    /*
     * -----------------------------------------------------------------------------------
     * Staff Routes
     * -----------------------------------------------------------------------------------
     */

    Route::get('/admin/add/doctor',[DoctorController::class,'create'])->name('admin.add.doctor');
    Route::post('/admin/add/doctor',[DoctorController::class,'store'])->name('admin.add.doctor');

    Route::get('/admin/patients/report',[AdminController::class,'patientsReport'])->name('admin.patients.report');


    /*
     * -----------------------------------------------------------------------------------
     * Doctor Routes
     * -----------------------------------------------------------------------------------
     */
    Route::get('/appointment/add',[AppointmentController::class,'create'])->name('appointment.add');
    Route::post('/appointment/add',[AppointmentController::class,'store'])->name('appointment.add');

    Route::get('/doctor/view/my-upcoming-reserved-visits',[DoctorController::class,'viewMyUpcomingReservedVisits'])->name('doctor.view.myUpcomingReservedVisits');
    Route::get('/doctor/view/my-upcoming-visits',[DoctorController::class,'viewMyUpcomingVisits'])->name('doctor.view.myUpcomingVisits');

    Route::get('/doctor/view/my-previous-reserved-visits',[DoctorController::class,'viewMyPreviousReservedVisits'])->name('doctor.view.myPreviousReservedVisits');
    Route::get('/doctor/view/my-previous-visits',[DoctorController::class,'viewMyPreviousVisits'])->name('doctor.view.myPreviousVisits');


    Route::get('/doctor/view/visit/{id}',[DoctorController::class,'viewPatientAppointment'])->name('doctor.view.visit');
    Route::post('/doctor/view/visit/prescribe',[RecordController::class,'store'])->name('doctor.prescribe');


    Route::post('/doctor/cancel/appointment',[AppointmentController::class,'doctorCancelAppointment'])->name('doctor.cancel.appointment');
    Route::post('/doctor/end/appointment',[AppointmentController::class,'doctorEndAppointment'])->name('doctor.end.appointment');
});
