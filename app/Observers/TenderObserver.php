<?php

namespace App\Observers;

use App\Models\Tender;
use App\Services\SitemapService;
use Illuminate\Support\Facades\Log;

class TenderObserver
{
    protected $sitemapService;

    public function __construct(SitemapService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }

    /**
     * Handle the Tender "created" event.
     */
    public function created(Tender $tender): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Tender "updated" event.
     */
    public function updated(Tender $tender): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Tender "deleted" event.
     */
    public function deleted(Tender $tender): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Tender "restored" event.
     */
    public function restored(Tender $tender): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Tender "force deleted" event.
     */
    public function forceDeleted(Tender $tender): void
    {
        $this->clearSitemapCache();
    }

    private function clearSitemapCache(): void
    {
        try {
            $this->sitemapService->clearCache();
            Log::info('Sitemap cache cleared due to Tender change');
        } catch (\Exception $e) {
            Log::error('Failed to clear sitemap cache: ' . $e->getMessage());
        }
    }
}