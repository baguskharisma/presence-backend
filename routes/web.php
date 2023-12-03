<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin', [AdminController::class, 'index'])->middleware('is_admin')->name('admin');
Route::get('/admin/create-user', [AdminController::class, 'createUser'])->middleware('is_admin')->name('create-user');
Route::get('/admin/position', [AdminController::class, 'position'])->middleware('is_admin')->name('position');
Route::get('/admin/department', [AdminController::class, 'department'])->middleware('is_admin')->name('department');
Route::get('/admin/create-position', [AdminController::class, 'createPosition'])->middleware('is_admin')->name('create-position');
Route::get('/admin/create-department', [AdminController::class, 'createDepartment'])->middleware('is_admin')->name('create-department');
Route::get('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->middleware('is_admin')->name('edit-user');
Route::get('/admin/manage-presence', [AdminController::class, 'managePresence'])->middleware('is_admin')->name('manage-presence');
Route::get('/admin/create-schedule', [ScheduleController::class, 'createschedule']);
Route::post('/admin/create-user', [AdminController::class, 'storeUser']);
Route::post('/admin/create-position', [AdminController::class, 'storePosition']);
Route::post('/admin/create-department', [AdminController::class, 'storeDepartment']);
Route::post('/admin/create-schedule', [ScheduleController::class, 'storeSchedule'])->name('create-schedule');
Route::put('/admin/{id}', [AdminController::class, 'updateUser'])->name('update-user');
Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
Route::delete('/admin/position/{id}', [AdminController::class, 'deletePosition'])->name('delete-position');
Route::delete('/admin/department/{id}', [AdminController::class, 'deleteDepartment'])->name('delete-department');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
Route::get('/schedule/detail/{id}', [ScheduleController::class, 'scheduleDetail'])->name('schedule-detail');

Route::get('/permission/manage', [PermissionController::class, 'index'])->middleware('is_admin')->name('manage-permission');
Route::get('/permission/create-permission', [PermissionController::class, 'createPermission'])->name('create-permission');
Route::post('/permission/create-permission', [PermissionController::class, 'storePermission']);
Route::post('/permission/manage/{id}', [PermissionController::class, 'manage']);

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/presence', [PresenceController::class, 'index'])->middleware('auth')->name('presence');

Route::get('/history', [HistoryController::class, 'history'])->name('history');

Route::get('/profil', [ProfileController::class, 'index'])->name('profile');

Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/presence/check-in', [PresenceController::class, 'checkIn'])->middleware('checkInGPS')->name('check-in');
Route::post('/presence/check-out', [PresenceController::class, 'checkOut'])->middleware('checkOutGPS')->name('check-out');





