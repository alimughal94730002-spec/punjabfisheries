<x-app-layout title="Add Shrimp Site" is-header-blur="true">
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 sm:mt-5 lg:mt-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-semibold text-slate-800 dark:text-navy-50">Add Shrimp Site</h1>
                <a href="{{ route('cms.shrimp-sites.index') }}" class="btn bg-slate-150">Back</a>
            </div>

            <div class="card p-4 sm:p-5">
                <form action="{{ route('cms.shrimp-sites.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Name *</label>
                        <input name="name" class="form-input w-full" required />
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <input name="status" class="form-input w-full" placeholder="Operational / Under Development" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">District</label>
                        <input name="district" class="form-input w-full" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Tehsil</label>
                        <input name="tehsil" class="form-input w-full" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Area (acres)</label>
                        <input type="number" step="0.01" name="area_acres" class="form-input w-full" />
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium mb-1">Latitude</label>
                            <input id="latInput" type="number" step="0.0000001" name="lat" class="form-input w-full" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Longitude</label>
                            <input id="lngInput" type="number" step="0.0000001" name="lng" class="form-input w-full" />
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea name="description" rows="4" class="form-textarea w-full"></textarea>
                    </div>

                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Upload Images (you can select multiple)</label>
                            <input type="file" name="images[]" class="form-input w-full" multiple accept="image/*" />
                            <p class="text-xs text-slate-500 mt-1">JPEG/PNG/WebP up to 4MB each</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Image URLs (optional)</label>
                            <div class="space-y-2">
                                <input type="url" name="image_urls[]" class="form-input w-full" placeholder="https://..." />
                                <input type="url" name="image_urls[]" class="form-input w-full" placeholder="https://..." />
                                <input type="url" name="image_urls[]" class="form-input w-full" placeholder="https://..." />
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Marker Icon (upload)</label>
                            <input type="file" name="marker_icon_file" class="form-input w-full" accept="image/*" />
                            <p class="text-xs text-slate-500 mt-1">PNG/SVG recommended. Size ~32x32.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Marker Icon URL (optional)</label>
                            <input type="url" name="marker_icon_url" class="form-input w-full" placeholder="https://..." />
                            <p class="text-xs text-slate-500 mt-1">If both file and URL are provided, uploaded file will be used.</p>
                        </div>
                    </div>

                    <div>
                        <label class="inline-flex items-center space-x-2">
                            <input type="checkbox" name="is_active" value="1" class="form-checkbox" checked>
                            <span>Active (show on map)</span>
                        </label>
                    </div>

                    <div class="md:col-span-2 mt-2">
                        <button class="btn bg-primary text-white">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-app-layout>

