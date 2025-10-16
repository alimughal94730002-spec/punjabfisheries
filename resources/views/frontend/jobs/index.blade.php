@extends('frontend.layouts.app')
@section('title', __('app.career_opportunities'))
@section('content')

    <!-- Banner section start -->
    <section class="px-3">
      <div class="max-w-[1800px] mx-auto bg-primary-50 rounded-xl xl:rounded-2xl py-14 xl:py-28 flex justify-center text-center">
        <div class="relative z-[1]">
          <h1 class="text-4xl xl:text-5xl font-bold text-neutral-900 mb-6">{{ __('app.job_opportunities') }}</h1>
          <p class="text-lg text-neutral-600 max-w-2xl mx-auto">{{ __('app.jobs_banner_desc') }}</p>
        </div>
      </div>
    </section>
    <!-- Banner section end -->
    <!-- Jobs section start -->
    <section class="py-16 xl:py-20">
      <div class="cont">
        @if($jobs->count() > 0)
          <div class="bg-white rounded-lg shadow-lg p-6">
           
            <div class="space-y-4">
            @foreach($jobs as $job)
                <div class="border-b border-gray-200 pb-4 last:border-b-0">
                  <div class="flex items-start justify-between">
                    <div class="flex-1">
                      <div class="flex items-center gap-2 mb-2">
                        @if($job->created_at->isAfter(now()->subDays(7)))
                          <span class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded">({{ __('app.new') }})</span>
                        @endif
                        <h3 class="text-lg font-semibold text-gray-900">{{ $job->title }}</h3>
                      </div>
                      <div class="text-sm text-gray-600 mb-3">
                        @if($job->department)
                          <span class="font-medium">{{ __('app.department') }}:</span> {{ $job->department }} | 
                        @endif
                        @if($job->location)
                          <span class="font-medium">{{ __('app.location') }}:</span> {{ $job->location }} | 
                        @endif
                        @if($job->employment_type)
                          <span class="font-medium">{{ __('app.type') }}:</span> {{ $job->employment_type }} | 
                        @endif
                        <span class="font-medium">{{ __('app.posted') }}:</span> {{ $job->created_at->format('d-m-Y') }}
                      </div>
                      <p class="text-gray-700 mb-3">{{ Str::limit($job->description, 200) }}</p>
                      <div class="flex items-center gap-4">
                        <a href="{{ route('frontend.jobs.show', $job) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center gap-1">
                          {{ __('app.view_details') }}
                          <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path>
                          </svg>
                        </a>
                        @if($job->hasAttachment())
                          <a href="{{ $job->attachment_url }}" 
                             target="_blank" 
                             class="text-green-600 hover:text-green-800 font-medium text-sm flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
                              <path d="M208,88H40a8,8,0,0,0,0,16H208a8,8,0,0,0,0-16Zm0,32H40a8,8,0,0,0,0,16H208a8,8,0,0,0,0-16Zm0,32H40a8,8,0,0,0,0,16H208a8,8,0,0,0,0-16Z"></path>
                            </svg>
                            {{ __('app.download') }} {{ strtoupper($job->attachment_type) }}
                          </a>
                        @endif
                      </div>
                    </div>
                    <div class="ml-4 flex flex-col gap-1">
                      <!-- Job Status -->
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($job->status === 'open') bg-green-100 text-green-800
                        @elseif($job->status === 'closed') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        @switch($job->status)
                          @case('open') {{ __('app.status_open') }} @break
                          @case('closed') {{ __('app.status_closed') }} @break
                          @case('filled') {{ __('app.status_filled') }} @break
                          @default {{ __('app.status') }}
                        @endswitch
                      </span>
                      
                      <!-- Active/Inactive Status -->
                      @if(!$job->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                          Inactive
                        </span>
                      @endif
                      
                      <!-- Expired Status -->
                      @if($job->application_deadline && $job->application_deadline->isPast())
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                          Expired
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @else
          <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <div class="mb-8">
              <svg xmlns="http://www.w3.org/2000/svg" class="size-24 mx-auto text-neutral-300" fill="currentColor" viewBox="0 0 256 256">
                <path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-semibold text-neutral-700 mb-4">{{ __('app.no_jobs') }}</h3>
            <p class="text-neutral-500 mb-8">{{ __('app.no_jobs_desc') }}</p>
            <a href="{{ route('frontend.contact') }}" class="btn-primary">{{ __('app.contact') }}</a>
          </div>
        @endif
      </div>
    </section>
    <!-- Jobs section end -->
@endsection
