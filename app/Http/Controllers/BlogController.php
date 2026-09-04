<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display the blog hub: highlighted papers band + filtered feed.
     */
    public function index(Request $request)
    {
        $type = $request->query('type');
        if (!in_array($type, BlogPost::TYPES, true)) {
            $type = null;
        }

        // Papers featured in the band on the unfiltered view.
        $papers = BlogPost::published()
            ->ofType(BlogPost::TYPE_PAPER)
            ->orderByDesc('featured')
            ->latest('published_at')
            ->take(4)
            ->get();

        // The feed ships every published post and Alpine filters it in the browser,
        // so switching tabs never reloads or jumps the scroll position. The cap is a
        // safety valve — revisit with a "load more" once the archive outgrows it.
        $feed = BlogPost::published()
            ->with('user')
            ->orderByDesc('featured')
            ->latest('published_at')
            ->take(60)
            ->get();

        $counts = BlogPost::published()
            ->select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->pluck('total', 'type');

        return view('blog.index', [
            'papers' => $papers,
            'posts' => $feed,
            'activeType' => $type ?? 'all',
            'counts' => $counts,
            'totalCount' => $counts->sum(),
        ]);
    }

    /**
     * Display a single post. Papers get their own, richer template.
     */
    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->published()
            ->with(['images', 'user'])
            ->firstOrFail();

        BlogPost::whereKey($post->id)->increment('views');

        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('type', $post->type)
            ->latest('published_at')
            ->take(3)
            ->get();

        // Fall back to any recent content if there is nothing else of the same type yet.
        if ($relatedPosts->isEmpty()) {
            $relatedPosts = BlogPost::published()
                ->where('id', '!=', $post->id)
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        $view = $post->is_paper ? 'blog.paper' : 'blog.show';

        return view($view, compact('post', 'relatedPosts'));
    }

    /**
     * Show the "write a post" form for a logged-in site user.
     */
    public function create()
    {
        return view('blog.submit');
    }

    /**
     * Store a user-submitted post as pending admin review.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:6|max:255',
            'excerpt' => 'nullable|string|max:400',
            'content' => 'required|string|min:200',
            'featured_image' => 'nullable|image|max:5120',
            'tags' => 'nullable|string|max:255',
        ]);

        $post = new BlogPost([
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => $validated['content'],
            'type' => BlogPost::TYPE_BLOG,
            'status' => 'pending',
            'author' => $request->user()->name,
            'user_id' => $request->user()->id,
            'tags' => $this->parseTags($validated['tags'] ?? null),
        ]);

        if ($request->hasFile('featured_image')) {
            $post->featured_image = $request->file('featured_image')->store('blog/featured', 'public');
        }

        $post->save();

        return redirect()->route('blog.mine')
            ->with('success', 'Thanks! Your post was submitted and is now waiting for review.');
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
     * List the current user's own submissions and their review status.
     */
    public function mine(Request $request)
    {
        $posts = BlogPost::where('user_id', $request->user()->id)
            ->latest('created_at')
            ->paginate(10);

        return view('blog.mine', compact('posts'));
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
