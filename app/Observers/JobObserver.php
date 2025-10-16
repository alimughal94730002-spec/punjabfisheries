<?php

namespace App\Observers;

use App\Models\Job;
use App\Services\SitemapService;
use Illuminate\Support\Facades\Log;

class JobObserver
{
    protected $sitemapService;

    public function __construct(SitemapService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }

    /**
     * Handle the Job "created" event.
     */
    public function created(Job $job): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Job "updated" event.
     */
    public function updated(Job $job): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Job "deleted" event.
     */
    public function deleted(Job $job): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Job "restored" event.
     */
    public function restored(Job $job): void
    {
        $this->clearSitemapCache();
    }

    /**
     * Handle the Job "force deleted" event.
     */
    public function forceDeleted(Job $job): void
    {
        $this->clearSitemapCache();
    }

    private function clearSitemapCache(): void
    {
        try {
            $this->sitemapService->clearCache();
            Log::info('Sitemap cache cleared due to Job change');
        } catch (\Exception $e) {
            Log::error('Failed to clear sitemap cache: ' . $e->getMessage());
        }
    }
}