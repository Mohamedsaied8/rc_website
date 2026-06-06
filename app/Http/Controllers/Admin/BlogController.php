<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index()
    {
        $posts = BlogPost::latest('created_at')->paginate(15);
        return view('admin.blog.index', compact('posts'));
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|max:5120', // 5MB max
            'images.*' => 'nullable|image|max:5120',
            'captions.*' => 'nullable|string|max:255'
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        // Set published_at if status is published
        if ($validated['status'] === 'published' && !isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Create the blog post
        $post = BlogPost::create($validated);

        // Handle additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('blog/images', 'public');
                $caption = $request->input('captions.' . $index, null);

                BlogImage::create([
                    'blog_post_id' => $post->id,
                    'image_path' => $imagePath,
                    'caption' => $caption,
                    'order' => $index
                ]);
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created successfully!');
    }

    /**
     * Show the form for editing the specified blog post.
     */
    public function edit(BlogPost $blog)
    {
        $post = $blog->load('images');
        return view('admin.blog.edit', compact('post'));
    }

    /**
     * Update the specified blog post.
     */
    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|max:5120',
            'images.*' => 'nullable|image|max:5120',
            'captions.*' => 'nullable|string|max:255',
            'remove_images' => 'nullable|array'
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old featured image
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog/featured', 'public');
        }

        // Set published_at if status changed to published
        if ($validated['status'] === 'published' && $blog->status === 'draft') {
            $validated['published_at'] = now();
        }

        // Update the blog post
        $blog->update($validated);

        // Remove selected images
        if ($request->has('remove_images')) {
            foreach ($request->input('remove_images') as $imageId) {
                $image = BlogImage::find($imageId);
                if ($image && $image->blog_post_id === $blog->id) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // Handle new images
        if ($request->hasFile('images')) {
            $currentMaxOrder = $blog->images()->max('order') ?? 0;

            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('blog/images', 'public');
                $caption = $request->input('captions.' . $index, null);

                BlogImage::create([
                    'blog_post_id' => $blog->id,
                    'image_path' => $imagePath,
                    'caption' => $caption,
                    'order' => $currentMaxOrder + $index + 1
                ]);
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated successfully!');
    }

    /**
     * Remove the specified blog post.
     */
    public function destroy(BlogPost $blog)
    {
        // Delete featured image
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        // Delete all associated images
        foreach ($blog->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted successfully!');
    }
}
