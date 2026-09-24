<?php

use App\Http\Controllers\RepairRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard ช่าง
Route::get('/technician', [RepairRequestController::class, 'technician'])
    ->name('technician');

// ช่างรับงาน
Route::patch('/technician/{repair}/start', [RepairRequestController::class, 'start'])
    ->name('technician.start');

// ระบบแจ้งซ่อม
Route::resource('repairs', RepairRequestController::class);
