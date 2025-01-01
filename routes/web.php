<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\VendorAuthController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/contact_us', [ContactController::class, 'show_contact_us'])->name('contact_us');
Route::post('/contact_us', [ContactController::class, 'contact_us'])->name('contact_us.submit');


Route::get('/repositories', [RepositoryController::class, 'all_repositories'])->name('repositories');
Route::get('/repository/{id}', [RepositoryController::class,'show_repository'])->name('repository');

Route::get('/about', [HomeController::class,'about'])->name('about');

Route::prefix('vendor')->group(function () {
    // Vendor Login Routes
    Route::get('/login', [VendorAuthController::class, 'showLoginForm'])->name('vendor.login');
    Route::post('/login', [VendorAuthController::class, 'login'])->name('vendor.login.submit');
    // Vendor Register Routes
    Route::get('/register', [VendorAuthController::class, 'showRegistrationForm'])->name('vendor.register');
    Route::post('/register', [VendorAuthController::class, 'register'])->name('vendor.register.submit');
  
    // Admin Dashboard Routes
    Route::middleware('auth:vendor')->group(function () {
        Route::get('/dashboard', [VendorAuthController::class, 'dashboard'])->name('vendor.dashboard');
        Route::post('/logout', [VendorAuthController::class, 'logout'])->name('vendor.logout');
        Route::get('/upload', [VendorAuthController::class, 'showUploadForm'])->name('vendor.upload_form');
        Route::post('/upload', [VendorAuthController::class, 'storeRepositoryData'])->name('vendor.upload_repository');

    });
});
Route::prefix('admin')->group(function () {
    // Admin Login Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Admin Dashboard Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        Route::resource('employees', EmployeeController::class);
        Route::resource('cities', CityController::class);
        Route::resource('types', TypeController::class);
        Route::resource('repositories', RepositoryController::class);

        Route::get('/pending', [RepositoryController::class, 'not_verified'])->name('admin.not_verified');
        Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
        Route::get('/contact_us/{id}', [ContactController::class,'show_contact'])->name('show_contact');

        
    });
});
