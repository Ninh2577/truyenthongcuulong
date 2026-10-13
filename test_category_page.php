<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $categoryPage = new App\Filament\Resources\CategoryResource\Pages\ListCategories();
    // Use reflection to call getDisplayData if protected
    $reflection = new ReflectionClass($categoryPage);
    $method = $reflection->getMethod('getDisplayData');
    $method->setAccessible(true);
    $data = $method->invoke($categoryPage);
    echo "getDisplayData OK! Found " . count($data['categories']) . " categories on page 1.\n";
    echo "Total: " . $data['total'] . "\n";
    echo "Active count: " . $data['activeCount'] . "\n";
    
    // Now test view rendering
    $view = view('filament.resources.category-resource.pages.list-categories', array_merge($categoryPage->getViewData(), [
        'search' => $categoryPage->search,
        'selectedStatus' => $categoryPage->selectedStatus,
        'selectedSort' => $categoryPage->selectedSort,
        'perPage' => $categoryPage->perPage,
        'currentPage' => $categoryPage->currentPage,
        'viewMode' => $categoryPage->viewMode,
        'selectedCategories' => $categoryPage->selectedCategories,
        'selectAll' => $categoryPage->selectAll,
        'dateRange' => $categoryPage->dateRange,
        'showDeleteModal' => $categoryPage->showDeleteModal,
        'categoryToDeleteId' => $categoryPage->categoryToDeleteId,
        'categoryToDeleteName' => $categoryPage->categoryToDeleteName,
    ]));
    $html = $view->render();
    echo "View Rendered OK! HTML length: " . strlen($html) . "\n";
} catch (Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo $e->getFile() . ":" . $e->getLine() . "\n";
    echo $e->getTraceAsString() . "\n";
}
