<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Set locale for frontend requests
     */
    private function setFrontendLocale(Request $request)
    {
        $supported = config('localization.supported', ['en', 'ur']);
        $fallback = config('localization.fallback', 'en');

        $locale = null;

        // Check session first (for frontend language switching)
        $locale = $request->session()->get('locale');
        
        // Then check cookie
        $locale = $locale ?? $request->cookie('locale');
        
        // Then check user preference (only if no session/cookie locale)
        if (!$locale && $request->user() && in_array($request->user()->preferred_locale, $supported, true)) {
            $locale = $request->user()->preferred_locale;
        }

        // Finally check Accept-Language header
        if (!$locale) {
            $locale = $request->getPreferredLanguage($supported) ?? $fallback;
        }

        app()->setLocale($locale);
    }

    /**
     * Display a listing of announcements.
     */
    public function index(Request $request)
    {
        $this->setFrontendLocale($request);
        $query = Announcement::active()
            ->published()
            ->notExpired()
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order', 'asc')
            ->orderBy('published_date', 'desc');

        // Filter by type if provided
        if ($request->has('type') && $request->type) {
            $query->byType($request->type);
        }

        // Filter by priority if provided
        if ($request->has('priority') && $request->priority) {
            $query->where('priority', $request->priority);
        }

        $announcements = $query->paginate(12);

        // Get announcement types for filter
        $types = Announcement::active()
            ->published()
            ->notExpired()
            ->distinct()
            ->pluck('type')
            ->toArray();

        return view('frontend.announcements.index', compact('announcements', 'types'));
    }

    /**
     * Display the specified announcement.
     */
    public function show(Request $request, Announcement $announcement)
    {
        $this->setFrontendLocale($request);
        // Check if announcement is active and published
        if (!$announcement->isActive() || $announcement->published_date > now()) {
            abort(404);
        }

        // Get related announcements
        $relatedAnnouncements = Announcement::active()
            ->published()
            ->notExpired()
            ->where('id', '!=', $announcement->id)
            ->where('type', $announcement->type)
            ->orderBy('published_date', 'desc')
            ->limit(4)
            ->get();

        return view('frontend.announcements.show', compact('announcement', 'relatedAnnouncements'));
    }

    /**
     * Get featured announcements for homepage.
     */
    public function featured()
    {
        return Announcement::active()
            ->published()
            ->notExpired()
            ->featured()
            ->orderBy('sort_order', 'asc')
            ->orderBy('published_date', 'desc')
            ->limit(6)
            ->get();
    }

    /**
     * Get latest announcements for homepage.
     */
    public function latest($limit = 6)
    {
        return Announcement::active()
            ->published()
            ->notExpired()
            ->orderBy('published_date', 'desc')
            ->limit($limit)
            ->get();
    }
}