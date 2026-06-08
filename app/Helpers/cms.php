<?php

use App\Models\CmsPage;
use Illuminate\Support\Facades\Cache;

if (!function_exists('cms')) {
    function cms($path, $default = null, $isAttribute = false)
    {
        $parts = explode('.', $path);
        if (count($parts) !== 3) {
            return $default;
        }

        [$pageSlug, $sectionSlug, $blockKey] = $parts;
        $cacheKey = "cms_page_{$pageSlug}";

        $pageData = Cache::remember($cacheKey, 3600, function () use ($pageSlug) {
            $page = CmsPage::with(['sections' => function($q) {
                $q->where('is_active', true);
            }, 'sections.blocks'])->where('slug', $pageSlug)->where('is_active', true)->first();

            if (!$page) return null;

            $data = [];
            foreach ($page->sections as $section) {
                $sectionData = [];
                foreach ($section->blocks as $block) {
                    $sectionData[$block->key] = $block->value;
                }
                $data[$section->slug] = $sectionData;
            }
            return $data;
        });

        $value = $default;
        if ($pageData && isset($pageData[$sectionSlug][$blockKey]) && !empty($pageData[$sectionSlug][$blockKey])) {
            $value = $pageData[$sectionSlug][$blockKey];
        }

        // Inline editing wrapper logic
        if (auth('admin')->check() && request('edit') == '1') {
            if ($isAttribute) {
                // Return just the value if it's an attribute, but maybe we can't easily make it editable inline.
                // We will handle attributes via a custom editor panel or skip them for inline.
                return $value;
            }
            
            // For text/html blocks, wrap them so they can be selected and edited.
            // We use span by default.
            $wrapper = sprintf(
                '<cms-editable data-cms-key="%s" style="display:inline; position:relative; min-width: 20px; outline: 1px dashed rgba(255,255,255,0.7); outline-offset: 2px; cursor: text;">%s</cms-editable>',
                $path,
                $value
            );
            return new \Illuminate\Support\HtmlString($wrapper);
        }

        // Return HtmlString anyway so if the content has HTML (like from tinyMCE previously), it renders correctly.
        return new \Illuminate\Support\HtmlString($value);
    }
}
