<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$page = \App\Models\CmsPage::where('slug', 'home')->first();
if ($page) {
    $section = $page->sections()->where('slug', 'products')->first();
    if ($section) {
        $block = $section->blocks()->where('key', 'ide_title')->first();
        if ($block) {
            $block->value = 'RoboAgent IDE';
            $block->save();
            echo 'Updated CMS ide_title!';
        }
    }
}
\Illuminate\Support\Facades\Cache::flush();
