<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceCenterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TemplateShowcaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dev-analyze-xml', function () {
    ob_start();
    require base_path('analyze_wp.php');
    return '<pre>' . ob_get_clean() . '</pre>';
});

Route::get('/dich-vu', [ServiceController::class, 'index'])->name('services.index');
Route::get('/dich-vu/web-app', [ServiceController::class, 'webApp'])->name('services.web-app');
Route::get('/dich-vu/media', [ServiceController::class, 'media'])->name('services.media');
Route::get('/dich-vu/marketing', [ServiceController::class, 'marketing'])->name('services.marketing');
Route::get('/dich-vu/booking', [ServiceController::class, 'booking'])->name('booking');

// Moved up to prevent /dich-vu/{slug} from swallowing them
Route::get('/dich-vu/kho-giao-dien', [TemplateShowcaseController::class, 'index'])->name('templates.index');
Route::get('/dich-vu/bang-gia', [CompanyController::class, 'pricing'])->name('pricing');

Route::get('/dich-vu/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/du-an', [CaseStudyController::class, 'index'])->name('projects.index');
Route::get('/du-an/{slug}', [CaseStudyController::class, 'show'])->name('projects.show');

Route::get('/bai-viet', [BlogController::class, 'index'])->name('blog.index');
Route::get('/api/search-posts', [BlogController::class, 'searchApi'])->name('api.search-posts');

// Khai thác nội dung cũ (Giai đoạn 3)
Route::get('/tai-nguyen', [ResourceCenterController::class, 'index'])->name('resources.index');
Route::post('/tai-nguyen/download', [ResourceCenterController::class, 'downloadLead'])->name('resources.download');

// Các trang doanh nghiệp mới (Giai đoạn 4)
Route::get('/ve-chung-toi', [CompanyController::class, 'about'])->name('about');
Route::get('/doi-tac', [CompanyController::class, 'partners'])->name('partners');
Route::get('/khach-hang', [CompanyController::class, 'clients'])->name('clients');
Route::get('/tuyen-dung', [CompanyController::class, 'careers'])->name('careers');
Route::post('/tuyen-dung/apply', [CompanyController::class, 'applyJob'])->name('careers.apply');
Route::get('/chinh-sach-bao-mat', [CompanyController::class, 'privacy'])->name('privacy');
Route::get('/dieu-khoan-dich-vu', [CompanyController::class, 'terms'])->name('terms');

Route::get('/ho-so-nang-luc', [ProfileController::class, 'index'])->name('profile');

Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
Route::post('/lien-he', [ContactController::class, 'submit'])->middleware('throttle:5,1')->name('contact.submit');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Xem trước bản nháp
Route::get('/preview/post/{post}', [BlogController::class, 'preview'])->name('post.preview')->middleware('signed');

// Custom Media Library cho TinyMCE
Route::get('/admin/media-picker', \App\Livewire\Admin\MediaLibraryPicker::class)
    ->middleware(['web', 'auth'])
    ->name('admin.media-picker');

// Routes cho Laravel File Manager (TinyMCE)
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Catch-All Route cho bài viết và chuyên mục (Giai đoạn 1 Migration)
// Route này phải luôn đặt ở CUỐI CÙNG để không nuốt các route hệ thống!
Route::get('/{slug}', [BlogController::class, 'resolveSlug'])->name('blog.resolve');
