<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dich-vu', [ServiceController::class, 'index'])->name('services.index');
Route::get('/dich-vu/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/du-an', [CaseStudyController::class, 'index'])->name('projects.index');
Route::get('/du-an/{slug}', [CaseStudyController::class, 'show'])->name('projects.show');

Route::get('/bai-viet', [BlogController::class, 'index'])->name('blog.index');
Route::get('/bai-viet/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/chuyen-muc/{slug}', [BlogController::class, 'category'])->name('blog.category');

Route::get('/ho-so-nang-luc', [ProfileController::class, 'index'])->name('profile');

Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
Route::post('/lien-he', [ContactController::class, 'submit'])->middleware('throttle:5,1')->name('contact.submit');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');