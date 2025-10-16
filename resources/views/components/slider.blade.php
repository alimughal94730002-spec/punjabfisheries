{{-- Slider Component - Displays dynamic sliders from database --}}
@props(['sliders' => collect()])

<section class="relative overflow-x-hidden">
    <div class="swiper banner1Slider relative">
        <div class="swiper-wrapper">
            @forelse($sliders as $slider)
                <div class="swiper-slide">
                    <div class="relative after:size-full after:bg-gradient-to-b after:from-black after:to-transparent after:absolute after:inset-0 bg-no-repeat bg-cover py-40 px-3 md:py-56 xl:py-[290px] text-center bg-center" 
                         data-bg="{{ $slider->slider_image_url }}"
                         @if($slider->background_color)
                             style="background-color: {{ $slider->background_color }};"
                         @endif>
                        <div class="flex flex-col items-center relative z-[1]">
                            @if($slider->subtitle)
                                <p class="font-medium text-lg text-secondary mb-2 reveal_anim" 
                                   @if($slider->text_color)
                                       style="color: {{ $slider->text_color }};"
                                   @endif>
                                    {{ $slider->getTranslatedSubtitle() }}
                                </p>
                            @endif
                            
                            @if($slider->title)
                                <h2 class="reveal_anim text-4xl uppercase font-playfair font-bold md:text-6xl lg:text-7xl xl:text-9xl xxl:text-[140px] text-neutral-0 mb-6"
                                    @if($slider->text_color)
                                        style="color: {{ $slider->text_color }};"
                                    @endif>
                                    {{ $slider->getTranslatedTitle() }}
                                </h2>
                            @endif
                            
                            @if($slider->description)
                                <p data-delay=".3" class="reveal_anim max-w-[630px] mx-auto font-medium mb-7 xl:mb-10 text-neutral-0"
                                   @if($slider->text_color)
                                       style="color: {{ $slider->text_color }};"
                                   @endif>
                                    {{ $slider->getTranslatedDescription() }}
                                </p>
                            @endif
                            
                            @if($slider->button_text && $slider->button_url)
                                <div class="fade_anim">
                                    <a href="{{ $slider->button_url }}" class="btn-secondary">
                                        {{ $slider->getTranslatedButtonText() }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                {{-- Default slider if no sliders are configured --}}
                <div class="swiper-slide">
                    <div class="relative after:size-full after:bg-gradient-to-b after:from-black after:to-transparent after:absolute after:inset-0 bg-no-repeat bg-cover py-40 px-3 md:py-56 xl:py-[290px] text-center bg-center" 
                         data-bg="{{ asset('assets/images/home-1/banner-1.webp') }}">
                        <div class="flex flex-col items-center relative z-[1]">
                            <p class="font-medium text-lg text-secondary mb-2 reveal_anim">
                                {{ __('app.slider_subtitle') }}
                            </p>
                            <h2 class="reveal_anim text-4xl uppercase font-playfair font-bold md:text-6xl lg:text-7xl xl:text-9xl xxl:text-[140px] text-neutral-0 mb-6">
                                {{ __('app.slider_title') }}
                            </h2>
                            <p data-delay=".3" class="reveal_anim max-w-[630px] mx-auto font-medium mb-7 xl:mb-10 text-neutral-0">
                                {{ __('app.slider_description') }}
                            </p>
                            <div class="fade_anim">
                                <a href="#" class="btn-secondary">
                                    {{ __('app.slider_button') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="banner1-pagination flex justify-center z-[2] absolute !bottom-8 xl:!bottom-14"></div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wait for Swiper to be available
    function initBannerSlider() {
        const bannerSlider = document.querySelector('.banner1Slider');
        if (!bannerSlider) {
            return;
        }
        
        // Try to access Swiper from different possible locations
        let SwiperClass = null;
        
        if (typeof Swiper !== 'undefined') {
            SwiperClass = Swiper;
        } else if (typeof window.Swiper !== 'undefined') {
            SwiperClass = window.Swiper;
        } else if (typeof globalThis.Swiper !== 'undefined') {
            SwiperClass = globalThis.Swiper;
        }
        
        if (SwiperClass) {
            try {
                // Check if page is in RTL mode
                const isRTL = document.documentElement.dir === 'rtl' || document.documentElement.lang === 'ur';
                
                // Count slides to determine if loop should be enabled
                const slides = bannerSlider.querySelectorAll('.swiper-slide');
                const shouldLoop = slides.length > 1;
                
                new SwiperClass(bannerSlider, {
                    loop: shouldLoop,
                    autoplay: shouldLoop ? {
                        delay: 5000,
                        disableOnInteraction: false,
                    } : false,
                    pagination: {
                        el: '.banner1-pagination',
                        clickable: true,
                    },
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
                    // Handle RTL direction
                    dir: isRTL ? 'rtl' : 'ltr',
                    on: {
                        init: function() {
                            // Silent initialization
                        }
                    }
                });
            } catch (error) {
                // Silent error handling
            }
        } else {
            // Try again after a short delay, but limit attempts
            setTimeout(function() {
                if (typeof Swiper !== 'undefined' || typeof window.Swiper !== 'undefined') {
                    initBannerSlider();
                }
            }, 2000);
        }
    }
    
    // Initialize after a short delay to ensure all scripts are loaded
    setTimeout(initBannerSlider, 500);
});
</script>
@endpush
