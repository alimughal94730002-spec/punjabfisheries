<?php

namespace App\Observers;

use App\Models\BlogPost;
use App\Services\SitemapService;
use Illuminate\Support\Facades\Log;

class BlogPostObserver
{
    protected $sitemapService;

    public function __construct(SitemapService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }

    /**
     * Handle the BlogPost "created" event.
     */
    public function created(BlogPost $blogPost): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the BlogPost "updated" event.
     */
    public function updated(BlogPost $blogPost): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the BlogPost "deleted" event.
     */
    public function deleted(BlogPost $blogPost): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the BlogPost "restored" event.
     */
    public function restored(BlogPost $blogPost): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the BlogPost "force deleted" event.
     */
    public function forceDeleted(BlogPost $blogPost): void
    {
        $this->clearSitemapCache();
    }

    private function clearSitemapCache(): void
    {
        try {
            $this->sitemapService->clearCache();
            Log::info('Sitemap cache cleared due to BlogPost change');
        } catch (\Exception $e) {
            Log::error('Failed to clear sitemap cache: ' . $e->getMessage());
        }
    }
}