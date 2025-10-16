<?php

namespace App\Console\Commands;

use App\Services\SitemapService;
use Illuminate\Console\Command;

class GenerateSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate 
                            {--force : Force regeneration even if cache exists}
                            {--save-file : Save sitemap to public/sitemap.xml file}
                            {--stats : Show sitemap statistics}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and cache the XML sitemap';

    protected $sitemapService;

    public function __construct(SitemapService $sitemapService)
    {
        parent::__construct();
        $this->sitemapService = $sitemapService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Generating XML Sitemap...');

        try {
            if ($this->option('force')) {
                $this->info('🔄 Force regenerating sitemap...');
                $sitemap = $this->sitemapService->regenerateSitemap();
            } else {
                $sitemap = $this->sitemapService->getSitemap();
            }

            $this->info('✅ Sitemap generated successfully!');

            if ($this->option('save-file')) {
                $this->info('💾 Saving sitemap to file...');
                if ($this->sitemapService->saveSitemapToFile()) {
                    $this->info('✅ Sitemap saved to public/sitemap.xml');
                } else {
                    $this->error('❌ Failed to save sitemap to file');
                }
            }

            if ($this->option('stats')) {
                $this->showStats();
            }

            $this->info('📊 Sitemap URL: ' . route('sitemap.xml'));
            $this->info('📈 Sitemap size: ' . number_format(strlen($sitemap)) . ' characters');

        } catch (\Exception $e) {
            $this->error('❌ Error generating sitemap: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    private function showStats()
    {
        $stats = $this->sitemapService->getSitemapStats();
        
        $this->info('📊 Sitemap Statistics:');
        $this->table(
            ['Metric', 'Count'],
            [
                ['Total URLs', $stats['total_urls']],
                ['Blog Posts', $stats['blog_posts']],
                ['Announcements', $stats['announcements']],
                ['Jobs', $stats['jobs']],
                ['Tenders', $stats['tenders']],
                ['Pages', $stats['pages']],
            ]
        );
        
        $this->info('⏰ Cache expires: ' . $stats['cache_expires']);
    }
}