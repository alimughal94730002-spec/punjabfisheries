<?php

namespace App\Services;

use App\Models\BlogPost;
use App\Models\Announcement;
use App\Models\Job;
use App\Models\Tender;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SitemapService
{
    const CACHE_KEY = 'sitemap_xml';
    const CACHE_DURATION = 3600; // 1 hour

    /**
     * Generate and cache the sitemap XML
     */
    public function generateSitemap(): string
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage
        $sitemap .= $this->addUrl(route('frontend.home'), '1.0', 'daily');

        // Static pages
        $staticPages = [
            'frontend.about' => ['priority' => '0.8', 'changefreq' => 'monthly'],
            'frontend.blogs' => ['priority' => '0.9', 'changefreq' => 'weekly'],
            'frontend.announcements' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            'frontend.jobs' => ['priority' => '0.8', 'changefreq' => 'weekly'],
            'frontend.tenders' => ['priority' => '0.7', 'changefreq' => 'monthly'],
            'frontend.shrimp.map' => ['priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        foreach ($staticPages as $route => $config) {
            try {
                $sitemap .= $this->addUrl(route($route), $config['priority'], $config['changefreq']);
            } catch (\Exception $e) {
                continue;
            }
        }

        // Blog posts
        $blogPosts = BlogPost::published()
            ->orderBy('published_at', 'desc')
            ->get();

        foreach ($blogPosts as $post) {
            $sitemap .= $this->addUrl(
                route('frontend.blog.details', $post->slug),
                '0.7',
                'monthly',
                $post->updated_at
            );
        }

        // Announcements
        $announcements = Announcement::active()
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($announcements as $announcement) {
            $sitemap .= $this->addUrl(
                route('frontend.announcements.show', $announcement->id),
                '0.6',
                'monthly',
                $announcement->updated_at
            );
        }

        // Jobs
        $jobs = Job::active()
            ->where('application_deadline', '>=', now())
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($jobs as $job) {
            $sitemap .= $this->addUrl(
                route('frontend.jobs.show', $job->id),
                '0.6',
                'weekly',
                $job->updated_at
            );
        }

        // Tenders
        $tenders = Tender::active()
            ->where('deadline', '>=', now())
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($tenders as $tender) {
            $sitemap .= $this->addUrl(
                route('frontend.tenders.show', $tender->id),
                '0.5',
                'monthly',
                $tender->updated_at
            );
        }

        // CMS Pages
        $pages = Page::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($pages as $page) {
            $sitemap .= $this->addUrl(
                route('frontend.page', $page->slug),
                '0.6',
                'monthly',
                $page->updated_at
            );
        }

        $sitemap .= '</urlset>';

        return $sitemap;
    }

    /**
     * Get cached sitemap or generate new one
     */
    public function getSitemap(): string
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_DURATION, function () {
            return $this->generateSitemap();
        });
    }

    /**
     * Clear sitemap cache (call this when content changes)
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Regenerate sitemap and update cache
     */
    public function regenerateSitemap(): string
    {
        $this->clearCache();
        return $this->getSitemap();
    }

    /**
     * Save sitemap to file (optional - for static file generation)
     */
    public function saveSitemapToFile(): bool
    {
        try {
            $sitemap = $this->generateSitemap();
            Storage::disk('public')->put('sitemap.xml', $sitemap);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to save sitemap to file: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get sitemap statistics
     */
    public function getSitemapStats(): array
    {
        $sitemap = $this->generateSitemap();
        $urlCount = substr_count($sitemap, '<url>');
        
        return [
            'total_urls' => $urlCount,
            'blog_posts' => BlogPost::published()->count(),
            'announcements' => Announcement::active()->count(),
            'jobs' => Job::active()->where('application_deadline', '>=', now())->count(),
            'tenders' => Tender::active()->where('deadline', '>=', now())->count(),
            'pages' => Page::where('status', 'published')->count(),
            'last_generated' => Cache::get(self::CACHE_KEY . '_timestamp', 'Never'),
            'cache_expires' => now()->addSeconds(self::CACHE_DURATION)->format('Y-m-d H:i:s'),
        ];
    }

    private function addUrl($url, $priority = '0.5', $changefreq = 'monthly', $lastmod = null)
    {
        $url = htmlspecialchars($url);
        $priority = htmlspecialchars($priority);
        $changefreq = htmlspecialchars($changefreq);
        
        $lastmod = $lastmod ? $lastmod->format('Y-m-d\TH:i:s\Z') : now()->format('Y-m-d\TH:i:s\Z');
        
        return "<url>
            <loc>{$url}</loc>
            <lastmod>{$lastmod}</lastmod>
            <changefreq>{$changefreq}</changefreq>
            <priority>{$priority}</priority>
        </url>";
    }
}
