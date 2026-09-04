<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts, filterable by status and type.
     */
    public function index(Request $request)
    {
        $status = in_array($request->query('status'), ['draft', 'pending', 'published', 'rejected'], true)
            ? $request->query('status')
            : null;
        $type = in_array($request->query('type'), BlogPost::TYPES, true) ? $request->query('type') : null;

        $posts = BlogPost::with(['user', 'images'])
            ->when($status, fn ($q) => $q->where('status', $status))
            ->when($type, fn ($q) => $q->where('type', $type))
            // Submissions awaiting review float to the top — they're the actionable ones.
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        $pendingCount = BlogPost::pending()->count();

        return view('admin.blog.index', compact('posts', 'pendingCount', 'status', 'type'));
    }

    /**
     * Show the form for creating a new blog post.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created blog post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $validated['tags'] = $this->parseTags($request->input('tags'));
        $validated['featured'] = $request->boolean('featured');

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        if ($request->hasFile('paper_pdf')) {
            $validated['paper_pdf'] = $request->file('paper_pdf')->store('blog/papers', 'public');
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $post = BlogPost::create($validated);

        $this->syncGalleryImages($request, $post);

        return redirect()->route('admin.blog.index')->with('success', 'Post created successfully!');
    }

    /**
     * Show the form for editing the specified blog post.
     */
    public function edit(BlogPost $blog)
    {
        $post = $blog->load(['images', 'user']);
        return view('admin.blog.edit', compact('post'));
    }

    /**
     * Update the specified blog post.
     */
    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate($this->rules() + [
            'remove_images' => 'nullable|array',
        ]);

        $validated['tags'] = $this->parseTags($request->input('tags'));
        $validated['featured'] = $request->boolean('featured');

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        if ($request->hasFile('paper_pdf')) {
            if ($blog->paper_pdf) {
                Storage::disk('public')->delete($blog->paper_pdf);
            }
            $validated['paper_pdf'] = $request->file('paper_pdf')->store('blog/papers', 'public');
        }

        // Stamp published_at the first time a post actually goes live.
        if ($validated['status'] === 'published' && !$blog->published_at) {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        if ($request->has('remove_images')) {
            foreach ($request->input('remove_images') as $imageId) {
                $image = BlogImage::find($imageId);
                if ($image && $image->blog_post_id === $blog->id) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        $this->syncGalleryImages($request, $blog, $blog->images()->max('order') ?? 0);

        return redirect()->route('admin.blog.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Render markdown for the editor preview, using the same pipeline as the
     * published page so the preview can't drift from the real thing.
     */
    public function preview(Request $request)
    {
        $validated = $request->validate(['content' => 'nullable|string|max:200000']);

        return response()->json([
            'html' => BlogPost::renderMarkdown($validated['content'] ?? ''),
        ]);
    }

    /**
     * Approve a user-submitted post and publish it.
     */
    public function approve(BlogPost $blog)
    {
        $blog->update([
            'status' => 'published',
            'rejection_reason' => null,
            'published_at' => $blog->published_at ?? now(),
        ]);

        return back()->with('success', '"' . $blog->title . '" is now live.');
    }

    /**
     * Reject a user-submitted post, optionally with a reason for the author.
     */
    public function reject(Request $request, BlogPost $blog)
    {
        $request->validate(['rejection_reason' => 'nullable|string|max:500']);

        $blog->update([
            'status' => 'rejected',
            'rejection_reason' => $request->input('rejection_reason'),
        ]);

        return back()->with('success', '"' . $blog->title . '" was rejected.');
    }

    /**
     * Remove the specified blog post.
     */
    public function destroy(BlogPost $blog)
    {
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        if ($blog->paper_pdf) {
            Storage::disk('public')->delete($blog->paper_pdf);
        }

        foreach ($blog->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Post deleted successfully!');
    }

    /**
     * Shared validation rules for store/update. Every paper field is optional.
     */
    private function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', BlogPost::TYPES),
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'status' => 'required|in:draft,pending,published,rejected',
            'featured_image' => 'nullable|image|max:5120', // 5MB max
            'images.*' => 'nullable|image|max:5120',
            'captions.*' => 'nullable|string|max:255',
            'paper_authors' => 'nullable|string|max:255',
            'paper_abstract' => 'nullable|string',
            'paper_venue' => 'nullable|string|max:255',
            'paper_year' => 'nullable|integer|min:1950|max:2100',
            'paper_doi' => 'nullable|string|max:255',
            'paper_url' => 'nullable|url|max:255',
            'paper_pdf' => 'nullable|file|mimes:pdf|max:20480',
            'paper_code_url' => 'nullable|url|max:255',
            'paper_bibtex' => 'nullable|string',
        ];
    }

    /**
     * Store any newly uploaded gallery images against the post.
     */
    private function syncGalleryImages(Request $request, BlogPost $post, int $startOrder = 0): void
    {
        if (!$request->hasFile('images')) {
            return;
        }

        foreach ($request->file('images') as $index => $image) {
            BlogImage::create([
                'blog_post_id' => $post->id,
                'image_path' => $image->store('blog/images', 'public'),
                'caption' => $request->input('captions.' . $index),
                'order' => $startOrder + $index + 1,
            ]);
        }
    }

    /**
     * Turn "robotics, ros2 , slam" into a clean array of at most 5 tags.
     */
    private function parseTags(?string $raw): ?array
    {
        if (!$raw) {
            return null;
        }

        $tags = collect(explode(',', $raw))
            ->map(fn ($t) => trim($t))
            ->filter()
            ->unique()
            ->take(5)
            ->values()
            ->all();

        return $tags ?: null;
    }
}
