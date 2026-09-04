<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CmsPage;
use App\Models\CmsSection;
use App\Models\CmsBlock;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CmsPageController extends Controller
{
    public function index()
    {
        $pages = CmsPage::withCount('sections')->orderBy('sort_order')->get();
        return view('admin.cms.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.cms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:cms_pages|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        CmsPage::create([
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
            'is_custom' => true,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(CmsPage $page)
    {
        if ($page->is_custom) {
            return redirect()->to('/' . $page->slug . '?edit=1');
        } else {
            // For predefined pages, redirect to their hardcoded route with ?edit=1
            $routeMap = [
                'home' => '/',
                'about' => '/about',
                'contact' => '/contact',
                'products' => '/products',
                'services' => '/services',
            ];
            $url = $routeMap[$page->slug] ?? '/';
            return redirect()->to($url . '?edit=1');
        }
    }

    public function destroy(CmsPage $page)
    {
        if (!$page->is_custom) {
            return redirect()->back()->with('error', 'Cannot delete a core system page.');
        }

        $page->delete();
        Cache::forget("cms_page_{$page->slug}");
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('cms', 'public');
            $url = \Illuminate\Support\Facades\Storage::url($path);
            return response()->json(['location' => $url]);
        }
        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
