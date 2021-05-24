<?php

use App\Http\Livewire\AppDashboard;
use App\Http\Livewire\DeclarationByYear;
use App\Http\Livewire\OfficeData;
use App\Http\Livewire\OfficeForm;
use App\Http\Livewire\OfficeView;
use App\Http\Livewire\StaffData;
use App\Http\Livewire\StaffForm;
use App\Http\Livewire\StaffView;
use App\Http\Livewire\DeclarationData;
use App\Http\Livewire\DeclarationView;
use App\Http\Livewire\DeclarationReceipt;
use App\Http\Livewire\DeclarationForm;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// test Routes

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', AppDashboard::class)->name('dashboard');
    Route::get('/staff', StaffData::class)->name('staff.index');
    Route::get('/staff/{staff}', StaffView::class)->name('staff.show');
    Route::get('/staff-form/{staff?}', StaffForm::class)->name('staff.create');

    Route::get('/office', OfficeData::class)->name('office.index');
    Route::get('/office/{office}', OfficeView::class)->name('office.show');
    Route::get('/office-form/{office?}', OfficeForm::class)->name('office.create');


    Route::get('/declaration', DeclarationData::class)->name('declaration.index');
    Route::get('/declaration/{declaration}', DeclarationView::class)->name('declaration.show');
    Route::get('/declaration/{declaration}/receipt', DeclarationReceipt::class)->name('declaration.receipt');
    Route::get('/declaration-form/{declaration?}', DeclarationForm::class)->name('declaration.form');
});

Route::get('/byYear', DeclarationByYear::class)->name('declaration.year.summary');
