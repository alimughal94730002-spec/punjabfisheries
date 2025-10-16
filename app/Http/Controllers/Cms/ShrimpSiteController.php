<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\ShrimpSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShrimpSiteController extends Controller
{
    public function index(Request $request)
    {
        $q = ShrimpSite::query();
        if ($request->filled('search')) {
            $q->where(function($sub) use ($request) {
                $sub->where('name','like','%'.$request->search.'%')
                    ->orWhere('district','like','%'.$request->search.'%')
                    ->orWhere('tehsil','like','%'.$request->search.'%');
            });
        }
        $sites = $q->latest()->paginate(15);
        return view('cms.shrimp-sites.index', compact('sites'));
    }

    public function create()
    {
        return view('cms.shrimp-sites.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'tehsil' => 'nullable|string|max:255',
            'area_acres' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'image_urls' => 'nullable|array',
            'image_urls.*' => 'nullable|url',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'marker_icon_url' => 'nullable|url',
            'marker_icon_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $images = [];
        // Uploaded files
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('shrimp-sites', 'public');
                $images[] = Storage::url($path);
            }
        }
        // External URLs
        if (!empty($data['image_urls'])) {
            foreach ($data['image_urls'] as $u) {
                if ($u) { $images[] = $u; }
            }
        }

        // Decide marker icon
        $markerIcon = null;
        if ($request->hasFile('marker_icon_file')) {
            $iconPath = $request->file('marker_icon_file')->store('shrimp-sites/icons', 'public');
            $markerIcon = Storage::url($iconPath);
        } elseif (!empty($data['marker_icon_url'])) {
            $markerIcon = $data['marker_icon_url'];
        }

        $site = ShrimpSite::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']).'-'.Str::random(6),
            'district' => $data['district'] ?? null,
            'tehsil' => $data['tehsil'] ?? null,
            'area_acres' => $data['area_acres'] ?? null,
            'status' => $data['status'] ?? null,
            'lat' => $data['lat'] ?? null,
            'lng' => $data['lng'] ?? null,
            'images' => $images,
            'marker_icon' => $markerIcon,
            'description' => $data['description'] ?? null,
            'is_active' => $data['is_active'] ?? true,
        ]);

        return redirect()->route('cms.shrimp-sites.index')->with('success','Shrimp site created.');
    }

    public function edit(ShrimpSite $shrimp_site)
    {
        return view('cms.shrimp-sites.edit', ['site' => $shrimp_site]);
    }

    public function update(Request $request, ShrimpSite $shrimp_site)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'tehsil' => 'nullable|string|max:255',
            'area_acres' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'image_urls' => 'nullable|array',
            'image_urls.*' => 'nullable|url',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'marker_icon_url' => 'nullable|url',
            'marker_icon_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $images = $shrimp_site->images ?? [];
        // Append uploaded files if provided
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('shrimp-sites', 'public');
                $images[] = Storage::url($path);
            }
        }
        // Append external URLs
        if (!empty($data['image_urls'])) {
            foreach ($data['image_urls'] as $u) {
                if ($u) { $images[] = $u; }
            }
        }

        // Update marker icon if provided
        $markerIcon = $shrimp_site->marker_icon;
        if ($request->hasFile('marker_icon_file')) {
            $iconPath = $request->file('marker_icon_file')->store('shrimp-sites/icons', 'public');
            $markerIcon = Storage::url($iconPath);
        } elseif (!empty($data['marker_icon_url'])) {
            $markerIcon = $data['marker_icon_url'];
        }

        $shrimp_site->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']).'-'.Str::random(6),
            'district' => $data['district'] ?? null,
            'tehsil' => $data['tehsil'] ?? null,
            'area_acres' => $data['area_acres'] ?? null,
            'status' => $data['status'] ?? null,
            'lat' => $data['lat'] ?? null,
            'lng' => $data['lng'] ?? null,
            'images' => array_values(array_unique($images)),
            'marker_icon' => $markerIcon,
            'description' => $data['description'] ?? null,
            'is_active' => $data['is_active'] ?? $shrimp_site->is_active,
        ]);

        return redirect()->route('cms.shrimp-sites.index')->with('success','Shrimp site updated.');
    }

    public function destroy(ShrimpSite $shrimp_site)
    {
        $shrimp_site->delete();
        return redirect()->route('cms.shrimp-sites.index')->with('success','Shrimp site deleted.');
    }

    public function toggle(ShrimpSite $shrimp_site)
    {
        $shrimp_site->update(['is_active' => !$shrimp_site->is_active]);
        return back()->with('success','Status updated.');
    }
}
