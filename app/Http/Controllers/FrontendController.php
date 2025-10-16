<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Slider;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogComment;
use App\Models\Tender;
use App\Models\Announcement;
use App\Models\ShrimpSite;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
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

        \Log::info('Frontend locale setting', [
            'user_locale' => $request->user()?->preferred_locale,
            'session_locale' => $request->session()->get('locale'),
            'cookie_locale' => $request->cookie('locale'),
            'final_locale' => $locale,
            'app_locale_before' => app()->getLocale(),
        ]);

        app()->setLocale($locale);
        
        \Log::info('App locale set', ['app_locale_after' => app()->getLocale()]);
    }

    /**
     * Display the frontend homepage
     */
    public function index(Request $request)
    {
        $this->setFrontendLocale($request);
        // Get active sliders for the homepage
        $sliders = Slider::where('is_active', true)
                        ->orderBy('order')
                        ->get();
        
        // Get published pages for navigation
        $pages = Page::where('status', 'published')
                    ->get();

        // Get featured announcements for homepage
        $featuredAnnouncements = Announcement::active()
            ->published()
            ->notExpired()
            ->featured()
            ->orderBy('sort_order', 'asc')
            ->orderBy('published_date', 'desc')
            ->limit(6)
            ->get();

        // Get latest announcements for homepage
        $latestAnnouncements = Announcement::active()
            ->published()
            ->notExpired()
            ->orderBy('published_date', 'desc')
            ->limit(6)
            ->get();
        
        return view('frontend.index', compact('sliders', 'pages', 'featuredAnnouncements', 'latestAnnouncements'));
    }
    
    /**
     * Display a specific page
     */
    public function page(Request $request, $slug)
    {
        $this->setFrontendLocale($request);
        $page = Page::where('slug', $slug)
                   ->where('status', 'published')
                   ->firstOrFail();
        
        return view('frontend.page', compact('page'));
    }
    
    /**
     * Display about page
     */
    public function about(Request $request)
    {
        $this->setFrontendLocale($request);
        // Get active sliders for the about page banner
        $sliders = Slider::where('is_active', true)
                        ->orderBy('order')
                        ->get();
        
        return view('frontend.about', compact('sliders'));
    }
    
    /**
     * Display services page
     */
    public function services(Request $request)
    {
        $this->setFrontendLocale($request);
        return view('frontend.services');
    }
    
    /**
     * Display contact page
     */
    public function contact(Request $request)
    {
        $this->setFrontendLocale($request);
        return view('frontend.contact');
    }
    
    /**
     * Display blog page
     */
    public function blog(Request $request)
    {
        $this->setFrontendLocale($request);
        $query = BlogPost::with(['category', 'author', 'tags'])->published();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by tag
        if ($request->filled('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        $posts = $query->latest('published_at')->paginate(12);
        $categories = BlogCategory::active()->withCount('publishedPosts')->ordered()->get();
        $tags = BlogTag::active()->withCount('publishedPosts')->ordered()->get();

        return view('frontend.blogs', compact('posts', 'categories', 'tags'));
    }
    
    /**
     * Display blog details page
     */
    public function blogDetails(Request $request, $slug)
    {
        $this->setFrontendLocale($request);
        $post = BlogPost::with(['category', 'author', 'tags', 'comments'])
                       ->where('slug', $slug)
                       ->published()
                       ->firstOrFail();

        // Increment view count
        $post->incrementViewCount();

        // Get sidebar data
        $categories = BlogCategory::active()->withCount('publishedPosts')->ordered()->get();
        $recentPosts = BlogPost::with(['category', 'author'])
                              ->published()
                              ->where('id', '!=', $post->id)
                              ->latest('published_at')
                              ->limit(3)
                              ->get();
        
        $relatedPosts = BlogPost::with(['category', 'author'])
                               ->published()
                               ->where('id', '!=', $post->id)
                               ->where('category_id', $post->category_id)
                               ->latest('published_at')
                               ->limit(3)
                               ->get();

        return view('frontend.blog-details', compact('post', 'slug', 'categories', 'recentPosts', 'relatedPosts'));
    }
    
    /**
     * Submit a comment
     */
    public function submitComment(Request $request)
    {
        $this->setFrontendLocale($request);
        $request->validate([
            'blog_post_id' => 'required|exists:blog_posts,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:2000',
            'parent_id' => 'nullable|exists:blog_comments,id'
        ]);

        // Check if comments are allowed for this post
        $post = BlogPost::findOrFail($request->blog_post_id);
        if (!$post->allow_comments) {
            return back()->with('error', 'Comments are not allowed for this post.');
        }

        // Create the comment
        $comment = BlogComment::create([
            'blog_post_id' => $request->blog_post_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'parent_id' => $request->parent_id,
            'status' => 'pending', // Default status - needs approval
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }
    
    /**
     * Display service details page
     */
    public function serviceDetails(Request $request, $slug)
    {
        $this->setFrontendLocale($request);
        return view('frontend.service-details', compact('slug'));
    }
    
    /**
     * Display tenders page
     */
    public function tenders(Request $request)
    {
        $this->setFrontendLocale($request);
        // Start with published tenders only
        $query = Tender::published();

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('tender_number', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by status - if not specified, show both active and closed
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('status', 'active')->notExpired();
            } elseif ($request->status === 'closed') {
                $query->where(function($q) {
                    $q->where('status', 'closed')->orWhere('deadline', '<', now());
                });
            }
        } else {
            // If no status filter, show active tenders by default
            $query->where('status', 'active')->notExpired();
        }

        $tenders = $query->latest('published_at')->paginate(12);

        return view('frontend.tenders', compact('tenders'));
    }
    
    /**
     * Display individual tender details
     */
    public function tenderShow(Request $request, Tender $tender)
    {
        $this->setFrontendLocale($request);
        // Ensure tender is published
        if (!$tender->is_published) {
            abort(404);
        }
        
        // Increment view count
        $tender->increment('views');
        
        return view('frontend.tenders.show', compact('tender'));
    }
    
    /**
     * Download tender PDF
     */
    public function downloadTenderPdf(Request $request, $id)
    {
        $this->setFrontendLocale($request);
        $tender = Tender::published()->findOrFail($id);
        
        if (!$tender->pdf_path || !Storage::disk('public')->exists($tender->pdf_path)) {
            return redirect()->back()->with('error', 'PDF file not found.');
        }
        
        // Increment view count
        $tender->incrementViewCount();
        
        return response()->download(storage_path('app/public/' . $tender->pdf_path), $tender->tender_number . '.pdf');
    }

    /**
     * Download tender PDF 2
     */
    public function downloadTenderPdf2(Request $request, $id)
    {
        $this->setFrontendLocale($request);
        $tender = Tender::published()->findOrFail($id);
        
        if (!$tender->pdf_path_2 || !Storage::disk('public')->exists($tender->pdf_path_2)) {
            return redirect()->back()->with('error', 'PDF file not found.');
        }
        
        // Increment view count
        $tender->incrementViewCount();
        
        return response()->download(storage_path('app/public/' . $tender->pdf_path_2), $tender->tender_number . '_2.pdf');
    }

    /**
     * Shrimp Sites Map page
     */
    public function shrimpSitesMap(Request $request)
    {
        $this->setFrontendLocale($request);
        return view('frontend.shrimp-map');
    }

    /**
     * Public JSON for shrimp sites (active only)
     */
    public function shrimpSitesJson(Request $request)
    {
        $this->setFrontendLocale($request);
        $sites = ShrimpSite::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id','name','district','tehsil','area_acres','status','lat','lng','images','marker_icon','description','slug'])
            ->map(function ($site) {
                // Ensure absolute URLs for images
                $imgs = collect($site->images ?? [])->map(function($u){
                    // If already absolute (http/https/data), keep as-is
                    if (preg_match('/^(?:https?:)?\/\//i', $u) || str_starts_with($u, 'data:')) {
                        return $u;
                    }
                    // If stored as /storage/.. path, proxy via media route to avoid symlink issues
                    $path = ltrim($u, '/');
                    if (str_starts_with($path, 'storage/')) {
                        $path = substr($path, strlen('storage/'));
                    }
                    return route('media.public', ['path' => $path]);
                })->values()->all();
                $site->images = $imgs;

                // Normalize marker_icon similar to images
                if (!empty($site->marker_icon)) {
                    $u = $site->marker_icon;
                    if (!(preg_match('/^(?:https?:)?\/\//i', $u) || str_starts_with($u, 'data:'))) {
                        $path = ltrim($u, '/');
                        if (str_starts_with($path, 'storage/')) {
                            $path = substr($path, strlen('storage/'));
                        }
                        $site->marker_icon = route('media.public', ['path' => $path]);
                    }
                }
                return $site;
            });
        return response()->json($sites);
    }

    /**
     * Stream files from the public storage disk (restricted to safe subpaths).
     */
    public function mediaPublic(Request $request, string $path)
    {
        // Normalize path
        $path = ltrim($path, '/');
        // Restrict to known folder(s)
        if (! (str_starts_with($path, 'shrimp-sites/'))) {
            abort(403);
        }
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        return Storage::disk('public')->response($path);
    }
}
