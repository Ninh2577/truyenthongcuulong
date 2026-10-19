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

Route::get('/dich-vu', [ServiceController::class, 'index'])->name('services.index');
Route::get('/dich-vu/web-app', [ServiceController::class, 'webApp'])->name('services.web-app');
Route::redirect('/web-app', '/dich-vu/web-app', 301);
Route::redirect('/dich-vu/thiet-ke-website', '/dich-vu/web-app', 301);
Route::redirect('/dich-vu/thiet-ke-web', '/dich-vu/web-app', 301);

Route::get('/dich-vu/ui-ux', [ServiceController::class, 'uiUx'])->name('services.ui-ux');
Route::get('/dich-vu/thiet-ke-ui-ux', [ServiceController::class, 'uiUx'])->name('services.thiet-ke-ui-ux');
Route::redirect('/thiet-ke-ui-ux', '/dich-vu/ui-ux', 301);
Route::redirect('/ui-ux', '/dich-vu/ui-ux', 301);

// 301 Redirects cho các dịch vụ cũ sang trang tương ứng trong menu mới
Route::redirect('/dich-vu/tu-dong-hoa', '/dich-vu/web-app', 301)->name('services.automation');
Route::redirect('/tu-dong-hoa', '/dich-vu/web-app', 301);
Route::redirect('/dich-vu/media', '/du-an/media', 301)->name('services.media');
Route::redirect('/dich-vu/booking', '/lien-he', 301)->name('booking');

Route::get('/dich-vu/marketing', [ServiceController::class, 'marketing'])->name('services.marketing');
Route::redirect('/dich-vu/marketing-online', '/dich-vu/marketing', 301);
Route::redirect('/dich-vu/dich-vu-seo-can-tho', '/dich-vu-seo-can-tho', 301);
Route::redirect('/dich-vu/seo-can-tho', '/dich-vu-seo-can-tho', 301);
Route::redirect('/dich-vu/dich-vu-seo', '/dich-vu-seo-can-tho', 301);
Route::redirect('/dich-vu/seo', '/dich-vu-seo-can-tho', 301);
Route::get('/dich-vu/quan-tri-website', [ServiceController::class, 'websiteCare'])->name('services.website-care');
Route::redirect('/quan-tri-website', '/dich-vu/quan-tri-website', 301);
Route::redirect('/dich-vu/cham-soc-website', '/dich-vu/quan-tri-website', 301);
Route::get('/dich-vu/chup-anh-su-kien', [ServiceController::class, 'eventPhotography'])->name('services.event-photography');
Route::redirect('/chup-anh-su-kien', '/dich-vu/chup-anh-su-kien', 301);
Route::get('/dich-vu/chup-anh-teambuilding', [ServiceController::class, 'teambuildingPhotography'])->name('services.teambuilding-photography');
Route::redirect('/chup-anh-teambuilding', '/dich-vu/chup-anh-teambuilding', 301);
Route::get('/dich-vu/quay-phim-su-kien', [ServiceController::class, 'eventVideography'])->name('services.event-videography');
Route::redirect('/quay-phim-su-kien', '/dich-vu/quay-phim-su-kien', 301);
Route::get('/dich-vu/quay-phim-teambuilding', [ServiceController::class, 'teambuildingVideography'])->name('services.teambuilding-videography');
Route::redirect('/quay-phim-teambuilding', '/dich-vu/quay-phim-teambuilding', 301);
Route::get('/dich-vu/quay-chup-flycam', [ServiceController::class, 'flycam'])->name('services.flycam');
Route::redirect('/quay-chup-flycam', '/dich-vu/quay-chup-flycam', 301);
Route::redirect('/dich-vu/flycam', '/dich-vu/quay-chup-flycam', 301);
Route::redirect('/flycam', '/dich-vu/quay-chup-flycam', 301);

// Route Kho / Mẫu Giao Diện Website (Hỗ trợ cả /kho-giao-dien và /mau-giao-dien)
Route::get('/kho-giao-dien', [TemplateShowcaseController::class, 'index'])->name('templates.index');
Route::get('/mau-giao-dien', [TemplateShowcaseController::class, 'index'])->name('templates.mau_giao_dien');
Route::get('/dich-vu/kho-giao-dien', [TemplateShowcaseController::class, 'index'])->name('templates.index_service');
Route::get('/dich-vu/mau-giao-dien', [TemplateShowcaseController::class, 'index']);
Route::get('/mau-website', [TemplateShowcaseController::class, 'index']);
Route::get('/dich-vu/mau-website', [TemplateShowcaseController::class, 'index']);
Route::redirect('/template-website', '/kho-giao-dien', 301);
Route::redirect('/dich-vu/template-website', '/kho-giao-dien', 301);
Route::get('/web-demo', [TemplateShowcaseController::class, 'index'])->name('templates.web-demo');

