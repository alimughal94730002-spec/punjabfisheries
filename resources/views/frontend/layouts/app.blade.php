<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ur' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-eval' 'unsafe-inline' https://fonts.googleapis.com https://fonts.gstatic.com https://cdn.plyr.io https://unpkg.com https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.plyr.io https://unpkg.com https://cdn.jsdelivr.net; font-src 'self' data: https://fonts.gstatic.com https://fonts.googleapis.com; img-src 'self' data: blob: https: https://*.tile.openstreetmap.org; connect-src 'self' https://*.tile.openstreetmap.org https://unpkg.com; media-src 'self' https:; object-src 'none'; base-uri 'self'; form-action 'self';" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Department of Fisheries - Punjab')</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com/" />
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/css/swiper.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/glightbox.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
  <style>
    /* Urdu text rendering fixes for frontend only */
    [lang="ur"], .urdu-text {
        font-family: "Noto Sans Urdu", "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif;
        direction: rtl;
        text-align: right;
        word-spacing: normal;
        letter-spacing: normal;
        line-height: 1.6;
        font-feature-settings: "liga" 1, "calt" 1, "kern" 1;
        text-rendering: optimizeLegibility;
        -webkit-font-feature-settings: "liga" 1, "calt" 1, "kern" 1;
        -moz-font-feature-settings: "liga" 1, "calt" 1, "kern" 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    /* Fix for Urdu text in headings */
    h1[lang="ur"], h2[lang="ur"], h3[lang="ur"], h4[lang="ur"], h5[lang="ur"], h6[lang="ur"],
    h1.urdu-text, h2.urdu-text, h3.urdu-text, h4.urdu-text, h5.urdu-text, h6.urdu-text {
        font-family: "Noto Sans Urdu", "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif;
        font-feature-settings: "liga" 1, "calt" 1, "kern" 1;
        text-rendering: optimizeLegibility;
        -webkit-font-feature-settings: "liga" 1, "calt" 1, "kern" 1;
        -moz-font-feature-settings: "liga" 1, "calt" 1, "kern" 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        white-space: nowrap;
        word-break: keep-all;
        direction: rtl;
        text-align: right;
        word-spacing: normal;
        letter-spacing: normal;
        line-height: 1.4;
        unicode-bidi: bidi-override;
        padding: 4px 0;
        margin: 2px 0;
    }
    
    /* Specific fix for slider text to prevent character clipping */
    .swiper-slide h2 {
        padding: 6px 0 !important;
        margin: 3px 0 !important;
        line-height: 1.3 !important;
        font-family: "Noto Sans Urdu", "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
    }
    
    .swiper-slide p {
        padding: 3px 0 !important;
        margin: 2px 0 !important;
        line-height: 1.5 !important;
        font-family: "Noto Sans Urdu", "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
    }
    
    /* Fix for pagination dots positioning */
    .banner1-pagination {
        bottom: 3rem !important;
        padding: 10px 0 !important;
    }
    
    .banner1-pagination .swiper-pagination-bullet {
        margin: 0 6px !important;
        width: 14px !important;
        height: 14px !important;
    }
    
    /* RTL Layout fixes */
    [dir="rtl"] .grid {
        direction: rtl;
    }
    
    [dir="rtl"] .flex {
        direction: rtl;
    }
    
    /* Fix for process section text layout */
    .process-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .process-card .process-icon {
        margin-bottom: 1.5rem;
        flex-shrink: 0;
    }
    
    .process-card .process-content {
        width: 100%;
        text-align: center;
    }
    
    .process-card .process-content h4 {
        margin-bottom: 1rem;
        text-align: center;
        word-wrap: break-word;
        hyphens: auto;
    }
    
    .process-card .process-content p {
        text-align: center;
        line-height: 1.6;
        word-wrap: break-word;
        hyphens: auto;
        white-space: normal;
    }
    
    /* RTL specific fixes for process section */
    [dir="rtl"] .process-card .process-content h4,
    [dir="rtl"] .process-card .process-content p {
        text-align: center;
        direction: rtl;
        unicode-bidi: bidi-override;
    }
    
    /* Fix for process cards layout */
    .process-info-card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .process-info-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .process-info-text {
        flex-grow: 1;
    }
    
    .process-info-link {
        margin-top: auto;
        align-self: flex-start;
    }
    
    /* RTL fixes for process info cards */
    [dir="rtl"] .process-info-link {
        align-self: flex-end;
    }
    
    /* Fix for RTL navigation */
    [dir="rtl"] .menu {
        direction: rtl;
    }
    
    [dir="rtl"] .menu li {
        direction: rtl;
    }
    
    /* Fix for RTL content sections */
    [dir="rtl"] .cont {
        direction: rtl;
    }
    
    /* RTL Header Layout */
    [dir="rtl"] .flex-row-reverse {
        flex-direction: row-reverse;
    }
    
    /* Ensure proper ordering for RTL header */
    [dir="rtl"] .order-1 {
        order: 1;
    }
    
    [dir="rtl"] .order-2 {
        order: 2;
    }
    
    [dir="rtl"] .order-3 {
        order: 3;
    }
    
    /* RTL menu direction */
    [dir="rtl"] .menu {
        direction: rtl;
    }
    
    [dir="rtl"] .menu li {
        direction: rtl;
    }
    
    /* RTL dropdown adjustments */
    [dir="rtl"] .dropdown-menu {
        right: auto;
        left: 0;
        text-align: right;
    }
    
    /* Fix for banner text fragmentation */
    .banner-text, .hero-text, .slider-text {
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
        font-feature-settings: "liga" 1, "calt" 1 !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-feature-settings: "liga" 1, "calt" 1 !important;
        -moz-font-feature-settings: "liga" 1, "calt" 1 !important;
        white-space: normal !important;
        word-break: keep-all !important;
        direction: rtl !important;
        text-align: right !important;
    }
    
    /* Force proper Urdu rendering for all text elements */
    [lang="ur"] * {
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
        font-feature-settings: "liga" 1, "calt" 1 !important;
        text-rendering: optimizeLegibility !important;
        white-space: normal !important;
        word-break: keep-all !important;
        direction: rtl !important;
        text-align: right !important;
    }
    
    /* Specific fix for fragmented Urdu headings */
    h1[lang="ur"], h2[lang="ur"], h3[lang="ur"], h4[lang="ur"], h5[lang="ur"], h6[lang="ur"],
    .urdu-text, .urdu-text[lang="ur"] {
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
        font-feature-settings: "liga" 1, "calt" 1 !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-feature-settings: "liga" 1, "calt" 1 !important;
        -moz-font-feature-settings: "liga" 1, "calt" 1 !important;
        white-space: normal !important;
        word-break: keep-all !important;
        direction: rtl !important;
        text-align: right !important;
        letter-spacing: 0 !important;
        word-spacing: normal !important;
        line-height: 1.4 !important;
        font-weight: 700 !important;
    }
    
    /* Fix for paragraph text */
    p[lang="ur"], .urdu-text p {
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
        font-feature-settings: "liga" 1, "calt" 1 !important;
        text-rendering: optimizeLegibility !important;
        white-space: normal !important;
        word-break: keep-all !important;
        direction: rtl !important;
        text-align: right !important;
        letter-spacing: 0 !important;
        word-spacing: normal !important;
        line-height: 1.6 !important;
    }
    
    /* Fix for RTL grid columns */
    [dir="rtl"] .grid-cols-12 {
        direction: rtl;
    }
    
    /* Aggressive fix for all Urdu text elements */
    *[lang="ur"], *.urdu-text, [dir="rtl"] * {
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
        font-feature-settings: "liga" 1, "calt" 1 !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-feature-settings: "liga" 1, "calt" 1 !important;
        -moz-font-feature-settings: "liga" 1, "calt" 1 !important;
        letter-spacing: 0 !important;
        word-spacing: normal !important;
    }
    
    /* Fix for animated elements */
    .blur_anim[lang="ur"], .split_anim[lang="ur"], .reveal_anim[lang="ur"], .fade_anim[lang="ur"] {
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
        font-feature-settings: "liga" 1, "calt" 1 !important;
        text-rendering: optimizeLegibility !important;
        white-space: normal !important;
        word-break: keep-all !important;
        direction: rtl !important;
        text-align: right !important;
        letter-spacing: 0 !important;
        word-spacing: normal !important;
    }
    
    /* Force font loading and rendering */
    /* Remove incorrect @font-face; fonts are loaded via <link> from Google Fonts */
    
    /* Override any conflicting styles */
    [lang="ur"] h1, [lang="ur"] h2, [lang="ur"] h3, [lang="ur"] h4, [lang="ur"] h5, [lang="ur"] h6,
    .urdu-text h1, .urdu-text h2, .urdu-text h3, .urdu-text h4, .urdu-text h5, .urdu-text h6 {
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
        font-feature-settings: "liga" 1, "calt" 1 !important;
        text-rendering: optimizeLegibility !important;
        white-space: normal !important;
        word-break: keep-all !important;
        direction: rtl !important;
        text-align: right !important;
        letter-spacing: 0 !important;
        word-spacing: normal !important;
        transform: none !important;
        will-change: auto !important;
    }
    
    /* Fix for slider text elements */
    [dir="rtl"] .swiper-slide h2,
    [dir="rtl"] .swiper-slide p,
    [dir="rtl"] .swiper-slide .btn-secondary {
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
        font-feature-settings: "liga" 1, "calt" 1 !important;
        text-rendering: optimizeLegibility !important;
        white-space: normal !important;
        word-break: keep-all !important;
        direction: rtl !important;
        text-align: right !important;
        letter-spacing: 0 !important;
        word-spacing: normal !important;
    }
    
    /* Fix for slider paragraph text */
    [dir="rtl"] .swiper-slide p {
        white-space: normal !important;
        word-break: keep-all !important;
        line-height: 1.6 !important;
    }
    
    /* Fix for banner/slider text specifically */
    [dir="rtl"] .banner1Slider h2,
    [dir="rtl"] .banner1Slider p,
    [dir="rtl"] .banner1Slider .btn-secondary {
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
        font-feature-settings: "liga" 1, "calt" 1 !important;
        text-rendering: optimizeLegibility !important;
        letter-spacing: 0 !important;
        word-spacing: normal !important;
    }
    
    /* Fix for RTL flex items */
    [dir="rtl"] .flex {
        flex-direction: row-reverse;
    }
    
    /* Ultimate fix for all Urdu text when page is in RTL mode */
    [dir="rtl"] h1, [dir="rtl"] h2, [dir="rtl"] h3, [dir="rtl"] h4, [dir="rtl"] h5, [dir="rtl"] h6,
    [dir="rtl"] p, [dir="rtl"] span, [dir="rtl"] div, [dir="rtl"] a, [dir="rtl"] button {
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif !important;
        font-feature-settings: "liga" 1, "calt" 1 !important;
        text-rendering: optimizeLegibility !important;
        -webkit-font-feature-settings: "liga" 1, "calt" 1 !important;
        -moz-font-feature-settings: "liga" 1, "calt" 1 !important;
        letter-spacing: 0 !important;
        word-spacing: normal !important;
    }
    
    /* Specific fix for headings in RTL mode */
    [dir="rtl"] h1, [dir="rtl"] h2, [dir="rtl"] h3, [dir="rtl"] h4, [dir="rtl"] h5, [dir="rtl"] h6 {
        white-space: normal !important;
        word-break: keep-all !important;
        direction: rtl !important;
        text-align: right !important;
    }
    
    /* Specific fix for paragraphs in RTL mode */
    [dir="rtl"] p {
        white-space: normal !important;
        word-break: keep-all !important;
        direction: rtl !important;
        text-align: right !important;
        line-height: 1.6 !important;
    }
    
    /* Fix for RTL text alignment */
    [dir="rtl"] .text-left {
        text-align: right !important;
    }
    
    [dir="rtl"] .text-right {
        text-align: left !important;
    }
    
    /* Fix for RTL margins and padding */
    [dir="rtl"] .ml-auto {
        margin-left: auto;
        margin-right: 0;
    }
    
    [dir="rtl"] .mr-auto {
        margin-right: auto;
        margin-left: 0;
    }
    
    /* Fix for RTL positioning */
    [dir="rtl"] .left-8 {
        left: auto;
        right: 2rem;
    }
    
    [dir="rtl"] .right-4 {
        right: auto;
        left: 1rem;
    }
    
    /* Fix for RTL transforms */
    [dir="rtl"] .-translate-x-8 {
        transform: translateX(2rem);
    }
    
    [dir="rtl"] .-translate-x-14 {
        transform: translateX(3.5rem);
    }
    
    [dir="rtl"] .-translate-x-28 {
        transform: translateX(7rem);
    }
    
    /* Fix for RTL slider content */
    [dir="rtl"] .swiper-slide .flex {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    [dir="rtl"] .swiper-slide .text-center {
        text-align: center !important;
    }
    
    [dir="rtl"] .swiper-slide .mx-auto {
        margin-left: auto !important;
        margin-right: auto !important;
    }
    
    /* Fix for RTL slider positioning */
    [dir="rtl"] .swiper-slide {
        direction: ltr;
    }
    
    [dir="rtl"] .swiper-slide .flex.flex-col {
        direction: ltr;
    }
    
    /* Fix for RTL slider text alignment */
    [dir="rtl"] .swiper-slide h2,
    [dir="rtl"] .swiper-slide p {
        text-align: center !important;
        direction: ltr;
    }
    
    /* Fix for RTL layout - prevent content shifting */
    [dir="rtl"] .container {
        direction: rtl;
        text-align: right;
    }
    
    [dir="rtl"] .container .row {
        direction: rtl;
    }
    
    [dir="rtl"] .container .col {
        direction: rtl;
    }
    
    /* Fix for RTL main content area */
    [dir="rtl"] .main-content {
        direction: rtl;
        text-align: right;
    }
    
    /* Fix for RTL sections */
    [dir="rtl"] section {
        direction: rtl;
    }
    
    /* Fix for RTL cards and content blocks */
    [dir="rtl"] .card {
        direction: rtl;
        text-align: right;
    }
    
    [dir="rtl"] .card-body {
        direction: rtl;
        text-align: right;
    }
    
    /* Fix for RTL headings - prevent word separation */
    [dir="rtl"] h1, [dir="rtl"] h2, [dir="rtl"] h3, 
    [dir="rtl"] h4, [dir="rtl"] h5, [dir="rtl"] h6 {
        direction: rtl;
        text-align: right;
        word-spacing: normal;
        letter-spacing: normal;
        unicode-bidi: normal;
        font-family: "Noto Sans Arabic", "Segoe UI", "Tahoma", "Arial", sans-serif;
        white-space: normal;
        word-break: keep-all;
    }
    
    /* Fix for RTL paragraphs */
    [dir="rtl"] p {
        direction: rtl;
        text-align: right;
        word-spacing: normal;
        letter-spacing: normal;
        white-space: normal;
        word-break: keep-all;
    }
    
    /* Fix for RTL lists */
    [dir="rtl"] ul, [dir="rtl"] ol {
        direction: rtl;
        text-align: right;
        white-space: normal;
        word-break: keep-all;
    }
    
    [dir="rtl"] li {
        direction: rtl;
        text-align: right;
        white-space: normal;
        word-break: keep-all;
    }
    
    /* Fix for RTL buttons */
    [dir="rtl"] .btn {
        direction: rtl;
        text-align: center;
        white-space: normal;
        word-break: keep-all;
    }
    
    /* Fix for RTL forms */
    [dir="rtl"] .form-control {
        direction: rtl;
        text-align: right;
        white-space: normal;
        word-break: keep-all;
    }
    
    [dir="rtl"] .form-label {
        direction: rtl;
        text-align: right;
        white-space: normal;
        word-break: keep-all;
    }
    
    /* Fix for RTL navigation */
    [dir="rtl"] .navbar-nav {
        direction: rtl;
        white-space: normal;
        word-break: keep-all;
    }
    
    [dir="rtl"] .navbar-nav .nav-link {
        direction: rtl;
        text-align: right;
        white-space: normal;
        word-break: keep-all;
    }
    
    /* Fix for RTL footer */
    [dir="rtl"] .footer {
        direction: rtl;
        text-align: right;
        white-space: normal;
        word-break: keep-all;
    }
    
    /* Fix for RTL grid system */
    [dir="rtl"] .row {
        direction: rtl;
        white-space: normal;
        word-break: keep-all;
    }
    
    [dir="rtl"] .col-1, [dir="rtl"] .col-2, [dir="rtl"] .col-3, 
    [dir="rtl"] .col-4, [dir="rtl"] .col-5, [dir="rtl"] .col-6,
    [dir="rtl"] .col-7, [dir="rtl"] .col-8, [dir="rtl"] .col-9,
    [dir="rtl"] .col-10, [dir="rtl"] .col-11, [dir="rtl"] .col-12 {
        direction: rtl;
        text-align: right;
        white-space: normal;
        word-break: keep-all;
    }
  </style>
  @stack('styles')
  <script defer src="{{ asset('assets/js/app.min.js') }}"></script>
  @stack('head')
</head>
<body>
  {{-- Loader --}}
  <div class="screen_loader fixed inset-0 z-[101] grid place-content-center bg-neutral-0">
    <div class="w-10 h-10 border-4 border-t-primary-400 border-neutral-40 rounded-full animate-spin"></div>
  </div>

  {{-- Conditional Header - Different header for homepage vs other pages --}}
  @if(request()->is('/'))
    {{-- Homepage Header (from index.blade.php) --}}
    @include('frontend.layouts.homepage-header')
  @else
    {{-- Regular Header for other pages --}}
    @include('frontend.layouts.header')
  @endif

  {{-- Support both @extends and component approaches --}}
  @hasSection('content')
    @yield('content')
  @else
    {{ $slot }}
  @endif

  @include('frontend.layouts.footer')

  @stack('scripts')
  
  <!-- Alpine.js for interactive components -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>

