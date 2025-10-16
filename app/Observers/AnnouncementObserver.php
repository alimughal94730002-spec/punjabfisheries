<?php

namespace App\Observers;

use App\Models\Announcement;
use App\Services\SitemapService;
use Illuminate\Support\Facades\Log;

class AnnouncementObserver
{
    protected $sitemapService;

    public function __construct(SitemapService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }

    /**
     * Handle the Announcement "created" event.
     */
    public function created(Announcement $announcement): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Announcement "updated" event.
     */
    public function updated(Announcement $announcement): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Announcement "deleted" event.
     */
    public function deleted(Announcement $announcement): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Announcement "restored" event.
     */
    public function restored(Announcement $announcement): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Announcement "force deleted" event.
     */
    public function forceDeleted(Announcement $announcement): void
    {
        $this->clearSitemapCache();
    }

    private function clearSitemapCache(): void
    {
        try {
            $this->sitemapService->clearCache();
            Log::info('Sitemap cache cleared due to Announcement change');
        } catch (\Exception $e) {
            Log::error('Failed to clear sitemap cache: ' . $e->getMessage());
        }
    }
}