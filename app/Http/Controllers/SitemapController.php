<?php

namespace App\Http\Controllers;

use App\Services\SitemapService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    protected $sitemapService;

    public function __construct(SitemapService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }

    public function index()
    {
        $sitemap = $this->sitemapService->getSitemap();

        return response($sitemap, 200, [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public, max-age=3600', // Cache for 1 hour
        ]);
    }

    /**
     * Regenerate sitemap manually
     */
    public function regenerate()
    {
        $sitemap = $this->sitemapService->regenerateSitemap();
        
        return response($sitemap, 200, [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Get sitemap statistics
     */
    public function stats()
    {
        $stats = $this->sitemapService->getSitemapStats();
        
        return response()->json($stats);
    }

    /**
     * Generate sitemap index for large sites
     */
    public function indexFile()
    {
        $sitemapIndex = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemapIndex .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        $sitemapIndex .= '<sitemap>
            <loc>' . route('sitemap.xml') . '</loc>
            <lastmod>' . now()->format('Y-m-d\TH:i:s\Z') . '</lastmod>
        </sitemap>';
        
        $sitemapIndex .= '</sitemapindex>';

        return response($sitemapIndex, 200, [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}