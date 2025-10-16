<?php

namespace App\Observers;

use App\Models\Page;
use App\Services\SitemapService;
use Illuminate\Support\Facades\Log;

class PageObserver
{
    protected $sitemapService;

    public function __construct(SitemapService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }

    /**
     * Handle the Page "created" event.
     */
    public function created(Page $page): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Page "updated" event.
     */
    public function updated(Page $page): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Page "deleted" event.
     */
    public function deleted(Page $page): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Page "restored" event.
     */
    public function restored(Page $page): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Page "force deleted" event.
     */
    public function forceDeleted(Page $page): void
    {
        $this->clearSitemapCache();
    }

    private function clearSitemapCache(): void
    {
        try {
            $this->sitemapService->clearCache();
            Log::info('Sitemap cache cleared due to Page change');
        } catch (\Exception $e) {
            Log::error('Failed to clear sitemap cache: ' . $e->getMessage());
        }
    }
}