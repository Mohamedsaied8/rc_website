<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use App\Models\CmsBlock;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CmsApiController extends Controller
{
    public function saveInline(Request $request)
    {
        $request->validate([
            'blocks' => 'array',
            'blocks.*' => 'string|nullable',
            'custom_pages' => 'array',
            'custom_pages.*' => 'string|nullable',
        ]);

        $updatedPages = [];

        // Save individual blocks (Home, About, etc.)
        if ($request->has('blocks')) {
            foreach ($request->blocks as $key => $value) {
                // Key format: pageSlug.sectionSlug.blockKey
                $parts = explode('.', $key);
                if (count($parts) === 3) {
                    $pageSlug = $parts[0];
                    $sectionSlug = $parts[1];
                    $blockKey = $parts[2];

                    $page = CmsPage::where('slug', $pageSlug)->first();
                    if ($page) {
                        $section = $page->sections()->where('slug', $sectionSlug)->first();
                        if ($section) {
                            $block = $section->blocks()->where('key', $blockKey)->first();
                            if ($block) {
                                // Important: We use strip_tags for text/textarea if needed, 
                                // but since they might want formatting on heroes, we allow HTML.
                                $block->update(['value' => $value]);
                                $updatedPages[$pageSlug] = true;
                            }
                        }
                    }
                }
            }
        }

        // Save full custom pages
        if ($request->has('custom_pages')) {
            foreach ($request->custom_pages as $slug => $html) {
                $page = CmsPage::where('slug', $slug)->first();
                if ($page && $page->is_custom) {
                    $page->update(['custom_html' => $html]);
                    $updatedPages[$slug] = true;
                }
            }
        }

        // Clear caches for updated pages
        foreach (array_keys($updatedPages) as $slug) {
            Cache::forget("cms_page_{$slug}");
        }
        
        // Also clear global cache since header/footer might be updated
        Cache::forget("cms_page_global");

        return response()->json(['success' => true, 'message' => 'Changes saved successfully!']);
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('public/cms');
            $url = Storage::url($path);
            return response()->json(['url' => $url]);
        }
        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
