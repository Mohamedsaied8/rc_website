<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;

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

// Services
Route::get('/services', function () {
    return view('services.index');
})->name('services.index');

Route::get('/services/{service}', function ($service) {
    // Basic mapping for titles
    $titles = [
        'rnd' => 'Research & Development',
        'consultation' => 'Engineering Consultation',
        'outsourcing' => 'Outsourcing'
    ];
    
    if (!array_key_exists($service, $titles)) {
        abort(404);
    }
    
    return view('services.show', [
        'serviceId' => $service,
        'serviceTitle' => $titles[$service]
    ]);
})->name('services.show');

Route::get('/services/{service}/{department}', function ($service, $department) {
    // Basic mapping for department titles
    $deptTitles = [
        'rnd' => [
            'autonomous-cars' => 'Autonomous Cars R&D',
            'robotics' => 'Intelligent Robotics',
            'automotive' => 'Automotive Software R&D'
        ],
        'outsourcing' => [
            'automotive' => 'Automotive Outsourcing',
            'robotics' => 'Robotics Outsourcing'
        ]
    ];
    
    if (!array_key_exists($service, $deptTitles) || !array_key_exists($department, $deptTitles[$service])) {
        abort(404);
    }

    // Serve bespoke view for Automotive Outsourcing
    if ($service === 'outsourcing' && $department === 'automotive') {
        return view('services.automotive', [
            'serviceId' => $service,
            'departmentId' => $department,
            'departmentTitle' => $deptTitles[$service][$department]
        ]);
    }
    
    return view('services.department', [
        'serviceId' => $service,
        'departmentId' => $department,
        'departmentTitle' => $deptTitles[$service][$department]
    ]);
})->name('services.department');
// Products
Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

// Freelance External Redirect
Route::get('/freelance', function () {
    return redirect()->away('https://remoterobotics.placeholder.com');
})->name('freelance');

// Programs (Now acting as "Training" service)
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{id}', [ProgramController::class, 'show'])->name('programs.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Enrollment
Route::get('/enroll', [EnrollController::class, 'index'])->name('enroll');
Route::post('/enroll', [EnrollController::class, 'store'])->name('enroll.store');
Route::get('/enroll/success', [EnrollController::class, 'success'])->name('enroll.success');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

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

        // Blog Management
        Route::resource('blog', AdminBlogController::class)->names('admin.blog');

        // Contact Messages Management
        Route::get('/messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('admin.messages.index');
        Route::get('/messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('admin.messages.show');
        Route::delete('/messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('admin.messages.destroy');

        // CMS Pages Management
        Route::get('/pages', [\App\Http\Controllers\Admin\CmsPageController::class, 'index'])->name('admin.pages.index');
        Route::get('/pages/create', [\App\Http\Controllers\Admin\CmsPageController::class, 'create'])->name('admin.pages.create');
        Route::post('/pages', [\App\Http\Controllers\Admin\CmsPageController::class, 'store'])->name('admin.pages.store');
        Route::get('/pages/{page}/edit', [\App\Http\Controllers\Admin\CmsPageController::class, 'edit'])->name('admin.pages.edit');
        Route::delete('/pages/{page}', [\App\Http\Controllers\Admin\CmsPageController::class, 'destroy'])->name('admin.pages.destroy');
        
        Route::post('/api/cms/save', [\App\Http\Controllers\Admin\CmsApiController::class, 'saveInline'])->name('admin.api.cms.save');
        Route::post('/api/cms/upload', [\App\Http\Controllers\Admin\CmsApiController::class, 'uploadImage'])->name('admin.api.cms.upload');
    });
});

// Dynamic Pages Route (Must be at the very bottom)
Route::get('/{slug}', function ($slug) {
    $page = \App\Models\CmsPage::findBySlug($slug);
    
    if (!$page || !$page->is_custom) {
        abort(404);
    }
    
    return view('pages.custom', compact('page'));
})->where('slug', '.*')->name('custom.page');