// Template preview and detail / demo routes
Route::get('/kho-giao-dien/{slug}/preview', [TemplateShowcaseController::class, 'preview'])->where('slug', '[A-Za-z0-9\-\.]+');
Route::get('/mau-giao-dien/{slug}/preview', [TemplateShowcaseController::class, 'preview'])->where('slug', '[A-Za-z0-9\-\.]+');
Route::get('/dich-vu/kho-giao-dien/{slug}/preview', [TemplateShowcaseController::class, 'preview'])->where('slug', '[A-Za-z0-9\-\.]+')->name('templates.preview');
Route::get('/dich-vu/mau-giao-dien/{slug}/preview', [TemplateShowcaseController::class, 'preview'])->where('slug', '[A-Za-z0-9\-\.]+');
Route::get('/web-demo/{slug}/preview', [TemplateShowcaseController::class, 'preview'])->where('slug', '[A-Za-z0-9\-\.]+');

Route::get('/kho-giao-dien/{slug}', [TemplateShowcaseController::class, 'show'])->where('slug', '[A-Za-z0-9\-\.]+');
Route::get('/mau-giao-dien/{slug}', [TemplateShowcaseController::class, 'show'])->where('slug', '[A-Za-z0-9\-\.]+');
Route::get('/dich-vu/kho-giao-dien/{slug}', [TemplateShowcaseController::class, 'show'])->where('slug', '[A-Za-z0-9\-\.]+')->name('templates.show');
Route::get('/dich-vu/mau-giao-dien/{slug}', [TemplateShowcaseController::class, 'show'])->where('slug', '[A-Za-z0-9\-\.]+');
Route::get('/web-demo/{slug}', [TemplateShowcaseController::class, 'show'])->where('slug', '[A-Za-z0-9\-\.]+');

Route::get('/dich-vu/bang-gia', [CompanyController::class, 'pricing'])->name('pricing');

Route::get('/dich-vu/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/du-an', [CaseStudyController::class, 'index'])->name('projects.index');
Route::get('/du-an/website', [CaseStudyController::class, 'index'])->name('projects.website');
Route::get('/du-an/media', [CaseStudyController::class, 'media'])->name('projects.media');
Route::get('/du-an/{slug}', [CaseStudyController::class, 'show'])->name('projects.show');

Route::get('/bai-viet', [BlogController::class, 'index'])->name('blog.index');
Route::redirect('/blog', '/bai-viet', 301);
Route::get('/api/search-posts', [BlogController::class, 'searchApi'])->name('api.search-posts');

// Chuyển hướng các trang cũ không còn nằm trong menu mới
Route::redirect('/tai-nguyen', '/bai-viet', 301)->name('resources.index');
Route::redirect('/ve-chung-toi', '/ho-so-nang-luc', 301)->name('about');
Route::redirect('/doi-tac', '/khach-hang', 301)->name('partners');
Route::redirect('/quy-trinh', '/ho-so-nang-luc', 301)->name('process');

// Các trang doanh nghiệp theo đúng cấu trúc menu hiện tại
Route::get('/khach-hang', [CompanyController::class, 'clients'])->name('clients');
Route::get('/tuyen-dung', [CompanyController::class, 'careers'])->name('careers');
Route::post('/tuyen-dung/apply', [CompanyController::class, 'applyJob'])->name('careers.apply');
Route::get('/ho-so-nang-luc', [ProfileController::class, 'index'])->name('profile');
Route::get('/chinh-sach-bao-mat', [CompanyController::class, 'privacy'])->name('privacy');
Route::get('/dieu-khoan-dich-vu', [CompanyController::class, 'terms'])->name('terms');

Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
Route::post('/lien-he', [ContactController::class, 'submit'])->middleware('throttle:5,1')->name('contact.submit');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Xem trước bản nháp
Route::get('/preview/post/{post}', [BlogController::class, 'preview'])->name('post.preview')->middleware('signed');
Route::match(['get', 'post'], '/preview/post/{post}/publish', [BlogController::class, 'publishFromPreview'])->name('post.preview.publish');

// Custom Media Library cho TinyMCE
Route::get('/admin/media-picker', \App\Livewire\Admin\MediaLibraryPicker::class)
    ->middleware(['web', \Filament\Http\Middleware\Authenticate::class])
    ->name('admin.media-picker');
Route::get('/cuulongteam/media-picker', \App\Livewire\Admin\MediaLibraryPicker::class)
    ->middleware(['web', \Filament\Http\Middleware\Authenticate::class]);

// Routes cho Laravel File Manager (Đã được đăng ký tự động bởi package qua config/lfm.php)
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });


