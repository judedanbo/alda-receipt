<?php

use App\Http\Livewire\OfficeData;
use App\Http\Livewire\OfficeForm;
use App\Http\Livewire\OfficeView;
use App\Http\Livewire\StaffData;
use App\Http\Livewire\StaffForm;
use App\Http\Livewire\StaffView;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// test Routes
Route::get('/staff', StaffData::class)->name('staff.index');
Route::get('/staff/{staff}', StaffView::class)->name('staff.show');
Route::get('/staff-form/{staff?}', StaffForm::class)->name('staff.create');

Route::get('/office', OfficeData::class)->name('office.index');
Route::get('/office/{office}', OfficeView::class)->name('office.show');
Route::get('/office-form/{office?}', OfficeForm::class)->name('office.create');
