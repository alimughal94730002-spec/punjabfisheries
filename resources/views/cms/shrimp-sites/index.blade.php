<x-app-layout title="Shrimp Sites" is-header-blur="true">
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 sm:mt-5 lg:mt-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-800 dark:text-navy-50">Shrimp Sites</h1>
                    <p class="text-slate-500 dark:text-navy-200">Manage shrimp sites shown on the public map</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('cms.shrimp-sites.create') }}" class="btn bg-primary text-white">Add Site</a>
                </div>
            </div>

            <div class="card p-4 sm:p-5 mb-4">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Name, district, tehsil" class="form-input w-full" />
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="btn bg-primary text-white">Filter</button>
                        @if(request('search'))
                            <a href="{{ route('cms.shrimp-sites.index') }}" class="btn bg-slate-150 ml-2">Clear</a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="card p-0">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Area</th>
                                <th>Status</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sites as $site)
                                <tr>
                                    <td class="whitespace-nowrap">{{ $site->name }}</td>
                                    <td class="whitespace-nowrap">{{ $site->district }} @if($site->tehsil) / {{ $site->tehsil }} @endif</td>
                                    <td class="whitespace-nowrap">{{ $site->area_acres ? number_format($site->area_acres, 2).' acres' : '-' }}</td>
                                    <td class="whitespace-nowrap">{{ $site->status ?? '-' }}</td>
                                    <td class="whitespace-nowrap">
                                        @if($site->is_active)
                                            <span class="badge bg-success/10 text-success border-success/20">Active</span>
                                        @else
                                            <span class="badge bg-slate-500/10 text-slate-500 border-slate-500/20">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('cms.shrimp-sites.edit', $site) }}" class="btn size-8 p-0 text-slate-600">Edit</a>
                                            <form method="POST" action="{{ route('cms.shrimp-sites.toggle', $site) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn size-8 p-0 text-slate-600">{{ $site->is_active ? 'Deactivate' : 'Activate' }}</button>
                                            </form>
                                            <form method="POST" action="{{ route('cms.shrimp-sites.destroy', $site) }}" onsubmit="return confirm('Delete this site?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn size-8 p-0 text-red-600">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-slate-500">No sites found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($sites->hasPages())
                    <div class="p-4 border-t">{{ $sites->links() }}</div>
                @endif
            </div>
        </div>
    </main>
</x-app-layout>
