<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'author', 'tags']);

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by featured
        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured);
        }

        $posts = $query->latest()->paginate(15);
        $categories = BlogCategory::active()->ordered()->get();

        return view('cms.blog.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::active()->ordered()->get();
        $tags = BlogTag::active()->ordered()->get();
        
        return view('cms.blog.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery_featured_image' => 'nullable|string|url',
            'gallery_banner_image' => 'nullable|string|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id'
        ]);

        $data = $request->except(['featured_image', 'banner_image', 'gallery_featured_image', 'gallery_banner_image']);
        $data['author_id'] = Auth::id();
        $data['slug'] = Str::slug($request->title);

        // Set published_at if status is published and no date provided
        if ($request->status === 'published' && !$request->published_at) {
            $data['published_at'] = now();
        }
        
        // If published_at is in the future, set it to now for immediate publishing
        if ($request->status === 'published' && $request->published_at && Carbon::parse($request->published_at)->isFuture()) {
            $data['published_at'] = now();
        }

        $post = BlogPost::create($data);

        // Handle featured image upload (file upload)
        if ($request->hasFile('featured_image')) {
            try {
                $post->addMediaFromRequest('featured_image')
                    ->toMediaCollection('featured_image');
                Log::info('Featured image uploaded successfully', ['post_id' => $post->id]);
            } catch (\Exception $e) {
                Log::error('Failed to upload featured image', [
                    'post_id' => $post->id,
                    'error' => $e->getMessage()
                ]);
            }
        }
        // Handle featured image from gallery
        elseif ($request->filled('gallery_featured_image')) {
            Log::info('Adding featured image from gallery', [
                'post_id' => $post->id,
                'gallery_featured_image' => $request->gallery_featured_image
            ]);
            try {
                $this->addMediaFromUrl($post, $request->gallery_featured_image, 'featured_image');
                Log::info('Featured image addition completed', ['post_id' => $post->id]);
            } catch (\Exception $e) {
                Log::error('Failed to add featured image from gallery', [
                    'post_id' => $post->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }

        // Handle banner image upload (file upload)
        if ($request->hasFile('banner_image')) {
            try {
                $post->addMediaFromRequest('banner_image')
                    ->toMediaCollection('banner_image');
                Log::info('Banner image uploaded successfully', ['post_id' => $post->id]);
            } catch (\Exception $e) {
                Log::error('Failed to upload banner image', [
                    'post_id' => $post->id,
                    'error' => $e->getMessage()
                ]);
            }
        }
        // Handle banner image from gallery
        elseif ($request->filled('gallery_banner_image')) {
            Log::info('Adding banner image from gallery', [
                'post_id' => $post->id,
                'gallery_banner_image' => $request->gallery_banner_image
            ]);
            try {
                // Check if same image is being used for featured and banner
                if ($request->gallery_featured_image === $request->gallery_banner_image) {
                    Log::info('Same image used for featured and banner, copying from featured collection', [
                        'post_id' => $post->id
                    ]);
                    // Copy from featured_image collection to banner_image collection
                    $featuredMedia = $post->getFirstMedia('featured_image');
                    if ($featuredMedia) {
                        $featuredMedia->copy($post, 'banner_image');
                        Log::info('Banner image copied from featured image', ['post_id' => $post->id]);
                    }
                } else {
                    $this->addMediaFromUrl($post, $request->gallery_banner_image, 'banner_image');
                }
                Log::info('Banner image addition completed', ['post_id' => $post->id]);
            } catch (\Exception $e) {
                Log::error('Failed to add banner image from gallery', [
                    'post_id' => $post->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }

        // ALWAYS sync legacy columns with media URLs - even if image addition failed
        Log::info('About to sync image columns', ['post_id' => $post->id]);
        try {
            $this->syncImageColumns($post);
            Log::info('Image columns sync completed', ['post_id' => $post->id]);
        } catch (\Exception $e) {
            Log::error('Failed to sync image columns', [
                'post_id' => $post->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }

        // Attach tags
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('cms.blog.index')
                        ->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blog)
    {
        $post = $blog->load(['category', 'author', 'tags', 'comments']);
        return view('cms.blog.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blog)
    {
        $categories = BlogCategory::active()->ordered()->get();
        $tags = BlogTag::active()->ordered()->get();
        $post = $blog->load('tags');
        
        return view('cms.blog.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery_featured_image' => 'nullable|string|url',
            'gallery_banner_image' => 'nullable|string|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id'
        ]);

        $data = $request->except(['featured_image', 'banner_image', 'gallery_featured_image', 'gallery_banner_image']);
        $data['slug'] = Str::slug($request->title);

        // Handle featured image upload (file upload)
        if ($request->hasFile('featured_image')) {
            // Clear existing featured_image
            $blog->clearMediaCollection('featured_image');
            $blog->addMediaFromRequest('featured_image')
                ->toMediaCollection('featured_image');
        }
        // Handle featured image from gallery
        elseif ($request->filled('gallery_featured_image')) {
            Log::info('Updating featured image from gallery', [
                'post_id' => $blog->id,
                'gallery_featured_image' => $request->gallery_featured_image
            ]);
            $blog->clearMediaCollection('featured_image');
            $this->addMediaFromUrl($blog, $request->gallery_featured_image, 'featured_image');
        }

        // Handle banner image upload (file upload)
        if ($request->hasFile('banner_image')) {
            // Clear existing banner_image
            $blog->clearMediaCollection('banner_image');
            $blog->addMediaFromRequest('banner_image')
                ->toMediaCollection('banner_image');
        }
        // Handle banner image from gallery
        elseif ($request->filled('gallery_banner_image')) {
            Log::info('Updating banner image from gallery', [
                'post_id' => $blog->id,
                'gallery_banner_image' => $request->gallery_banner_image
            ]);
            $blog->clearMediaCollection('banner_image');
            $this->addMediaFromUrl($blog, $request->gallery_banner_image, 'banner_image');
        }

        // Set published_at if status is published and no date provided
        if ($request->status === 'published' && !$request->published_at && !$blog->published_at) {
            $data['published_at'] = now();
        }
        
        // If published_at is in the future, set it to now for immediate publishing
        if ($request->status === 'published' && $request->published_at && Carbon::parse($request->published_at)->isFuture()) {
            $data['published_at'] = now();
        }

        $blog->update($data);

        // Sync tags
        $blog->tags()->sync($request->tags ?? []);

        // Sync legacy columns with media URLs so values also persist in DB columns
        Log::info('About to sync image columns (update)', ['post_id' => $blog->id]);
        $this->syncImageColumns($blog);
        Log::info('Image columns sync completed (update)', ['post_id' => $blog->id]);

        return redirect()->route('cms.blog.index')
                        ->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blog)
    {
        // Delete images
        if ($blog->featured_image) {
            Storage::delete($blog->featured_image);
        }
        if ($blog->banner_image) {
            Storage::delete($blog->banner_image);
        }

        $blog->delete();

        return redirect()->route('cms.blog.index')
                        ->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(BlogPost $blog)
    {
        $blog->update(['is_featured' => !$blog->is_featured]);
        
        return response()->json([
            'success' => true,
            'is_featured' => $blog->is_featured
        ]);
    }

    /**
     * Publish/Unpublish post
     */
    public function togglePublish(BlogPost $blog)
    {
        if ($blog->status === 'published') {
            $blog->unpublish();
            $message = 'Post unpublished successfully.';
        } else {
            $blog->publish();
            $message = 'Post published successfully.';
        }

        return response()->json([
            'success' => true,
            'status' => $blog->status,
            'message' => $message
        ]);
    }

    /**
     * Upload image helper method
     */
    private function uploadImage($file, $path)
    {
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $filename, 'public');
        return $filePath;
    }

    /**
     * Add media from URL to blog post
     */
    private function addMediaFromUrl($post, $url, $collection)
    {
        try {
            // Extract the file path from the URL
            $filePath = $this->extractFilePathFromUrl($url);
            
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                // If the file exists in storage, add it directly
                $post->addMediaFromDisk($filePath, 'public')
                    ->toMediaCollection($collection);
                    
                Log::info('Successfully added media from storage path to blog post', [
                    'filePath' => $filePath,
                    'post_id' => $post->id,
                    'collection' => $collection
                ]);
                return;
            }

            // If not found in storage, try to add from URL
            $normalizedUrl = $url;
            if ($url && !preg_match('/^https?:\/\//i', $url)) {
                // Ensure it starts with a single leading slash for url() helper
                if (!str_starts_with($url, '/')) {
                    $url = '/' . ltrim($url, '/');
                }
                $normalizedUrl = url($url);
            }

            $post->addMediaFromUrl($normalizedUrl)
                ->toMediaCollection($collection);
                
            Log::info('Successfully added media from URL to blog post', [
                'url' => $url,
                'normalizedUrl' => $normalizedUrl,
                'post_id' => $post->id,
                'collection' => $collection
            ]);
        } catch (\Exception $e) {
            // Log error but don't break the flow
            Log::error('Failed to add media from URL: ' . $e->getMessage(), [
                'url' => $url,
                'filePath' => $filePath ?? null,
                'collection' => $collection,
                'post_id' => $post->id,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Extract file path from URL
     */
    private function extractFilePathFromUrl($url)
    {
        // Remove domain and get the path
        $path = parse_url($url, PHP_URL_PATH);
        
        // Remove leading slash
        $path = ltrim($path, '/');
        
        // If it starts with 'storage/', remove it
        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, 8); // Remove 'storage/' (8 characters)
        }
        
        return $path;
    }

    /**
     * Sync DB columns with first media URLs for backward compatibility with places
     * that still read `featured_image` and `banner_image` from the table.
     */
    private function syncImageColumns(BlogPost $post): void
    {
        try {
            $featured = $post->getFirstMediaUrl('featured_image');
            $banner = $post->getFirstMediaUrl('banner_image');

            Log::info('Syncing image columns', [
                'post_id' => $post->id,
                'featured_url' => $featured,
                'banner_url' => $banner,
                'featured_media_count' => $post->getMedia('featured_image')->count(),
                'banner_media_count' => $post->getMedia('banner_image')->count()
            ]);

            // getFirstMediaUrl returns empty string when no media exists
            $post->featured_image = $featured ?: null;
            $post->banner_image = $banner ?: null;
            if ($post->isDirty(['featured_image', 'banner_image'])) {
                $post->save();
                Log::info('Image columns synced successfully', [
                    'post_id' => $post->id,
                    'featured_image' => $post->featured_image,
                    'banner_image' => $post->banner_image
                ]);
            } else {
                Log::info('No changes to sync for image columns', [
                    'post_id' => $post->id
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to sync image columns', [
                'post_id' => $post->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Preview blog post
     */
    public function preview()
    {
        return view('cms.blog.preview');
    }
}
