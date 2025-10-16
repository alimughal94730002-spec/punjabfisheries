@extends('frontend.layouts.app')

@section('title', 'Department of Fisheries - Punjab')

@section('content')


    <!-- banner section start -->

    <!-- banner section start -->
    <x-slider :sliders="$sliders" />
    <!-- banner section end -->

    <!-- about section start -->
    <section class="py-120 bg-neutral-0 relative overflow-x-hidden">
      <img src="{{ asset('assets/images/home-1/about-fish-1.png') }}" class="max-xxl:hidden absolute fish fish-left top-5 left-8" alt="" />
      <img src="{{ asset('assets/images/home-1/about-fish-2.png') }}" class="max-xxl:hidden absolute fish fish-top top-[-200px] right-4" alt="" />
      <div class="cont grid grid-cols-12 gap-6 items-center">
        <div class="col-span-12 lg:col-span-6">
          <div class="relative xl:-translate-x-8 xxl:-translate-x-14 3xl:-translate-x-28 reveal_anim">
            <div class="relative f-center">
              <img src="{{ asset('assets/images/home-1/about-1.png') }}" width="670" height="670" alt="" />
              <div class="absolute z-[1]">
                <a href="https://www.youtube.com/embed/J6acmXS6bP4?vq=hd1080&rel=0" target="_blank" aria-label="Watch video" class="topbar-btn -translate-x-4 4xl:-translate-x-8 pulse-effect relative z-[3] bg-neutral-0 text-neutral-900 hero-video">
                  <svg xmlns="http://www.w3.org/2000/svg" class="size-5 xl:size-6" viewBox="0 0 256 256">
                    <rect width="256" height="256" fill="none" />
                    <path fill="currentColor" d="M240,128a15.74,15.74,0,0,1-7.6,13.51L88.32,229.65a16,16,0,0,1-16.2.3A15.86,15.86,0,0,1,64,216.13V39.87a15.86,15.86,0,0,1,8.12-13.82,16,16,0,0,1,16.2.3L232.4,114.49A15.74,15.74,0,0,1,240,128Z" />
                  </svg>
                </a>
              </div>
            </div>
            <img src="{{ asset('assets/images/home-1/about-2.png') }}" width="240" height="240" class="absolute max-sm:hidden border-8 border-neutral-0 rounded-full right-0 top-1/2 -translate-y-1/2" alt="" />
          </div>
        </div>
        <div class="col-span-12 lg:col-span-6">
          <p class="sub-heading reveal_anim">{{ __('app.about_us') }}</p>
          <h2 class="mb-4 xl:mb-6 reveal_anim" data-fade-from="right">{{ __('app.about_punjab_fisheries') }}</h2>
          <p class="reveal_anim text-neutral-600 mb-6 xl:mb-10 border-b border-neutral-40 pb-6 xl:pb-10" data-fade-from="right" data-delay=".4">{{ __('app.about_description') }}</p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 xl:gap-6 mb-6 xl:mb-10 border-b border-neutral-40 pb-6 xl:pb-10">
            <div class="fade_anim flex items-center gap-4">
              <img src="{{ asset('assets/images/home-1/shrimp.png') }}" alt="" />
              <div>
                <h5 class="mb-3">{{ __('app.shrimp_feeds') }}</h5>
                <p>{{ __('app.shrimp_feeds_desc') }}</p>
              </div>
            </div>
            <div data-delay=".2" class="fade_anim flex items-center gap-4">
              <img src="{{ asset('assets/images/home-1/spear.png') }}" alt="" />
              <div>
                <h5 class="mb-3">{{ __('app.spear_fishing') }}</h5>
                <p>{{ __('app.spear_fishing_desc') }}</p>
              </div>
            </div>
            <div data-delay=".4" class="fade_anim flex items-center gap-4">
              <img src="{{ asset('assets/images/home-1/hook.png') }}" alt="" />
              <div>
                <h5 class="mb-3">{{ __('app.hand_fishing') }}</h5>
                <p>{{ __('app.hand_fishing_desc') }}</p>
              </div>
            </div>
            <div data-delay=".6" class="fade_anim flex items-center gap-4">
              <img src="{{ asset('assets/images/home-1/boat.png') }}" alt="" />
              <div>
                <h5 class="mb-3">{{ __('app.boat_fishing') }}</h5>
                <p>{{ __('app.boat_fishing_desc') }}</p>
              </div>
            </div>
          </div>
          <div class="flex gap-4 items-center flex-wrap fade_anim mb-7 xl:mb-10">
            <a href="#" class="btn-primary"
              >{{ __('app.about_company') }} <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg
            ></a>
            <a href="#" class="flex items-center gap-2">
              <div class="size-14 rounded-full border border-neutral-40 text-primary-300 f-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-7" fill="currentColor" viewBox="0 0 256 256">
                  <path
                    d="M144.27,45.93a8,8,0,0,1,9.8-5.66,86.22,86.22,0,0,1,61.66,61.66,8,8,0,0,1-5.66,9.8A8.23,8.23,0,0,1,208,112a8,8,0,0,1-7.73-5.94,70.35,70.35,0,0,0-50.33-50.33A8,8,0,0,1,144.27,45.93Zm-2.33,41.8c13.79,3.68,22.65,12.54,26.33,26.33A8,8,0,0,0,176,120a8.23,8.23,0,0,0,2.07-.27,8,8,0,0,0,5.66-9.8c-5.12-19.16-18.5-32.54-37.66-37.66a8,8,0,1,0-4.13,15.46Zm81.94,95.35A56.26,56.26,0,0,1,168,232C88.6,232,24,167.4,24,88A56.26,56.26,0,0,1,72.92,32.12a16,16,0,0,1,16.62,9.52l21.12,47.15,0,.12A16,16,0,0,1,109.39,104c-.18.27-.37.52-.57.77L88,129.45c7.49,15.22,23.41,31,38.83,38.51l24.34-20.71a8.12,8.12,0,0,1,.75-.56,16,16,0,0,1,15.17-1.4l.13.06,47.11,21.11A16,16,0,0,1,223.88,183.08Zm-15.88-2s-.07,0-.11,0h0l-47-21.05-24.35,20.71a8.44,8.44,0,0,1-.74.56,16,16,0,0,1-15.75,1.14c-18.73-9.05-37.4-27.58-46.46-46.11a16,16,0,0,1,1-15.7,6.13,6.13,0,0,1,.57-.77L96,95.15l-21-47a.61.61,0,0,1,0-.12A40.2,40.2,0,0,0,40,88,128.14,128.14,0,0,0,168,216,40.21,40.21,0,0,0,208,181.07Z"
                  ></path>
                </svg>
              </div>
              <div>
                <p class="text-neutral-100 mb-1 text-sm">{{ __('app.call_us_now') }}</p>
                <p class="text-sm text-neutral-900">04299211584</p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- service section start -->
    <section class="bg-neutral-0 pb-120">
      <div class="max-w-[1700px] mx-auto px-3 reveal_anim" id="cards">
        <div class="cont flex justify-between items-center mb-10 xl:mb-14">
          <div>
            <p class="sub-heading">{{ __('app.our_services') }}</p>
            <h2 class="mb-6 reveal_anim">{{ __('app.services_we_provide') }}</h2>
          </div>
          <a href="#" class="btn-secondary">
            {{ __('app.view_all') }}
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
          </a>
        </div>
        <div class="card rounded-[32px] relative min-h-[300px] after:size-full after:absolute after:inset-0 after:rounded-[32px] after:bg-gradient-to-t after:from-black/80 after:to-transparent">
          <img src="{{ asset('assets/images/home-1/service-1.webp') }}" class="min-h-[300px] object-cover object-center" alt="" />
          <div class="absolute z-[1] px-4 md:px-8 xl:px-14 pb-6 md:pb-8 xl:pb-14 flex justify-between items-center flex-wrap gap-3 w-full bottom-0 left-0 right-0">
            <a href="#" class="text-secondary font-medium">{{ __('app.see_details') }}</a>
            <h2 class="text-4xl lg:text-5xl xl:text-[56px] text-neutral-0">{{ __('app.premium_harvesting') }}</h2>
            <span class="text-secondary font-medium">2025</span>
          </div>
        </div>
        <div class="card rounded-[32px] relative min-h-[300px] after:size-full after:absolute after:inset-0 after:rounded-[32px] after:bg-gradient-to-t after:from-black/80 after:to-transparent">
          <img src="{{ asset('assets/images/home-1/service-2.webp') }}" class="min-h-[300px] object-cover object-center" alt="" />
          <div class="absolute z-[1] px-4 md:px-8 xl:px-14 pb-6 md:pb-8 xl:pb-14 flex justify-between items-center flex-wrap gap-3 w-full bottom-0 left-0 right-0">
            <a href="#" class="text-secondary font-medium">{{ __('app.see_details') }}</a>
            <h2 class="text-4xl lg:text-5xl xl:text-[56px] text-neutral-0">{{ __('app.fish_health') }}</h2>
            <span class="text-secondary font-medium">2025</span>
          </div>
        </div>
        <div class="card rounded-[32px] relative min-h-[300px] after:size-full after:absolute after:inset-0 after:rounded-[32px] after:bg-gradient-to-t after:from-black/80 after:to-transparent">
          <img src="{{ asset('assets/images/home-1/service-3.webp') }}" class="min-h-[300px] object-cover object-center" alt="" />
          <div class="absolute z-[1] px-4 md:px-8 xl:px-14 pb-6 md:pb-8 xl:pb-14 flex justify-between items-center flex-wrap gap-3 w-full bottom-0 left-0 right-0">
            <a href="#" class="text-secondary font-medium">{{ __('app.see_details') }}</a>
            <h2 class="text-4xl lg:text-5xl xl:text-[56px] text-neutral-0">{{ __('app.water_management') }}</h2>
            <span class="text-secondary font-medium">2025</span>
          </div>
        </div>
        <div class="card rounded-[32px] relative min-h-[300px] after:size-full after:absolute after:inset-0 after:rounded-[32px] after:bg-gradient-to-t after:from-black/80 after:to-transparent">
          <img src="{{ asset('assets/images/home-1/service-4.webp') }}" class="min-h-[300px] object-cover object-center" alt="" />
          <div class="absolute z-[1] px-4 md:px-8 xl:px-14 pb-6 md:pb-8 xl:pb-14 flex justify-between items-center flex-wrap gap-3 w-full bottom-0 left-0 right-0">
            <a href="#" class="text-secondary font-medium">{{ __('app.see_details') }}</a>
            <h2 class="text-4xl lg:text-5xl xl:text-[56px] text-neutral-0">{{ __('app.fish_breeding') }}</h2>
            <span class="text-secondary font-medium">2025</span>
          </div>
        </div>
      </div>
    </section>
    <!-- service section end -->

    <!-- skills section start -->
    <section class="bg-primary-50 py-120">
      <div class="cont grid grid-cols-12 gap-6 items-center">
        <div class="col-span-12 lg:col-span-5">
          <p class="sub-heading">{{ __('app.our_skills') }}</p>
          <h2 class="mb-6 reveal_anim">{{ __('app.aquaculture_solutions') }}</h2>
          <p class="reveal_anim mb-5 xl:mb-8">{{ __('app.skills_description') }}</p>
          <a href="#" class="btn-secondary"
            >{{ __('app.lets_work') }} <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg
          ></a>
        </div>
        <div class="col-span-12 lg:col-span-7 xxl:col-span-6 xxl:col-start-7 flex flex-wrap justify-center items-center gap-6">
          <div class="size-[250px] xl:size-[306px] rounded-full f-center circular-progress" data-percentage="95" data-bg-color="#f5f5f5">
            <div class="absolute size-[235px] xl:size-[285px] rounded-full bg-neutral-0 inner-circle"></div>
            <div class="text-center z-[2]">
              <p class="relative mb-1 text-5xl xl:text-[64px] font-bold text-primary-500 percentage">0%</p>
              <span class="text-neutral-400">{{ __('app.water_quality') }}</span>
            </div>
          </div>
          <div class="size-[250px] xl:size-[306px] rounded-full f-center circular-progress" data-percentage="90" data-bg-color="#f5f5f5">
            <div class="absolute size-[235px] xl:size-[285px] rounded-full bg-neutral-0 inner-circle"></div>
            <div class="text-center z-[2]">
              <p class="relative mb-1 text-5xl xl:text-[64px] font-bold text-primary-500 percentage">0%</p>
              <span class="text-neutral-400">{{ __('app.fish_health') }}</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- skills section end -->

    <!-- projects section start -->
    <section class="bg-neutral-0 relative py-120">
      <div class="mx-auto text-center mb-10 xl:mb-14">
        <p class="sub-heading reveal_anim mx-auto">{{ __('app.recent_works_gallery') }}</p>
        <h2 class="reveal_anim">{{ __('app.our_completed_projects') }}</h2>
      </div>
      <div class="swiper projectSlider">
        <div class="swiper-wrapper">
          <div class="swiper-slide w-[280px] sm:w-[416px]">
            <div class="rounded-2xl">
              <img src="{{ asset('assets/images/home-1/project1.jpg') }}" class="object-cover object-center rounded-2xl" alt="" />
              <div class="project-inner">
                <div class="size-[60px] bg-secondary rounded-full f-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M168,76a12,12,0,1,1-12-12A12,12,0,0,1,168,76Zm42,79.08c-15.08,20.84-37.53,34.88-66.7,41.74-20.08,4.72-43.54,6-70.12,3.93q2.4,17.82,6.72,37.54a8,8,0,0,1-6.1,9.52,7.81,7.81,0,0,1-1.72.19,8,8,0,0,1-7.81-6.29q-4.89-22.36-7.41-42.62-20.22-2.51-42.58-7.41a8,8,0,0,1,3.43-15.63q19.7,4.32,37.5,6.73c-2.09-26.56-.78-50,3.93-70.06C66,83.55,80.05,61.1,100.88,46,115,35.76,140.15,23.64,179.27,24c21.19.21,40.83,4.33,43.81,6.08a8,8,0,0,1,2.83,2.83c1.75,3,5.87,22.59,6.08,43.78C232.21,98.31,228.57,129.44,210,155.08Zm-23.76,2.8A112.07,112.07,0,0,1,98.12,69.74C75.64,94,66.7,132.47,71.36,184.6,123.51,189.28,162,180.35,186.25,157.88ZM212.44,43.56a175.75,175.75,0,0,0-39.22-3.51c-24.34.64-44.71,6.49-60.76,17.39a96,96,0,0,0,86.09,86.1c10.91-16,16.76-36.42,17.4-60.76A175.82,175.82,0,0,0,212.44,43.56Z"
                    ></path>
                  </svg>
                </div>
                <a href="#" class="text-center">
                  <h6 class="text-secondary font-semibold mb-2">{{ __('app.aquaculture_development') }}</h6>
                  <h4 class="text-neutral-0 mb-2">{{ __('app.shrimp_farming_punjab_2024_28') }}</h4>
                  <p class="text-neutral-200 text-sm">{{ __('app.cost_1800_million') }}</p>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide w-[280px] sm:w-[416px]">
            <div class="rounded-2xl">
              <img src="{{ asset('assets/images/home-1/project-2.webp') }}" class="object-cover object-center rounded-2xl" alt="" />
              <div class="project-inner">
                <div class="size-[60px] bg-secondary rounded-full f-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M168,76a12,12,0,1,1-12-12A12,12,0,0,1,168,76Zm42,79.08c-15.08,20.84-37.53,34.88-66.7,41.74-20.08,4.72-43.54,6-70.12,3.93q2.4,17.82,6.72,37.54a8,8,0,0,1-6.1,9.52,7.81,7.81,0,0,1-1.72.19,8,8,0,0,1-7.81-6.29q-4.89-22.36-7.41-42.62-20.22-2.51-42.58-7.41a8,8,0,0,1,3.43-15.63q19.7,4.32,37.5,6.73c-2.09-26.56-.78-50,3.93-70.06C66,83.55,80.05,61.1,100.88,46,115,35.76,140.15,23.64,179.27,24c21.19.21,40.83,4.33,43.81,6.08a8,8,0,0,1,2.83,2.83c1.75,3,5.87,22.59,6.08,43.78C232.21,98.31,228.57,129.44,210,155.08Zm-23.76,2.8A112.07,112.07,0,0,1,98.12,69.74C75.64,94,66.7,132.47,71.36,184.6,123.51,189.28,162,180.35,186.25,157.88ZM212.44,43.56a175.75,175.75,0,0,0-39.22-3.51c-24.34.64-44.71,6.49-60.76,17.39a96,96,0,0,0,86.09,86.1c10.91-16,16.76-36.42,17.4-60.76A175.82,175.82,0,0,0,212.44,43.56Z"
                    ></path>
                  </svg>
                </div>
                <a href="#" class="text-center">
                  <h6 class="text-secondary font-semibold mb-2">{{ __('app.hatchery_development') }}</h6>
                  <h4 class="text-neutral-0 mb-2">{{ __('app.pangasius_hatchery_project') }}</h4>
                  <p class="text-neutral-200 text-sm">{{ __('app.cost_193_564_million') }}</p>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide w-[280px] sm:w-[416px]">
            <div class="rounded-2xl">
              <img src="{{ asset('assets/images/home-1/project-3.webp') }}" class="object-cover object-center rounded-2xl" alt="" />
              <div class="project-inner">
                <div class="size-[60px] bg-secondary rounded-full f-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M168,76a12,12,0,1,1-12-12A12,12,0,0,1,168,76Zm42,79.08c-15.08,20.84-37.53,34.88-66.7,41.74-20.08,4.72-43.54,6-70.12,3.93q2.4,17.82,6.72,37.54a8,8,0,0,1-6.1,9.52,7.81,7.81,0,0,1-1.72.19,8,8,0,0,1-7.81-6.29q-4.89-22.36-7.41-42.62-20.22-2.51-42.58-7.41a8,8,0,0,1,3.43-15.63q19.7,4.32,37.5,6.73c-2.09-26.56-.78-50,3.93-70.06C66,83.55,80.05,61.1,100.88,46,115,35.76,140.15,23.64,179.27,24c21.19.21,40.83,4.33,43.81,6.08a8,8,0,0,1,2.83,2.83c1.75,3,5.87,22.59,6.08,43.78C232.21,98.31,228.57,129.44,210,155.08Zm-23.76,2.8A112.07,112.07,0,0,1,98.12,69.74C75.64,94,66.7,132.47,71.36,184.6,123.51,189.28,162,180.35,186.25,157.88ZM212.44,43.56a175.75,175.75,0,0,0-39.22-3.51c-24.34.64-44.71,6.49-60.76,17.39a96,96,0,0,0,86.09,86.1c10.91-16,16.76-36.42,17.4-60.76A175.82,175.82,0,0,0,212.44,43.56Z"
                    ></path>
                  </svg>
                </div>
                <a href="#" class="text-center">
                  <h6 class="text-secondary font-semibold mb-2">{{ __('app.fisheries_information_system') }}</h6>
                  <h4 class="text-neutral-0 mb-2">{{ __('app.fisheries_ims_project') }}</h4>
                  <p class="text-neutral-200 text-sm">{{ __('app.cost_99_600_million') }}</p>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide w-[280px] sm:w-[416px]">
            <div class="rounded-2xl">
              <img src="{{ asset('assets/images/home-1/project-4.jpg') }}" class="object-cover object-center rounded-2xl" alt="" />
              <div class="project-inner">
                <div class="size-[60px] bg-secondary rounded-full f-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M168,76a12,12,0,1,1-12-12A12,12,0,0,1,168,76Zm42,79.08c-15.08,20.84-37.53,34.88-66.7,41.74-20.08,4.72-43.54,6-70.12,3.93q2.4,17.82,6.72,37.54a8,8,0,0,1-6.1,9.52,7.81,7.81,0,0,1-1.72.19,8,8,0,0,1-7.81-6.29q-4.89-22.36-7.41-42.62-20.22-2.51-42.58-7.41a8,8,0,0,1,3.43-15.63q19.7,4.32,37.5,6.73c-2.09-26.56-.78-50,3.93-70.06C66,83.55,80.05,61.1,100.88,46,115,35.76,140.15,23.64,179.27,24c21.19.21,40.83,4.33,43.81,6.08a8,8,0,0,1,2.83,2.83c1.75,3,5.87,22.59,6.08,43.78C232.21,98.31,228.57,129.44,210,155.08Zm-23.76,2.8A112.07,112.07,0,0,1,98.12,69.74C75.64,94,66.7,132.47,71.36,184.6,123.51,189.28,162,180.35,186.25,157.88ZM212.44,43.56a175.75,175.75,0,0,0-39.22-3.51c-24.34.64-44.71,6.49-60.76,17.39a96,96,0,0,0,86.09,86.1c10.91-16,16.76-36.42,17.4-60.76A175.82,175.82,0,0,0,212.44,43.56Z"
                    ></path>
                  </svg>
                </div>
                <a href="#" class="text-center">
                  <h6 class="text-secondary font-semibold mb-2">{{ __('app.market_infrastructure') }}</h6>
                  <h4 class="text-neutral-0 mb-2">{{ __('app.lahore_fish_market_feasibility') }}</h4>
                  <p class="text-neutral-200 text-sm">{{ __('app.cost_34_000_million') }}</p>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide w-[280px] sm:w-[416px]">
            <div class="rounded-2xl">
              <img src="{{ asset('assets/images/home-1/project-5.webp') }}" class="object-cover object-center rounded-2xl" alt="" />
              <div class="project-inner">
                <div class="size-[60px] bg-secondary rounded-full f-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M168,76a12,12,0,1,1-12-12A12,12,0,0,1,168,76Zm42,79.08c-15.08,20.84-37.53,34.88-66.7,41.74-20.08,4.72-43.54,6-70.12,3.93q2.4,17.82,6.72,37.54a8,8,0,0,1-6.1,9.52,7.81,7.81,0,0,1-1.72.19,8,8,0,0,1-7.81-6.29q-4.89-22.36-7.41-42.62-20.22-2.51-42.58-7.41a8,8,0,0,1,3.43-15.63q19.7,4.32,37.5,6.73c-2.09-26.56-.78-50,3.93-70.06C66,83.55,80.05,61.1,100.88,46,115,35.76,140.15,23.64,179.27,24c21.19.21,40.83,4.33,43.81,6.08a8,8,0,0,1,2.83,2.83c1.75,3,5.87,22.59,6.08,43.78C232.21,98.31,228.57,129.44,210,155.08Zm-23.76,2.8A112.07,112.07,0,0,1,98.12,69.74C75.64,94,66.7,132.47,71.36,184.6,123.51,189.28,162,180.35,186.25,157.88ZM212.44,43.56a175.75,175.75,0,0,0-39.22-3.51c-24.34.64-44.71,6.49-60.76,17.39a96,96,0,0,0,86.09,86.1c10.91-16,16.76-36.42,17.4-60.76A175.82,175.82,0,0,0,212.44,43.56Z"
                    ></path>
                  </svg>
                </div>
                <a href="#" class="text-center">
                  <h6 class="text-secondary font-semibold mb-2">{{ __('app.genetics_improvement') }}</h6>
                  <h4 class="text-neutral-0 mb-2">{{ __('app.fish_genetics_project_punjab') }}</h4>
                  <p class="text-neutral-200 text-sm">{{ __('app.cost_109_989_million') }}</p>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide w-[280px] sm:w-[416px]">
            <div class="rounded-2xl">
              <img src="{{ asset('assets/images/home-1/project-1.jpg') }}" class="object-cover object-center rounded-2xl" alt="" />
              <div class="project-inner">
                <div class="size-[60px] bg-secondary rounded-full f-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M168,76a12,12,0,1,1-12-12A12,12,0,0,1,168,76Zm42,79.08c-15.08,20.84-37.53,34.88-66.7,41.74-20.08,4.72-43.54,6-70.12,3.93q2.4,17.82,6.72,37.54a8,8,0,0,1-6.1,9.52,7.81,7.81,0,0,1-1.72.19,8,8,0,0,1-7.81-6.29q-4.89-22.36-7.41-42.62-20.22-2.51-42.58-7.41a8,8,0,0,1,3.43-15.63q19.7,4.32,37.5,6.73c-2.09-26.56-.78-50,3.93-70.06C66,83.55,80.05,61.1,100.88,46,115,35.76,140.15,23.64,179.27,24c21.19.21,40.83,4.33,43.81,6.08a8,8,0,0,1,2.83,2.83c1.75,3,5.87,22.59,6.08,43.78C232.21,98.31,228.57,129.44,210,155.08Zm-23.76,2.8A112.07,112.07,0,0,1,98.12,69.74C75.64,94,66.7,132.47,71.36,184.6,123.51,189.28,162,180.35,186.25,157.88ZM212.44,43.56a175.75,175.75,0,0,0-39.22-3.51c-24.34.64-44.71,6.49-60.76,17.39a96,96,0,0,0,86.09,86.1c10.91-16,16.76-36.42,17.4-60.76A175.82,175.82,0,0,0,212.44,43.56Z"
                    ></path>
                  </svg>
                </div>
                <a href="#" class="text-center">
                  <h6 class="text-secondary font-semibold mb-2">{{ __('app.shrimp_aquaculture_development') }}</h6>
                  <h4 class="text-neutral-0 mb-2">{{ __('app.pilot_shrimp_farming_cluster') }}</h4>
                  <p class="text-neutral-200 text-sm">{{ __('app.cost_2662_721_million') }}</p>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide w-[280px] sm:w-[416px]">
            <div class="rounded-2xl">
              <img src="{{ asset('assets/images/home-1/project-8.jpg') }}" class="object-cover object-center rounded-2xl" alt="" />
              <div class="project-inner">
                <div class="size-[60px] bg-secondary rounded-full f-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M168,76a12,12,0,1,1-12-12A12,12,0,0,1,168,76Zm42,79.08c-15.08,20.84-37.53,34.88-66.7,41.74-20.08,4.72-43.54,6-70.12,3.93q2.4,17.82,6.72,37.54a8,8,0,0,1-6.1,9.52,7.81,7.81,0,0,1-1.72.19,8,8,0,0,1-7.81-6.29q-4.89-22.36-7.41-42.62-20.22-2.51-42.58-7.41a8,8,0,0,1,3.43-15.63q19.7,4.32,37.5,6.73c-2.09-26.56-.78-50,3.93-70.06C66,83.55,80.05,61.1,100.88,46,115,35.76,140.15,23.64,179.27,24c21.19.21,40.83,4.33,43.81,6.08a8,8,0,0,1,2.83,2.83c1.75,3,5.87,22.59,6.08,43.78C232.21,98.31,228.57,129.44,210,155.08Zm-23.76,2.8A112.07,112.07,0,0,1,98.12,69.74C75.64,94,66.7,132.47,71.36,184.6,123.51,189.28,162,180.35,186.25,157.88ZM212.44,43.56a175.75,175.75,0,0,0-39.22-3.51c-24.34.64-44.71,6.49-60.76,17.39a96,96,0,0,0,86.09,86.1c10.91-16,16.76-36.42,17.4-60.76A175.82,175.82,0,0,0,212.44,43.56Z"
                    ></path>
                  </svg>
                </div>
                <a href="#" class="text-center">
                  <h6 class="text-secondary font-semibold mb-2">{{ __('app.cage_aquaculture_development') }}</h6>
                  <h4 class="text-neutral-0 mb-2">{{ __('app.cage_culture_cluster_project') }}</h4>
                  <p class="text-neutral-200 text-sm">{{ __('app.cost_1474_867_million') }}</p>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide w-[280px] sm:w-[416px]">
            <div class="rounded-2xl">
              <img src="{{ asset('assets/images/home-1/project-4.webp') }}" class="object-cover object-center rounded-2xl" alt="" />
              <div class="project-inner">
                <div class="size-[60px] bg-secondary rounded-full f-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M168,76a12,12,0,1,1-12-12A12,12,0,0,1,168,76Zm42,79.08c-15.08,20.84-37.53,34.88-66.7,41.74-20.08,4.72-43.54,6-70.12,3.93q2.4,17.82,6.72,37.54a8,8,0,0,1-6.1,9.52,7.81,7.81,0,0,1-1.72.19,8,8,0,0,1-7.81-6.29q-4.89-22.36-7.41-42.62-20.22-2.51-42.58-7.41a8,8,0,0,1,3.43-15.63q19.7,4.32,37.5,6.73c-2.09-26.56-.78-50,3.93-70.06C66,83.55,80.05,61.1,100.88,46,115,35.76,140.15,23.64,179.27,24c21.19.21,40.83,4.33,43.81,6.08a8,8,0,0,1,2.83,2.83c1.75,3,5.87,22.59,6.08,43.78C232.21,98.31,228.57,129.44,210,155.08Zm-23.76,2.8A112.07,112.07,0,0,1,98.12,69.74C75.64,94,66.7,132.47,71.36,184.6,123.51,189.28,162,180.35,186.25,157.88ZM212.44,43.56a175.75,175.75,0,0,0-39.22-3.51c-24.34.64-44.71,6.49-60.76,17.39a96,96,0,0,0,86.09,86.1c10.91-16,16.76-36.42,17.4-60.76A175.82,175.82,0,0,0,212.44,43.56Z"
                    ></path>
                  </svg>
                </div>
                <a href="#" class="text-center">
                  <h6 class="text-secondary font-semibold mb-2">{{ __('app.fisheries_infrastructure_upgradation') }}</h6>
                  <h4 class="text-neutral-0 mb-2">{{ __('app.chashma_fisheries_rehab') }}</h4>
                  <p class="text-neutral-200 text-sm">{{ __('app.cost_117_483_million') }}</p>
                </a>
              </div>
            </div>
          </div>
          <div class="swiper-slide w-[280px] sm:w-[416px]">
            <div class="rounded-2xl">
              <img src="{{ asset('assets/images/home-1/pro.jpg') }}" class="object-cover object-center rounded-2xl" alt="" />
              <div class="project-inner">
                <div class="size-[60px] bg-secondary rounded-full f-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M168,76a12,12,0,1,1-12-12A12,12,0,0,1,168,76Zm42,79.08c-15.08,20.84-37.53,34.88-66.7,41.74-20.08,4.72-43.54,6-70.12,3.93q2.4,17.82,6.72,37.54a8,8,0,0,1-6.1,9.52,7.81,7.81,0,0,1-1.72.19,8,8,0,0,1-7.81-6.29q-4.89-22.36-7.41-42.62-20.22-2.51-42.58-7.41a8,8,0,0,1,3.43-15.63q19.7,4.32,37.5,6.73c-2.09-26.56-.78-50,3.93-70.06C66,83.55,80.05,61.1,100.88,46,115,35.76,140.15,23.64,179.27,24c21.19.21,40.83,4.33,43.81,6.08a8,8,0,0,1,2.83,2.83c1.75,3,5.87,22.59,6.08,43.78C232.21,98.31,228.57,129.44,210,155.08Zm-23.76,2.8A112.07,112.07,0,0,1,98.12,69.74C75.64,94,66.7,132.47,71.36,184.6,123.51,189.28,162,180.35,186.25,157.88ZM212.44,43.56a175.75,175.75,0,0,0-39.22-3.51c-24.34.64-44.71,6.49-60.76,17.39a96,96,0,0,0,86.09,86.1c10.91-16,16.76-36.42,17.4-60.76A175.82,175.82,0,0,0,212.44,43.56Z"
                    ></path>
                  </svg>
                </div>
                <a href="#" class="text-center">
                  <h6 class="text-secondary font-semibold mb-2">{{ __('app.fisheries_promotion_nutrition') }}</h6>
                  <h4 class="text-neutral-0 mb-2">{{ __('app.fish_consumption_awareness') }}</h4>
                  <p class="text-neutral-200 text-sm">{{ __('app.cost_70_163_million') }}</p>
                </a>
              </div>
            </div>
          </div>
          
        </div>
      </div>
        <div class="flex justify-center mt-10 xl:mt-14">
        <a href="#" class="btn-secondary">
          {{ __('app.view_all') }}
          <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
        </a>
      </div>
    </section>
    <!-- projects section end -->

    <!-- process section start -->
    <section class="bg-primary-50 relative pt-120">
      <div class="cont">
        <div class="grid grid-cols-12 gap-4 mb-10 xl:mb-14">
          <div class="col-span-12 md:col-span-6 lg:col-span-5">
            <p class="sub-heading reveal_anim">{{ __('app.our_process') }}</p>
            <h2 class="scale_anim">{{ __('app.our_process_for_quality') }} {{ __('app.seafood') }}</h2>
          </div>
          <div class="col-span-12 md:col-span-6 lg:col-span-5 lg:col-start-8 flex items-end">
            <p class="reveal_anim">{{ __('app.step_by_step_process') }}</p>
          </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 xl:gap-6 text-center">
          <div class="fade_anim bg-neutral-0 rounded-3xl shadow-[0px_6px_12px_-2px_rgba(88,82,129,0.08)] p-4 md:p-6 xl:py-8 xl:px-7 process-card">
            <div class="process-icon size-[200px] rounded-full bg-neutral-0 border border-neutral-30 f-center relative mb-5 xl:mb-8">
              <div class="w-10 h-14 z-[1] rounded-b-full bg-gradient-to-t from-primary-300 to-transparent absolute top-0 left-1/2 -translate-x-1/2"></div>
              <div class="size-[160px] rounded-full bg-primary-50 f-center relative">
                <span class="absolute top-0 left-1/2 z-[2] -translate-x-1/2 size-8 f-center rounded-full bg-secondary text-neutral-900 text-sm">01</span>
                <img src="{{ asset('assets/images/home-1/process-1.png') }}" alt="" />
              </div>
            </div>
            <div class="process-content w-full">
              <h4 class="mb-4 text-center">{{ __('app.fresh_farming') }}</h4>
              <p class="text-center leading-relaxed">{{ __('app.fresh_farming_desc') }}</p>
            </div>
          </div>
          <div data-delay=".2" class="fade_anim bg-neutral-0 rounded-3xl shadow-[0px_6px_12px_-2px_rgba(88,82,129,0.08)] p-4 md:p-6 xl:py-8 xl:px-7 process-card">
            <div class="process-icon size-[200px] rounded-full bg-neutral-0 border border-neutral-30 f-center relative mb-5 xl:mb-8">
              <div class="w-10 h-14 z-[1] rounded-b-full bg-gradient-to-t from-primary-300 to-transparent absolute top-0 left-1/2 -translate-x-1/2"></div>
              <div class="size-[160px] rounded-full bg-primary-50 f-center relative">
                <span class="absolute top-0 left-1/2 z-[2] -translate-x-1/2 size-8 f-center rounded-full bg-secondary text-neutral-900 text-sm">02</span>
                <img src="{{ asset('assets/images/home-1/process-2.png') }}" alt="" />
              </div>
            </div>
            <div class="process-content w-full">
              <h4 class="mb-4 text-center">{{ __('app.quality_monitoring') }}</h4>
              <p class="text-center leading-relaxed">{{ __('app.quality_monitoring_desc') }}</p>
            </div>
          </div>
          <div data-delay=".4" class="fade_anim bg-neutral-0 rounded-3xl shadow-[0px_6px_12px_-2px_rgba(88,82,129,0.08)] p-4 md:p-6 xl:py-8 xl:px-7 process-card">
            <div class="process-icon size-[200px] rounded-full bg-neutral-0 border border-neutral-30 f-center relative mb-5 xl:mb-8">
              <div class="w-10 h-14 z-[1] rounded-b-full bg-gradient-to-t from-primary-300 to-transparent absolute top-0 left-1/2 -translate-x-1/2"></div>
              <div class="size-[160px] rounded-full bg-primary-50 f-center relative">
                <span class="absolute top-0 left-1/2 z-[2] -translate-x-1/2 size-8 f-center rounded-full bg-secondary text-neutral-900 text-sm">03</span>
                <img src="{{ asset('assets/images/home-1/process-3.png') }}" alt="" />
              </div>
            </div>
            <div class="process-content w-full">
              <h4 class="mb-4 text-center">{{ __('app.efficient_harvesting') }}</h4>
              <p class="text-center leading-relaxed">{{ __('app.efficient_harvesting_desc') }}</p>
            </div>
          </div>
          <div data-delay=".6" class="fade_anim bg-neutral-0 rounded-3xl shadow-[0px_6px_12px_-2px_rgba(88,82,129,0.08)] p-4 md:p-6 xl:py-8 xl:px-7 process-card">
            <div class="process-icon size-[200px] rounded-full bg-neutral-0 border border-neutral-30 f-center relative mb-5 xl:mb-8">
              <div class="w-10 h-14 z-[1] rounded-b-full bg-gradient-to-t from-primary-300 to-transparent absolute top-0 left-1/2 -translate-x-1/2"></div>
              <div class="size-[160px] rounded-full bg-primary-50 f-center relative">
                <span class="absolute top-0 left-1/2 z-[2] -translate-x-1/2 size-8 f-center rounded-full bg-secondary text-neutral-900 text-sm">04</span>
                <img src="{{ asset('assets/images/home-1/process-4.png') }}" alt="" />
              </div>
            </div>
            <div class="process-content w-full">
              <h4 class="mb-4 text-center">{{ __('app.timely_delivery') }}</h4>
              <p class="text-center leading-relaxed">{{ __('app.timely_delivery_desc') }}</p>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 xl:translate-y-1/2 relative z-[1] max-xl:py-14">
          <div class="reveal_anim p-3 xl:p-4 rounded-3xl bg-neutral-0 flex flex-col sm:flex-row items-center gap-4 shadow-[0px_4px_24px_0px_rgba(0,0,0,0.06)]">
            <img src="{{ asset('assets/images/home-1/process-card-1.webp') }}" class="rounded-xl max-sm:w-full" alt="" />
            <div class="process-info-card">
              <div class="process-info-content">
                <div class="process-info-text">
                  <h4 class="mb-4">{{ __('app.global_trade_opportunities') }}</h4>
                  <p class="mb-4">{{ __('app.expanding_markets') }}</p>
                </div>
                <a href="#" class="process-info-link text-primary-500 uppercase underline">{{ __('app.view_more') }}</a>
              </div>
            </div>
          </div>
          <div data-reveal-from="right" class="reveal_anim p-3 xl:p-4 rounded-3xl bg-neutral-0 flex flex-col sm:flex-row items-center gap-4 shadow-[0px_4px_24px_0px_rgba(0,0,0,0.06)]">
            <img src="{{ asset('assets/images/home-1/process-card-2.webp') }}" class="rounded-xl max-sm:w-full" alt="" />
            <div class="process-info-card">
              <div class="process-info-content">
                <div class="process-info-text">
                  <h4 class="mb-4">{{ __('app.whats_coming_next') }}</h4>
                  <p class="mb-4">{{ __('app.stay_tuned') }}</p>
                </div>
                <a href="#" class="process-info-link text-primary-500 uppercase underline">{{ __('app.view_more') }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- process section end -->

    <!-- team section start -->
    <section class="bg-neutral-0 pb-120 pt-14 xl:pt-56">
      <div class="cont grid grid-cols-12 gap-6 items-center">
        <div class="col-span-12 md:col-span-6 lg:col-span-5">
          <p class="sub-heading reveal_anim">{{ __('app.our_team') }}</p>
          <h2 class="mb-6 reveal_anim">{{ __('app.meet_our_expert_team') }}</h2>
          <p class="reveal_anim mb-5 xl:mb-8">{{ __('app.meet_our_expert_team_desc') }}</p>
          <a href="#" class="btn-secondary"
            >{{ __('app.view_all') }} <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg
          ></a>
        </div>
        <div class="col-span-12 md:col-span-6 lg:col-start-7 relative">
          <div class="swiper team1Slider">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <a href="#" class="text-center">
                  <img src="{{ asset('assets/images/home-1/muddassir-riaz-malik.jpeg') }}" class="rounded-xl w-full mb-6" alt="" />
                  <p class="text-xl font-semibold text-neutral-900 mb-2">
                    {{ __('app.muddassir_riaz_malik') }}</p>
                  <p>{{ __('app.muddassir_riaz_malik_desc') }}</p>
                </a>
              </div>
              <div class="swiper-slide">
                <a href="#" class="text-center">
                  <img src="{{ asset('assets/images/home-1/dg-fisher-muhammad-saleem-afzal.jpg') }}" class="rounded-xl w-full mb-6" alt="" />
                  <p class="text-xl font-semibold text-neutral-900 mb-2">{{ __('app.muhammad_saleem_afzal') }}</p>
                  <p>{{ __('app.muhammad_saleem_afzal_desc') }}</p>
                </a>
              </div>
          
           
            </div>
          </div>
          <button aria-label="show prev slide" class="prev-team bg-neutral-0 border-neutral-0 hover:border-primary-300 navigation-btn absolute top-[40%] z-[1] -translate-y-1/2 left-0 lg:-translate-x-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256"><path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z"></path></svg>
          </button>
          <button aria-label="show next slide" class="next-team bg-neutral-0 border-neutral-0 hover:border-primary-300 navigation-btn absolute top-[40%] z-[1] -translate-y-1/2 right-0 lg:translate-x-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="currentColor" viewBox="0 0 256 256"><path d="M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z"></path></svg>
          </button>
        </div>
      </div>
    </section>
    <!-- team section end -->

    <!-- Counter section start -->
    <section class="py-120 bg-neutral-900 relative overflow-x-hidden">
      <img src="{{ asset('assets/images/home-1/counter-fish.png') }}" class="max-xl:hidden fish fish-right absolute right-3 bottom-6" alt="" />
      <div class="cont grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="max-w-[250px]">
          <div class="relative">
            <span class="odometer-text"><span data-end-value="60" class="counter">60</span>+</span>
            <p class="font-medium text-base py-1 px-4 absolute text-neutral-0 right-5 top-1/2 -translate-y-1/2 bg-neutral-900 rounded-lg">{{ __('app.acres_cultivated_plus') }}</p>
          </div>
          <p class="text-neutral-0">{{ __('app.at_pure_agriculture_desc') }}</p>
        </div>
        <div class="max-w-[250px]" data-delay=".2">
          <div class="relative">
            <span class="odometer-text"><span data-end-value="50" class="counter">50</span>+</span>
            <p class="font-medium text-base py-1 px-4 absolute text-neutral-0 right-5 top-1/2 -translate-y-1/2 bg-neutral-900 rounded-lg">{{ __('app.products_plus') }}</p>
          </div>
          <p class="text-neutral-0">{{ __('app.at_pure_agriculture_desc') }}</p>
        </div>
        <div class="max-w-[250px]" data-delay=".4">
          <div class="relative">
            <span class="odometer-text"><span data-end-value="27" class="counter">27</span>+</span>
            <p class="font-medium text-base py-1 px-4 absolute text-neutral-0 right-5 top-1/2 -translate-y-1/2 bg-neutral-900 rounded-lg">{{ __('app.years_plus') }}</p>
          </div>
          <p class="text-neutral-0">{{ __('app.at_pure_agriculture_desc') }}</p>
        </div>
        <div class="max-w-[280px]" data-delay=".6">
          <div class="relative">
            <span class="odometer-text"><span data-end-value="300" class="counter">300</span>+</span>
            <p class="font-medium text-base py-1 px-4 absolute text-neutral-0 right-5 top-1/2 -translate-y-1/2 bg-neutral-900 rounded-lg">{{ __('app.happy_customers_plus') }}</p>
          </div>
          <p class="text-neutral-0">{{ __('app.satisfied_customers_desc') }}</p>
        </div>
      </div>
    </section>
    <!-- Counter section end -->

    <!-- news section start -->
    <section class="bg-neutral-0 py-120 relative overflow-hidden">
      <img src="{{ asset('assets/images/home-1/blog-el-1.png') }}" class="max-xxl:hidden absolute fish fish-top top-[-200px] left-0" alt="" />
      <img src="{{ asset('assets/images/home-1/blog-el-2.png') }}" class="max-xxl:hidden absolute top-1/2 -translate-y-1/2 right-0" alt="" />
      <div class="cont relative z-[2]">
        <div class="flex justify-between items-center flex-wrap gap-4 mb-10 xl:mb-14">
          <div>
            <p class="sub-heading reveal_anim">{{ __('app.blogs_news') }}</p>
            <h2 class="reveal_anim">{{ __('app.news_article') }}</h2>
          </div>
          <a href="#" class="btn-secondary"
            >{{ __('app.view_all') }} <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg
          ></a>
        </div>
        <div class="grid grid-cols-12 gap-4 xl:gap-6">
          <div class="col-span-12 md:col-span-5 xxl:col-span-6 p-4 lg:p-5 xl:p-6 rounded-xl bg-neutral-0 border border-neutral-40">
            <a href="#" aria-label="Read News">
              <img src="{{ asset('assets/images/home-1/shrimp-1.jpg') }}" class="rounded-xl w-full mb-5" alt="" />
            </a>
            <div class="mb-5 flex justify-between items-center">
              <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary-300" fill="currentColor" viewBox="0 0 256 256"><path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path></svg>
                <span>{{ __('app.admin') }}</span>
              </div>
              <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary-300" fill="currentColor" viewBox="0 0 256 256"><path d="M168,112a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,112Zm-8,24H96a8,8,0,0,0,0,16h64a8,8,0,0,0,0-16Zm72-8A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>
                <span>{{ __('app.comments_02') }}</span>
              </div>
            </div>
            <h3 class="mb-4">{{ __('app.innovations_sustainable_aquaculture') }}</h3>
            <p class="mb-5 xl:mb-8 lg:text-lg">{{ __('app.innovations_sustainable_aquaculture_desc') }}</p>
            <a href="#" class="text-primary-300 text-lg font-medium underline">{{ __('app.see_details') }}</a>
          </div>
          <div class="col-span-12 md:col-span-7 xxl:col-span-6 space-y-4 xl:space-y-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center p-3 lg:p-4 rounded-xl bg-neutral-0 border border-neutral-40">
              <a href="#" aria-label="Read News">
                <img src="{{ asset('assets/images/home-1/shrimp-2.jpg') }}" class="rounded-xl xl:min-w-[264px] max-sm:w-full shrink-0" alt="" />
                <div>
                  <div class="mb-5 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary-300" fill="currentColor" viewBox="0 0 256 256"><path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path></svg>
                      <span>{{ __('app.admin') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary-300" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M168,112a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,112Zm-8,24H96a8,8,0,0,0,0,16h64a8,8,0,0,0,0-16Zm72-8A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path>
                      </svg>
                      <span>{{ __('app.comments_02') }}</span>
                    </div>
                  </div>
                  <h4 class="mb-4">{{ __('app.future_shrimp_farming') }}</h4>
                  <p class="mb-5 xl:mb-8 lg:text-lg">{{ __('app.future_shrimp_farming_desc') }}</p>
                  <a href="#" class="text-primary-300 text-lg font-medium underline">{{ __('app.see_details') }}</a>
                </div>
              </a>
            </div>
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center p-3 lg:p-4 rounded-xl bg-neutral-0 border border-neutral-40">
              <a href="#" aria-label="Read News">
                <img src="{{ asset('assets/images/home-1/shrimp-3.jpg') }}" class="rounded-xl xl:min-w-[264px] max-sm:w-full shrink-0" alt="" />
                <div>
                  <div class="mb-5 flex justify-between items-center">
                    <div class="flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary-300" fill="currentColor" viewBox="0 0 256 256"><path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path></svg>
                      <span>{{ __('app.admin') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-primary-300" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M168,112a8,8,0,0,1-8,8H96a8,8,0,0,1,0-16h64A8,8,0,0,1,168,112Zm-8,24H96a8,8,0,0,0,0,16h64a8,8,0,0,0,0-16Zm72-8A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path>
                      </svg>
                      <span>{{ __('app.comments_02') }}</span>
                    </div>
                  </div>
                  <h4 class="mb-4">{{ __('app.enhancing_shrimp_health') }}</h4>
                  <p class="mb-5 xl:mb-8 lg:text-lg">{{ __('app.enhancing_shrimp_health_desc') }}</p>
                  <a href="#" class="text-primary-300 text-lg font-medium underline">{{ __('app.see_details') }}</a>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- news section end -->

    <!-- Tenders section start -->
    <section class="bg-primary-50 relative py-120 overflow-x-hidden">
      <img src="{{ asset('assets/images/home-1/testimonial-el.png') }}" class="absolute max-xxl:hidden left-0 top-0" alt="" />
      <img src="{{ asset('assets/images/home-1/testimonial-fish.png') }}" class="absolute fish fish-right max-xl:hidden right-5 bottom-5" alt="" />
      <div class="mx-auto text-center mb-10 xl:mb-14">
        <p class="sub-heading reveal_anim mx-auto">{{ __('app.tenders') }}</p>
        <h2 class="reveal_anim">{{ __('app.latest_tender_notices') }}</h2>
      </div>
      <div class="cont">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 xl:gap-8">
          <!-- Tender 1 -->
          <div class="bg-neutral-0 rounded-2xl p-6 xl:p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
              <span class="text-sm font-semibold text-red-600">{{ __('app.new') }}</span>
            </div>
            <h3 class="text-lg xl:text-xl font-bold mb-3 text-neutral-900">{{ __('app.shrimp_seed_pl10_procurement') }}</h3>
            <p class="text-neutral-600 mb-4">{{ __('app.shrimp_seed_pl10_procurement_desc') }}</p>
            <div class="flex items-center justify-between">
              <span class="text-sm text-neutral-500">{{ __('app.deadline') }}: {{ app()->getLocale() === 'ur' ? '15 جنوری 2025' : '15 Jan 2025' }}</span>
              <a href="http://punjabfisheries.gov.pk/tenders/tender%5Fnotice%5F2025005151224.pdf" target="_blank" class="btn-primary text-sm px-4 py-2">{{ __('app.view_details') }}</a>
            </div>
          </div>

          <!-- Tender 2 -->
          <div class="bg-neutral-0 rounded-2xl p-6 xl:p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
              <span class="text-sm font-semibold text-red-600">{{ __('app.new') }}</span>
            </div>
            <h3 class="text-lg xl:text-xl font-bold mb-3 text-neutral-900">{{ __('app.pre_qualification_shrimp_seed') }}</h3>
            <p class="text-neutral-600 mb-4">{{ __('app.pre_qualification_shrimp_seed_desc') }}</p>
            <div class="flex items-center justify-between">
              <span class="text-sm text-neutral-500">{{ __('app.deadline') }}: {{ app()->getLocale() === 'ur' ? '18 اپریل 2025' : '18 Apr 2025' }}</span>
              <a href="http://punjabfisheries.gov.pk/tenders/tender%5Fnotice%5F20250418.pdf" target="_blank" class="btn-primary text-sm px-4 py-2">{{ __('app.view_details') }}</a>
            </div>
          </div>

          <!-- Tender 3 -->
          <div class="bg-neutral-0 rounded-2xl p-6 xl:p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
              <span class="text-sm font-semibold text-red-600">{{ __('app.new') }}</span>
            </div>
            <h3 class="text-lg xl:text-xl font-bold mb-3 text-neutral-900">{{ __('app.aquaculture_development_project') }}</h3>
            <p class="text-neutral-600 mb-4">{{ __('app.aquaculture_development_project_desc') }}</p>
            <div class="flex items-center justify-between">
              <span class="text-sm text-neutral-500">{{ __('app.deadline') }}: {{ app()->getLocale() === 'ur' ? '11 مارچ 2025' : '11 Mar 2025' }}</span>
              <a href="http://punjabfisheries.gov.pk/tenders/tender%5Fnotice%5F20250311.pdf" target="_blank" class="btn-primary text-sm px-4 py-2">{{ __('app.view_details') }}</a>
            </div>
          </div>

          <!-- Tender 4 -->
          <div class="bg-neutral-0 rounded-2xl p-6 xl:p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
              <span class="text-sm font-semibold text-orange-600">{{ __('app.active') }}</span>
            </div>
            <h3 class="text-lg xl:text-xl font-bold mb-3 text-neutral-900">{{ __('app.various_items_procurement') }}</h3>
            <p class="text-neutral-600 mb-4">{{ __('app.various_items_procurement_desc') }}</p>
            <div class="flex items-center justify-between">
              <span class="text-sm text-neutral-500">{{ __('app.deadline') }}: {{ app()->getLocale() === 'ur' ? '18 جنوری 2025' : '18 Jan 2025' }}</span>
              <a href="http://punjabfisheries.gov.pk/tenders/tender-notice-20250118-WA0092.pdf" target="_blank" class="btn-primary text-sm px-4 py-2">{{ __('app.view_details') }}</a>
            </div>
          </div>

          <!-- Tender 5 -->
          <div class="bg-neutral-0 rounded-2xl p-6 xl:p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
              <span class="text-sm font-semibold text-orange-600">{{ __('app.active') }}</span>
            </div>
            <h3 class="text-lg xl:text-xl font-bold mb-3 text-neutral-900">{{ __('app.pangasius_project_items') }}</h3>
            <p class="text-neutral-600 mb-4">{{ __('app.pangasius_project_items_desc') }}</p>
            <div class="flex items-center justify-between">
              <span class="text-sm text-neutral-500">{{ __('app.deadline') }}: {{ app()->getLocale() === 'ur' ? '12 دسمبر 2024' : '12 Dec 2024' }}</span>
              <a href="http://punjabfisheries.gov.pk/tenders/Tender-Notice-for-Various-Items-Pangasius121220241055.pdf" target="_blank" class="btn-primary text-sm px-4 py-2">{{ __('app.view_details') }}</a>
            </div>
          </div>

          <!-- Tender 6 -->
          <div class="bg-neutral-0 rounded-2xl p-6 xl:p-8 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
              <span class="text-sm font-semibold text-orange-600">{{ __('app.active') }}</span>
            </div>
            <h3 class="text-lg xl:text-xl font-bold mb-3 text-neutral-900">{{ __('app.shrimp_farming_equipment') }}</h3>
            <p class="text-neutral-600 mb-4">{{ __('app.shrimp_farming_equipment_desc') }}</p>
            <div class="flex items-center justify-between">
              <span class="text-sm text-neutral-500">{{ __('app.deadline') }}: {{ app()->getLocale() === 'ur' ? '18 اکتوبر 2024' : '18 Oct 2024' }}</span>
              <a href="http://punjabfisheries.gov.pk/tenders/Tender%5FNotice%5F18-10-2024-shrimp.pdf" target="_blank" class="btn-primary text-sm px-4 py-2">{{ __('app.view_details') }}</a>
            </div>
          </div>

          
        
        <div class="text-center mt-10 xl:mt-14">
          <a href="http://punjabfisheries.gov.pk/tenders/tender-notice.html" target="_blank" class="btn-secondary">
            {{ __('app.view_all') }} {{ __('app.tenders') }} <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
          </a>
        </div>
      </div>
    </section>
    <!-- Tenders section end -->

    <!-- Announcements section start -->
    <section class="bg-neutral-0 py-120 relative overflow-hidden">
      <div class="cont relative z-[2]">
        <div class="flex justify-between items-center flex-wrap gap-4 mb-10 xl:mb-14">
          <div>
            <p class="sub-heading reveal_anim">{{ __('app.announcements') }}</p>
            <h2 class="reveal_anim">{{ __('app.latest_announcements') }}</h2>
          </div>
          <a href="{{ route('frontend.announcements') }}" class="btn-secondary">{{ __('app.view_all') }} </a>
        </div>
        
        @if($featuredAnnouncements->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 xl:gap-8 mb-10">
          @foreach($featuredAnnouncements->take(3) as $announcement)
          <div class="bg-neutral-0 rounded-2xl p-6 xl:p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-neutral-40">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-3 h-3 bg-primary-500 rounded-full"></div>
              <span class="text-sm font-semibold text-primary-600 uppercase">{{ ucfirst($announcement->type) }}</span>
              @if($announcement->priority === 'high')
              <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full">High Priority</span>
              @endif
            </div>
            <h3 class="text-lg xl:text-xl font-bold mb-3 text-neutral-900 line-clamp-2">{{ $announcement->title }}</h3>
            <p class="text-neutral-600 mb-4 line-clamp-3">{{ Str::limit($announcement->description, 120) }}</p>
            <div class="flex items-center justify-between">
              <span class="text-sm text-neutral-500">{{ $announcement->published_date->format('M d, Y') }}</span>
              <a href="{{ route('frontend.announcements.show', $announcement) }}" class="btn-primary text-sm px-4 py-2">{{ __('app.read_more') }}</a>
            </div>
          </div>
          @endforeach
        </div>
        @endif

        @if($latestAnnouncements->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 xl:gap-8">
          @foreach($latestAnnouncements->take(6) as $announcement)
          <div class="bg-neutral-0 rounded-2xl p-6 xl:p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-neutral-40">
            <div class="flex items-center gap-3 mb-4">
              <div class="w-3 h-3 bg-{{ $announcement->priority === 'high' ? 'red' : ($announcement->priority === 'normal' ? 'primary' : 'blue') }}-500 rounded-full"></div>
              <span class="text-sm font-semibold text-{{ $announcement->priority === 'high' ? 'red' : ($announcement->priority === 'normal' ? 'primary' : 'blue') }}-600 uppercase">{{ ucfirst($announcement->type) }}</span>
            </div>
            <h3 class="text-lg xl:text-xl font-bold mb-3 text-neutral-900 line-clamp-2">{{ $announcement->title }}</h3>
            <p class="text-neutral-600 mb-4 line-clamp-3">{{ Str::limit($announcement->description, 100) }}</p>
            <div class="flex items-center justify-between">
              <span class="text-sm text-neutral-500">{{ $announcement->published_date->format('M d, Y') }}</span>
              <a href="{{ route('frontend.announcements.show', $announcement) }}" class="text-primary-500 text-sm font-medium hover:text-primary-600">{{ __('app.read_more') }} →</a>
            </div>
          </div>
          @endforeach
        </div>
        @endif

        @if($featuredAnnouncements->count() === 0 && $latestAnnouncements->count() === 0)
        <div class="text-center py-12">
          <div class="w-16 h-16 bg-neutral-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-neutral-900 mb-2">{{ __('app.no_announcements_available') }}</h3>
          <p class="text-neutral-600">{{ __('app.check_back_later') }}</p>
        </div>
        @endif
      </div>
    </section>
    <!-- Announcements section end -->

    <!-- Book Appointment section start -->
    <section class="py-120 bg-cover bg-no-repeat bg-neutral-900 relative after:inset-0 after:absolute after:size-full after:bg-neutral-900/60" data-bg="{{ asset('assets/images/home-1/booking-bg.webp') }}">
      <div class="cont grid grid-cols-12 gap-6 xl:gap-8 items-center relative z-[1]">
        <div class="col-span-12 lg:col-span-6 xl:col-span-5">
          <form class="reveal_anim p-4 md:p-6 xl:p-8 bg-neutral-0 rounded-2xl">
            <h2 class="mb-6 xl:mb-8 reveal_anim" data-delay=".5">{{ __('app.book_appointment') }}</h2>
            <div class="grid grid-cols-2 gap-4 xl:gap-6 mb-6 xl:mb-10">
              <input type="text" class="col-span-2 md:col-span-1 py-3 px-4 rounded-lg w-full border bg-neutral-10 border-neutral-40 focus:border-primary-300" placeholder="{{ __('app.full_name') }}" />
              <input type="number" class="col-span-2 md:col-span-1 py-3 px-4 rounded-lg w-full border bg-neutral-10 border-neutral-40 focus:border-primary-300" placeholder="{{ __('app.phone_number') }}" />
              <input type="email" class="col-span-2 py-3 px-4 rounded-lg w-full border bg-neutral-10 border-neutral-40 focus:border-primary-300" placeholder="{{ __('app.email') }}" />
              <textarea class="col-span-2 py-3 px-4 rounded-lg w-full border bg-neutral-10 border-neutral-40 focus:border-primary-300" placeholder="{{ __('app.message') }}" rows="5"></textarea>
            </div>
            <button type="submit" class="btn-secondary">
              {{ __('app.submit') }} <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
            </button>
          </form>
        </div>
        <div class="col-span-12 lg:col-span-6 xl:col-start-7">
          <p class="sub-heading reveal_anim">{{ __('app.fisheries_benefits') }}</p>
          <h2 class="scale_anim text-neutral-0 mb-9 xl:mb-12">{{ __('app.why_choose_us') }}</h2>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:gap-6">
            <div class="rounded-3xl bg-neutral-0 p-4 md:p-6 relative after:w-full after:h-[200px] after:absolute after:left-0 after:-top-[65%] after:bg-primary-300 after:rounded-b-[45%] overflow-hidden">
              <img src="{{ asset('assets/images/home-1/benefit-el-1.png') }}" class="absolute left-5 top-20" alt="" />
              <img src="{{ asset('assets/images/home-1/benefit-el-2.png') }}" class="absolute right-10 top-12" alt="" />
              <div class="flex flex-col items-center relative z-[1] text-center">
                <div class="size-[72px] f-center bg-neutral-0 rounded-full shadow-lg mb-4 xl:mb-6">
                  <img src="{{ asset('assets/images/home-1/benefit-icon-1.png') }}" alt="" />
                </div>
                <h5 class="mb-2">{{ __('app.quality_organic_shrimp') }}</h5>
                <p class="text-[13px]">{{ __('app.quality_organic_shrimp_desc') }}</p>
              </div>
            </div>
            <div class="rounded-3xl bg-neutral-0 p-4 md:p-6 relative after:w-full after:h-[200px] after:absolute after:left-0 after:-top-[65%] after:bg-primary-300 after:rounded-b-[45%] overflow-hidden">
              <img src="{{ asset('assets/images/home-1/benefit-el-1.png') }}" class="absolute left-5 top-20" alt="" />
              <img src="{{ asset('assets/images/home-1/benefit-el-2.png') }}" class="absolute right-10 top-12" alt="" />
              <div class="flex flex-col items-center relative z-[1] text-center">
                <div class="size-[72px] f-center bg-neutral-0 rounded-full shadow-lg mb-4 xl:mb-6">
                  <img src="{{ asset('assets/images/home-1/benefit-icon-2.png') }}" alt="" />
                </div>
                <h5 class="mb-2">{{ __('app.satisfaction_100') }}</h5>
                <p class="text-[13px]">{{ __('app.satisfaction_100_desc') }}</p>
              </div>
            </div>
            <div class="rounded-3xl bg-neutral-0 p-4 md:p-6 relative after:w-full after:h-[200px] after:absolute after:left-0 after:-top-[65%] after:bg-primary-300 after:rounded-b-[45%] overflow-hidden">
              <img src="{{ asset('assets/images/home-1/benefit-el-1.png') }}" class="absolute left-5 top-20" alt="" />
              <img src="{{ asset('assets/images/home-1/benefit-el-2.png') }}" class="absolute right-10 top-12" alt="" />
              <div class="flex flex-col items-center relative z-[1] text-center">
                <div class="size-[72px] f-center bg-neutral-0 rounded-full shadow-lg mb-4 xl:mb-6">
                  <img src="{{ asset('assets/images/home-1/benefit-icon-3.png') }}" alt="" />
                </div>
                <h5 class="mb-2">{{ __('app.professional_staff') }}</h5>
                <p class="text-[13px]">{{ __('app.professional_staff_desc') }}</p>
              </div>
            </div>
            <div class="rounded-3xl bg-neutral-0 p-4 md:p-6 relative after:w-full after:h-[200px] after:absolute after:left-0 after:-top-[65%] after:bg-primary-300 after:rounded-b-[45%] overflow-hidden">
              <img src="{{ asset('assets/images/home-1/benefit-el-1.png') }}" class="absolute left-5 top-20" alt="" />
              <img src="{{ asset('assets/images/home-1/benefit-el-2.png') }}" class="absolute right-10 top-12" alt="" />
              <div class="flex flex-col items-center relative z-[1] text-center">
                <div class="size-[72px] f-center bg-neutral-0 rounded-full shadow-lg mb-4 xl:mb-6">
                  <img src="{{ asset('assets/images/home-1/benefit-icon-1.png') }}" alt="" />
                </div>
                <h5 class="mb-2">{{ __('app.quality_organic_fish') }}</h5>
                <p class="text-[13px]">{{ __('app.quality_organic_fish_desc') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Book Appointment section end -->

  
@endsection
