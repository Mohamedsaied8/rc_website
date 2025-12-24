<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\FileManagerController;

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

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// About page
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Courses
// Courses routes removed

// Programs
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{id}', [ProgramController::class, 'show'])->name('programs.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Enrollment
Route::get('/enroll', [EnrollController::class, 'index'])->name('enroll');
Route::post('/enroll', [EnrollController::class, 'store'])->name('enroll.store');
Route::get('/enroll/success', [EnrollController::class, 'success'])->name('enroll.success');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Authentication
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.store');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Admin Dashboard (protected)
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Courses Management
        Route::get('/courses', [AdminCourseController::class, 'index'])->name('admin.courses.index');
        Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('admin.courses.create');
        Route::post('/courses', [AdminCourseController::class, 'store'])->name('admin.courses.store');
        Route::get('/courses/{course}', [AdminCourseController::class, 'show'])->name('admin.courses.show');
        Route::get('/courses/{course}/edit', [AdminCourseController::class, 'edit'])->name('admin.courses.edit');
        Route::put('/courses/{course}', [AdminCourseController::class, 'update'])->name('admin.courses.update');
        Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy'])->name('admin.courses.destroy');

        // Programs Management
        Route::get('/programs', [AdminProgramController::class, 'index'])->name('admin.programs.index');
        Route::get('/programs/create', [AdminProgramController::class, 'create'])->name('admin.programs.create');
        Route::post('/programs', [AdminProgramController::class, 'store'])->name('admin.programs.store');
        Route::get('/programs/{program}', [AdminProgramController::class, 'show'])->name('admin.programs.show');
        Route::get('/programs/{program}/edit', [AdminProgramController::class, 'edit'])->name('admin.programs.edit');
        Route::put('/programs/{program}', [AdminProgramController::class, 'update'])->name('admin.programs.update');
        Route::delete('/programs/{program}', [AdminProgramController::class, 'destroy'])->name('admin.programs.destroy');

        // Enrollments Management
        Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('admin.enrollments.index');
        Route::get('/enrollments/{enrollment}', [EnrollmentController::class, 'show'])->name('admin.enrollments.show');
        Route::patch('/enrollments/{enrollment}/status', [EnrollmentController::class, 'updateStatus'])->name('admin.enrollments.update-status');

        // Settings Management
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
        Route::get('/settings/{setting}/edit', [SettingsController::class, 'edit'])->name('admin.settings.edit');
        Route::put('/settings/{setting}', [SettingsController::class, 'update'])->name('admin.settings.update');

        // File Manager
        Route::get('/file-manager', [FileManagerController::class, 'index'])->name('admin.file-manager.index');
        Route::post('/file-manager/upload', [FileManagerController::class, 'upload'])->name('admin.file-manager.upload');
        Route::post('/file-manager/delete', [FileManagerController::class, 'delete'])->name('admin.file-manager.delete');
    });
});