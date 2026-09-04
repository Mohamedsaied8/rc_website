<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Schema;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Static marketing pages
        $static = [
            ['loc' => url('/'), 'priority' => '1.0', 'freq' => 'weekly'],
            ['loc' => url('/about'), 'priority' => '0.7', 'freq' => 'monthly'],
            ['loc' => url('/services'), 'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => url('/services/rnd'), 'priority' => '0.6', 'freq' => 'monthly'],
            ['loc' => url('/services/consultation'), 'priority' => '0.6', 'freq' => 'monthly'],
            ['loc' => url('/services/outsourcing'), 'priority' => '0.6', 'freq' => 'monthly'],
            ['loc' => url('/products'), 'priority' => '0.7', 'freq' => 'monthly'],
            ['loc' => url('/programs'), 'priority' => '0.9', 'freq' => 'weekly'],
            ['loc' => url('/blog'), 'priority' => '0.7', 'freq' => 'weekly'],
            ['loc' => url('/contact'), 'priority' => '0.6', 'freq' => 'yearly'],
        ];
        foreach ($static as $s) {
            $urls[] = $s + ['lastmod' => null];
        }

        // Programs
        try {
            Program::where('is_active', true)->get()->each(function ($p) use (&$urls) {
                $urls[] = [
                    'loc' => url('/programs/' . $p->slug),
                    'priority' => '0.8',
                    'freq' => 'weekly',
                    'lastmod' => optional($p->updated_at)->toAtomString(),
                ];
            });
        } catch (\Throwable $e) {
            // ignore if table not ready
        }

        // Published blog posts
        try {
            $query = BlogPost::query();
            if (Schema::hasColumn('blog_posts', 'status')) {
                $query->where('status', 'published');
            } elseif (Schema::hasColumn('blog_posts', 'is_published')) {
                $query->where('is_published', true);
            }
            $query->get()->each(function ($post) use (&$urls) {
                $urls[] = [
                    'loc' => url('/blog/' . $post->slug),
                    'priority' => '0.6',
                    'freq' => 'monthly',
                    'lastmod' => optional($post->updated_at)->toAtomString(),
                ];
            });
        } catch (\Throwable $e) {
            // ignore if table not ready
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $u) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . htmlspecialchars($u['loc'], ENT_XML1) . "</loc>\n";
            if (!empty($u['lastmod'])) {
                $xml .= '    <lastmod>' . htmlspecialchars($u['lastmod'], ENT_XML1) . "</lastmod>\n";
            }
            $xml .= '    <changefreq>' . $u['freq'] . "</changefreq>\n";
            $xml .= '    <priority>' . $u['priority'] . "</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
