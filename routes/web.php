<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::post('/locale', [PortfolioController::class, 'setLocale'])->name('locale.set');
Route::post('/contact', [PortfolioController::class, 'sendMessage'])->name('contact.send');

// Blog public routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/sitemap.xml', [BlogController::class, 'sitemap'])->name('blog.sitemap');

// Auth routes
require __DIR__.'/auth.php';

// Admin routes (protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [Admin\ProfileController::class, 'update'])->name('profile.update.post');

    // Resources
    Route::resource('experiences', Admin\ExperienceController::class)->except(['show']);
    Route::resource('educations', Admin\EducationController::class)->except(['show']);
    Route::resource('skills', Admin\SkillController::class)->except(['show']);
    Route::resource('certificates', Admin\CertificateController::class)->except(['show']);
    Route::resource('hobbies', Admin\HobbyController::class)->except(['show']);
    Route::resource('projects', Admin\ProjectController::class)->except(['show']);

    // Testimonials
    Route::resource('testimonials', Admin\TestimonialController::class)->except(['show']);

    // Blog
    Route::resource('blog', Admin\BlogPostController::class)->except(['show'])
        ->parameters(['blog' => 'blog']);
    Route::resource('blog-categories', Admin\BlogCategoryController::class)->except(['show']);


    Route::get('/setup-token', function () {
    $user = App\Models\User::first();
    $token = $user->createToken('n8n-blog')->plainTextToken;
    dd($token);
});


    // Messages
    Route::get('/messages', [Admin\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [Admin\MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [Admin\MessageController::class, 'destroy'])->name('messages.destroy');
});
