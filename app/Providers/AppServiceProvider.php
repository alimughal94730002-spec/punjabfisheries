<?php

namespace App\Providers;

use App\Models\Gallery;
use App\Models\BlogPost;
use App\Models\Announcement;
use App\Models\Job;
use App\Models\Tender;
use App\Models\Page;
use App\Policies\GalleryPolicy;
use App\Observers\BlogPostObserver;
use App\Observers\AnnouncementObserver;
use App\Observers\JobObserver;
use App\Observers\TenderObserver;
use App\Observers\PageObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $policies = [
        Gallery::class => GalleryPolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register model observers for automatic sitemap cache clearing
        BlogPost::observe(BlogPostObserver::class);
        Announcement::observe(AnnouncementObserver::class);
        Job::observe(JobObserver::class);
        Tender::observe(TenderObserver::class);
        Page::observe(PageObserver::class);
    }
}
