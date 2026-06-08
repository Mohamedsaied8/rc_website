<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$page = \App\Models\CmsPage::where('slug', 'products')->first();
if ($page) {
    $section = $page->sections()->where('slug', 'ide')->first();
    if ($section) {
        $block = $section->blocks()->where('key', 'title')->first();
        if ($block) {
            $block->value = 'RoboAgent IDE';
            $block->save();
            echo 'Updated CMS products.ide.title!';
        }
    }
}
\Illuminate\Support\Facades\Cache::flush();
