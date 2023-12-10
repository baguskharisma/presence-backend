<?php

use Illuminate\Support\Facades\Route;

// Impor controller yang ingin digunakan.
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

// Route untuk menampilkan halaman home.
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk menampilkan halaman admin.
Route::get('/admin', [AdminController::class, 'index'])->middleware('is_admin')->name('admin');
// Route untuk menampilkan halaman create-user.
Route::get('/admin/create-user', [AdminController::class, 'createUser'])->middleware('is_admin')->name('create-user');
// Route untuk menanggapi permintaan HTTP dengan metode POST yang terdapat pada halaman create-user.
Route::post('/admin/create-user', [AdminController::class, 'storeUser']);
// Route untuk menampilkan halaman edit-user.
Route::get('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->middleware('is_admin')->name('edit-user');
// Route untuk menanggapi permintaan HTTP dengan metode PUT yang terdapat pada halaman edit-user.
Route::put('/admin/{id}', [AdminController::class, 'updateUser'])->name('update-user');
// Route untuk menanggapi permintaan HTTP dengan metode DELETE yang terdapat pada halaman admin.
Route::delete('/admin/user/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');

// Route untuk menampilkan halaman position.
Route::get('/admin/position', [AdminController::class, 'position'])->middleware('is_admin')->name('position');
// Route untuk menampilkan halaman create-position.
Route::get('/admin/create-position', [AdminController::class, 'createPosition'])->middleware('is_admin')->name('create-position');
// Route untuk menanggapi permintaan HTTP dengan metode POST yang terdapat pada halaman create-position.
Route::post('/admin/create-position', [AdminController::class, 'storePosition']);
// Route untuk menanggapi permintaan HTTP dengan metode DELETE yang terdapat pada halaman position.
Route::delete('/admin/position/{id}', [AdminController::class, 'deletePosition'])->name('delete-position');

// Route untuk menampilkan halaman department.
Route::get('/admin/department', [AdminController::class, 'department'])->middleware('is_admin')->name('department');
// Route untuk menampilkan halaman create-department.
Route::get('/admin/create-department', [AdminController::class, 'createDepartment'])->middleware('is_admin')->name('create-department');
// Route untuk menanggapi permintaan HTTP dengan metode POST yang terdapat pada halaman create-department.
Route::post('/admin/create-department', [AdminController::class, 'storeDepartment']);
// Route untuk menanggapi permintaan HTTP dengan metode DELETE yang terdapat pada halaman department.
Route::delete('/admin/department/{id}', [AdminController::class, 'deleteDepartment'])->name('delete-department');

// Route untuk menampilkan halaman schedule.
Route::get('/schedule', [ScheduleController::class, 'index'])->middleware('auth')->name('schedule');
// Route untuk menampilkan halaman schedule-detail.
Route::get('/schedule/detail/{id}', [ScheduleController::class, 'scheduleDetail'])->name('schedule-detail');
// Route untuk menampilkan halaman create-schedule.
Route::get('/admin/create-schedule', [ScheduleController::class, 'createschedule']);
// Route untuk menanggapi permintaan HTTP dengan metode POST yang terdapat pada halaman create-schedule.
Route::post('/admin/create-schedule', [ScheduleController::class, 'storeSchedule'])->name('create-schedule');

// Route untuk menanggapi permintaan HTTP dengan metode POST yang terdapat pada halaman presence.
Route::post('/presence/check-in', [PresenceController::class, 'checkIn'])->middleware('checkInGPS')->name('check-in');
// Route untuk menanggapi permintaan HTTP dengan metode POST yang terdapat pada halaman presence.
Route::post('/presence/check-out', [PresenceController::class, 'checkOut'])->middleware('checkOutGPS')->name('check-out');

// Route untuk menampilkan halaman presence.
Route::get('/presence', [PresenceController::class, 'index'])->middleware('auth')->name('presence');
// Route untuk menampilkan halaman manage-presence.
Route::get('/admin/manage-presence', [AdminController::class, 'managePresence'])->middleware('is_admin')->name('manage-presence');

// Route untuk menampilkan halaman manage-permission.
Route::get('/permission/manage-permission', [PermissionController::class, 'index'])->middleware('is_admin')->name('manage-permission');
// Route untuk menampilkan halaman create-permission.
Route::get('/permission/create-permission', [PermissionController::class, 'createPermission'])->name('create-permission');
// Route untuk menanggapi permintaan HTTP dengan metode POST yang terdapat pada halaman create-permission.
Route::post('/permission/create-permission', [PermissionController::class, 'storePermission']);
// Route untuk menanggapi permintaan HTTP dengan metode POST yang terdapat pada halaman manage-permission.
Route::post('/permission/manage-permission/{id}', [PermissionController::class, 'manage']);

// Route untuk menampilkan halaman login.
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
// Route untuk menanggapi permintaan HTTP dengan metode POST yang terdapat pada halaman login.
Route::post('/login', [LoginController::class, 'authenticate']);
// Route untuk menanggapi permintaan HTTP dengan metode POST yang terdapat pada halaman home.
Route::post('/logout', [LoginController::class, 'logout']);

// Route untuk menampilkan halaman history.
Route::get('/history', [HistoryController::class, 'history'])->name('history');

// Route untuk menampilkan halaman profil.
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');