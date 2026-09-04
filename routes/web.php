<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProgramController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\RnDController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Auth\StudentAuthController;

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

// Specific route for autonomous cars
Route::get('/services/rnd/autonomous-cars', [RnDController::class, 'autonomousCars'])
    ->name('services.rnd.autonomous-cars');

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

    // Serve bespoke view for Intelligent Robotics
    if ($service === 'rnd' && $department === 'robotics') {
        return view('services.intelligent-robotics', [
            'serviceId' => $service,
            'departmentId' => $department,
            'departmentTitle' => $deptTitles[$service][$department]
        ]);
    }

    // Serve bespoke view for Automotive Software R&D
    if ($service === 'rnd' && $department === 'automotive') {
        return view('services.automotive-rnd', [
            'serviceId' => $service,
            'departmentId' => $department,
            'departmentTitle' => $deptTitles[$service][$department]
        ]);
    }
    

    // Serve bespoke view for Robotics Outsourcing
    if ($service === 'outsourcing' && $department === 'robotics') {
        return view('services.robotics-outsourcing', [
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

// Freelance -> RoboHub (RemoteRobotics marketplace).
// RoboHub is a local SPA served by the host nginx at /robohub. An optional
// "freelance_link" site setting can override the target.
Route::get('/freelance', function () {
    $url = \App\Models\SiteSetting::get('freelance_link');
    return $url ? redirect()->away($url) : redirect('/robohub');
})->name('freelance');

// Programs (Now acting as "Training" service)
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{id}', [ProgramController::class, 'show'])->name('programs.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:6,1')->name('contact.store');

// Authentication
Route::middleware('guest:web')->group(function () {
    Route::get('/login', [StudentAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [StudentAuthController::class, 'login'])->middleware('throttle:5,1')->name('login.store');
    Route::get('/register', [StudentAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [StudentAuthController::class, 'register'])->middleware('throttle:5,1')->name('register.store');

    // Password reset
    Route::get('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showLinkRequest'])->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'sendLink'])->middleware('throttle:5,1')->name('password.email');
    Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showReset'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'reset'])->middleware('throttle:5,1')->name('password.update');
});
Route::post('/logout', [StudentAuthController::class, 'logout'])->name('logout')->middleware('auth:web');

// Enrollment (Protected)
Route::middleware('auth:web')->group(function () {
    // User Profile
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile');

    Route::get('/enroll', [EnrollController::class, 'index'])->name('enroll');
    Route::post('/enroll', [EnrollController::class, 'store'])->middleware('throttle:10,1')->name('enroll.store');
    Route::get('/enroll/success', [EnrollController::class, 'success'])->name('enroll.success');
    
    // Payment Processing
    Route::get('/payment/process/{enrollment}', [\App\Http\Controllers\PaymentController::class, 'process'])->name('payment.process');
    Route::get('/payment/return', [\App\Http\Controllers\PaymentController::class, 'returnUrl'])->name('payment.return');
});

// Paymob Webhook Callback
Route::post('/payment/callback', [\App\Http\Controllers\PaymentController::class, 'callback'])->name('payment.callback');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');

// User-submitted posts. These must be declared before /blog/{slug} or the wildcard eats them.
Route::middleware('auth:web')->group(function () {
    Route::get('/blog/submit', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/submit', [BlogController::class, 'store'])->middleware('throttle:10,60')->name('blog.store');
    Route::post('/blog/preview', [BlogController::class, 'preview'])->name('blog.preview');
    Route::get('/blog/my-posts', [BlogController::class, 'mine'])->name('blog.mine');
});

Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// SEO sitemap
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Admin Authentication
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('admin.login.store');
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
        Route::post('/settings/batch', [SettingsController::class, 'updateBatch'])->name('admin.settings.update-batch');
        Route::get('/settings/{setting}/edit', [SettingsController::class, 'edit'])->name('admin.settings.edit');
        Route::put('/settings/{setting}', [SettingsController::class, 'update'])->name('admin.settings.update');

        // File Manager
        Route::get('/file-manager', [FileManagerController::class, 'index'])->name('admin.file-manager.index');
        Route::post('/file-manager/upload', [FileManagerController::class, 'upload'])->name('admin.file-manager.upload');
        Route::post('/file-manager/delete', [FileManagerController::class, 'delete'])->name('admin.file-manager.delete');

        // Blog Management
        Route::post('/blog/preview', [AdminBlogController::class, 'preview'])->name('admin.blog.preview');
        Route::post('/blog/{blog}/approve', [AdminBlogController::class, 'approve'])->name('admin.blog.approve');
        Route::post('/blog/{blog}/reject', [AdminBlogController::class, 'reject'])->name('admin.blog.reject');
        // No show() — the admin edits in place and previews on the live site.
        Route::resource('blog', AdminBlogController::class)->except('show')->names('admin.blog');

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

// External Download Link Redirects
Route::get('/download/roboagent', function () {
    $url = \App\Models\SiteSetting::get('roboagent_download_link');
    if (!$url) {
        abort(404, 'Download link not configured.');
    }
    return redirect()->away($url);
})->name('download.roboagent');

// Dynamic Pages Route (Must be at the very bottom)
Route::get('/{slug}', function ($slug) {
    $page = \App\Models\CmsPage::findBySlug($slug);
    
    if (!$page || !$page->is_custom) {
        abort(404);
    }
    
    return view('pages.custom', compact('page'));
})->where('slug', '.*')->name('custom.page');
