<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BotManController;

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);


Route::get('/', function () {
    return view('index');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get("/doctors", function () {
    return view('doctor');
});
Route::get('/app', function () {
    return view('layouts.app');
});

Route::view('/services', 'services');

Route::get('/admin/', [AdminController::class, 'index'])->name("admins");

Route::post('/admin/login', [AdminController::class, 'authenticate_admin'])->name("admin_login");

Route::middleware(['auth', 'checksuperadmin'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('settings', App\Http\Livewire\Admins\Settings::class)->name('admin_settings');

        Route::get('nurses', App\Http\Livewire\Admins\Nurses::class)->name('nurses');

        Route::get('/doctors', App\Http\Livewire\Admins\Doctors::class)->name('admin_doctors');

        Route::get('/operationsreport', App\Http\Livewire\Admins\Operationreport::class)->name('admin_operations_report');

        Route::get('/patients', App\Http\Livewire\Admins\Patients::class)->name('admin_patients');

        Route::get('/birthsreport', App\Http\Livewire\Admins\Birthreport::class)->name('admin_birth_report');

        Route::get('/patientBills', App\Http\Livewire\Admins\Bills::class)->name('patient_bills');

        Route::get('/rooms', App\Http\Livewire\Admins\Rooms::class)->name('Rooms');

        Route::get('/beds', App\Http\Livewire\Admins\Beds::class)->name('patients_beds');

        Route::get('/medicinesStore', App\Http\Livewire\Admins\Medicinestore::class)->name('medicinesStore');

        Route::get('/departments', App\Http\Livewire\Admins\Departments::class)->name('departments');

        Route::get('/employees', App\Http\Livewire\Admins\Employees::class)->name('employees');

        Route::get('/appointment', App\Http\Livewire\Admins\Appointments::class)->name('appointment');

        Route::get('/blocks', App\Http\Livewire\Admins\Blocks::class)->name('blocks');

        Route::get('/hods', App\Http\Livewire\Admins\Hods::class)->name('hods');

        Route::get('/admin/requestedappointments', App\Http\Livewire\Admins\RequestedAppointments::class)->name('requestedAppointment');

        Route::get('/subscribers', App\Http\Livewire\Admins\Subscribers::class)->name('subscribers');


        Route::get('/contactedus', App\Http\Livewire\Admins\Contactedus::class)->name('contactedus');
    });
});



Route::get('/patient/', [PatientController::class, 'index'])->name("patients");

Route::post('/patient/login', [PatientController::class, 'authenticate_patient'])->name("patient_login");

Route::prefix('patient')->group(function () {

    Route::get('/home', App\Http\Livewire\Patients\Home::class)->name('patient_home');

    Route::get('/clinicdata', App\Http\Livewire\Patients\ClinicData::class)->name('clinic_data');

    Route::get('/personaldata', App\Http\Livewire\Patients\PersonalData::class)->name('personal_data');

    Route::get('/sysmptomcheck', App\Http\Livewire\Patients\SymptomCheck::class)->name('symptom_check');
});








Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');