// Fallback route phục vụ trực tiếp tài nguyên TinyMCE tĩnh trên hosting / LiteSpeed
Route::get('/vendor/tinymce/{path}', function (string $path) {
    $filePath = public_path('vendor/tinymce/' . $path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $mimeTypes = [
        'js' => 'application/javascript; charset=utf-8',
        'css' => 'text/css; charset=utf-8',
        'json' => 'application/json; charset=utf-8',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'svg' => 'image/svg+xml',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'ico' => 'image/x-icon',
    ];
    $contentType = $mimeTypes[$extension] ?? (mime_content_type($filePath) ?: 'text/plain');

    return response()->file($filePath, [
        'Content-Type' => $contentType,
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*');

// 301 Permanent Redirects từ URL cũ có prefix sang URL chuẩn dạng domain/{slug}
Route::redirect('/tin-tuc', '/bai-viet', 301);
Route::get('/tin-tuc/{slug}', function (string $slug) {
    return redirect()->to('/' . $slug, 301);
})->name('blog.tin-tuc');

Route::get('/bai-viet/{slug}', function (string $slug) {
    return redirect()->to('/' . $slug, 301);
})->name('blog.bai-viet');

Route::get('/category/{slug}', function (string $slug) {
    return redirect()->to('/' . $slug, 301);
});

Route::get('/chuyen-muc/{slug}', function (string $slug) {
    return redirect()->to('/' . $slug, 301);
});

// Tiện ích chạy migration và tối ưu cache trực tiếp trên Hosting
Route::get('/system/migrate-db', function (\Illuminate\Http\Request $request) {
    $hasAccess = (auth()->check() || auth('web')->check() || (class_exists(\Filament\Facades\Filament::class) && \Filament\Facades\Filament::auth()->check()));
    $keyMatch = $request->query('key') === 'cuulong123' || $request->query('key') === config('app.key');

    if (! $hasAccess && ! $keyMatch) {
        abort(403, 'Yêu cầu đăng nhập quản trị viên hoặc thêm ?key=cuulong123 vào URL.');
    }
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    $migrateOutput = \Illuminate\Support\Facades\Artisan::output();
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    $optimizeOutput = \Illuminate\Support\Facades\Artisan::output();

    return response("<pre style='background:#1e293b;color:#f8fafc;padding:20px;border-radius:8px;font-size:14px;line-height:1.6;'>=== KẾT QUẢ CHẠY MIGRATION ===\n" . htmlspecialchars($migrateOutput) . "\n=== DỌN DẸP CACHE ===\n" . htmlspecialchars($optimizeOutput) . "</pre>");
});

// API kiểm tra tin nhắn mới realtime cho toàn bộ hệ thống Admin (hiển thị popup toàn hệ thống)
Route::get('/cuulongteam/api/chat/check-new-messages', function (\Illuminate\Http\Request $request) {
    $isAuthed = auth()->check() || auth('web')->check() || (class_exists(\Filament\Facades\Filament::class) && \Filament\Facades\Filament::auth()->check());
    if (! $isAuthed) {
        return response()->json(['unauthorized' => true], 401);
    }

    $lastId = (int) $request->query('last_id', 0);

    $unreadCount = \App\Models\ChatConversation::query()
        ->where('agent_unread_count', '>', 0)
        ->count();

    $latestMsg = \App\Models\ChatMessage::query()
        ->where('sender_type', \App\Enums\ChatMessageSenderType::Visitor)
        ->with(['conversation.visitor'])
        ->latest('id')
        ->first();

    if (! $latestMsg) {
        return response()->json([
            'has_new' => false,
            'latest_id' => 0,
            'unread_total' => $unreadCount,
        ]);
    }

    if ($lastId <= 0) {
        return response()->json([
            'has_new' => false,
            'latest_id' => $latestMsg->id,
            'unread_total' => $unreadCount,
        ]);
    }

    if ($latestMsg->id <= $lastId) {
        return response()->json([
            'has_new' => false,
            'latest_id' => $lastId,
            'unread_total' => $unreadCount,
        ]);
    }

    $conv = $latestMsg->conversation;

    return response()->json([
        'has_new' => true,
        'latest_id' => $latestMsg->id,
        'message_id' => $latestMsg->id,
        'message_uuid' => $latestMsg->message_uuid,
        'conversation_uuid' => $conv?->conversation_uuid,
        'customer_name' => $conv?->visitor?->name ?: 'Khách hàng',
        'preview' => \Illuminate\Support\Str::limit($latestMsg->message_body, 90),
        'created_at' => $latestMsg->created_at?->diffForHumans(),
        'unread_total' => $unreadCount,
    ]);
});

// Chuyển hướng 301 TẤT CẢ các bài viết thuộc bất kỳ danh mục nào
// Dạng: domain/{danh-muc}/{ten-bai-viet} -> domain/{ten-bai-viet}
Route::get('/{category}/{slug}', [BlogController::class, 'resolveCategoryPost'])
    ->where('category', '[A-Za-z0-9\-]+')
    ->where('slug', '[A-Za-z0-9\-]+');

// Route trang lỗi 404
Route::get('/404', function () {
    return response()->view('errors.404', [], 404);
})->name('error.404');

// Catch-All Route cho bài viết và chuyên mục (URL chuẩn: domain/{slug})
// Route này phải luôn đặt ở CUỐI CÙNG để không nuốt các route hệ thống!
Route::get('/{slug}', [BlogController::class, 'resolveSlug'])->name('blog.resolve');

// Fallback toàn diện: Tự động bắt mọi URL tùy chỉnh được đặt trong Menu Website
Route::fallback(function (\Illuminate\Http\Request $request) {
    $menuResult = \App\Services\MenuRouteResolver::resolve($request->path(), $request);
    if ($menuResult) {
        return $menuResult;
    }
    abort(404);
});



