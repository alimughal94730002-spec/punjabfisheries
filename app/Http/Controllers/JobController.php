<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobs = Job::latest()->paginate(10);
        return view('cms.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cms.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|in:Full-time,Part-time,Contract,Internship',
            'experience_level' => 'nullable|string|in:Entry,Mid,Senior,Executive',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'application_deadline' => 'nullable|date|after:today',
            'status' => 'required|string|in:open,closed,filled',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240' // 10MB max
        ]);

        // Handle checkbox for is_active (checkboxes are not included in validation)
        $validated['is_active'] = $request->has('is_active');

        // Handle file upload
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('job-attachments', $filename, 'public');
            
            $validated['attachment_path'] = $path;
            $validated['attachment_type'] = $file->getClientOriginalExtension();
            $validated['attachment_name'] = $file->getClientOriginalName();
        }

        Job::create($validated);

        return redirect()->route('cms.jobs.index')
            ->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job): View
    {
        return view('cms.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job): View
    {
        return view('cms.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|in:Full-time,Part-time,Contract,Internship',
            'experience_level' => 'nullable|string|in:Entry,Mid,Senior,Executive',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'application_deadline' => 'nullable|date|after:today',
            'status' => 'required|string|in:open,closed,filled',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240' // 10MB max
        ]);

        // Handle checkbox for is_active (checkboxes are not included in validation)
        $validated['is_active'] = $request->has('is_active');

        // Handle file upload
        if ($request->hasFile('attachment')) {
            // Delete old file if exists
            if ($job->attachment_path && \Storage::disk('public')->exists($job->attachment_path)) {
                \Storage::disk('public')->delete($job->attachment_path);
            }
            
            $file = $request->file('attachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('job-attachments', $filename, 'public');
            
            $validated['attachment_path'] = $path;
            $validated['attachment_type'] = $file->getClientOriginalExtension();
            $validated['attachment_name'] = $file->getClientOriginalName();
        }

        $job->update($validated);

        return redirect()->route('cms.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job): RedirectResponse
    {
        // Delete attachment file if exists
        if ($job->attachment_path && \Storage::disk('public')->exists($job->attachment_path)) {
            \Storage::disk('public')->delete($job->attachment_path);
        }
        
        $job->delete();

        return redirect()->route('cms.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }

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
     * Display jobs for frontend
     */
    public function frontendIndex(Request $request): View
    {
        $this->setFrontendLocale($request);
        // Show all jobs (active and inactive, open and closed) but prioritize active and open ones
        $jobs = Job::latest()->paginate(12);
        return view('frontend.jobs.index', compact('jobs'));
    }

    /**
     * Display single job for frontend
     */
    public function frontendShow(Request $request, Job $job): View
    {
        $this->setFrontendLocale($request);
        return view('frontend.jobs.show', compact('job'));
    }

    /**
     * Toggle job status
     */
    public function toggleStatus(Job $job): RedirectResponse
    {
        $job->update([
            'status' => $job->status === 'open' ? 'closed' : 'open'
        ]);

        return redirect()->back()
            ->with('success', 'Job status updated successfully.');
    }

    /**
     * Toggle job active status
     */
    public function toggleActive(Job $job): RedirectResponse
    {
        $job->update([
            'is_active' => !$job->is_active
        ]);

        return redirect()->back()
            ->with('success', 'Job active status updated successfully.');
    }
}
