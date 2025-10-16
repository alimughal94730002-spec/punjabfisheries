<div class="relative" x-data="{ open: false }">
  <!-- Clean Language Switcher Button -->
  <button 
    @click="open = !open" 
    class="flex items-center gap-2 px-3 py-2 rounded-lg transition-all duration-200 {{ request()->is('/') ? 'bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-white/20 text-white !text-white' : 'bg-neutral-100 border border-neutral-200 hover:bg-neutral-200 text-neutral-700 !text-neutral-700' }}"
    style="color: {{ request()->is('/') ? 'white !important' : '#374151 !important' }};"
    aria-label="Language Switcher"
  >
    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256">
      <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216ZM128,72a8,8,0,0,1,8,8v8a8,8,0,0,1-16,0V80A8,8,0,0,1,128,72Zm0,32a8,8,0,0,1,8,8v48a8,8,0,0,1-16,0V112A8,8,0,0,1,128,104Zm0,80a12,12,0,1,1,12-12A12,12,0,0,1,128,184Z"></path>
    </svg>
    <span class="text-sm font-medium">{{ app()->getLocale() === 'ur' ? 'اردو' : 'English' }}</span>
    <svg xmlns="http://www.w3.org/2000/svg" class="size-3 transition-transform duration-200" :class="{'rotate-180': open}" fill="currentColor" viewBox="0 0 256 256">
      <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
    </svg>
  </button>
  
  <!-- Professional Dropdown Menu -->
  <div 
    x-show="open" 
    @click.away="open = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="absolute top-full right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-neutral-200 z-50 overflow-hidden"
    style="display: none;"
  >
    <div class="py-2">
      <a 
        href="{{ route('locale.get', ['locale' => 'en']) }}" 
        @click.prevent="setLocale('en'); open = false;"
        class="flex items-center gap-3 px-4 py-3 text-sm hover:bg-primary-50 transition-colors duration-200 {{ app()->getLocale() === 'en' ? 'bg-primary-50 text-primary-600 border-r-2 border-primary-600' : 'text-neutral-700' }}"
      >
        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-blue-500 to-red-500 flex items-center justify-center text-white text-xs font-bold">EN</div>
        <span class="font-medium">{{ __('app.english') }}</span>
        @if(app()->getLocale() === 'en')
          <svg xmlns="http://www.w3.org/2000/svg" class="size-4 ml-auto text-primary-600" fill="currentColor" viewBox="0 0 256 256">
            <path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path>
          </svg>
        @endif
      </a>
      <a 
        href="{{ route('locale.get', ['locale' => 'ur']) }}" 
        @click.prevent="setLocale('ur'); open = false;"
        class="flex items-center gap-3 px-4 py-3 text-sm hover:bg-primary-50 transition-colors duration-200 {{ app()->getLocale() === 'ur' ? 'bg-primary-50 text-primary-600 border-r-2 border-primary-600' : 'text-neutral-700' }}"
      >
        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-green-500 to-white flex items-center justify-center text-green-600 text-xs font-bold">اردو</div>
        <span class="font-medium">{{ __('app.urdu') }}</span>
        @if(app()->getLocale() === 'ur')
          <svg xmlns="http://www.w3.org/2000/svg" class="size-4 ml-auto text-primary-600" fill="currentColor" viewBox="0 0 256 256">
            <path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path>
          </svg>
        @endif
      </a>
    </div>
  </div>

  @once
    @push('scripts')
      <script>
        function setLocale(locale) {
          fetch('/locale', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ locale: locale })
          })
          .then(response => response.json())
          .then(data => {
            if (data.ok) {
              // Optional: toast
              try {
                const msg = document.createElement('div');
                msg.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
                msg.textContent = '{{ __("app.language_changed") }}';
                document.body.appendChild(msg);
                setTimeout(() => msg.remove(), 2000);
              } catch (e) {}
              // Reload to apply locale
              window.location.reload();
            }
          })
          .catch(err => console.error('Locale change failed', err));
        }

        // Fallback for when Alpine.js is not loaded
        document.addEventListener('DOMContentLoaded', function() {
          setTimeout(function() {
            if (typeof Alpine === 'undefined') {
              // Show fallback version
              const fallback = document.querySelector('.alpine-fallback');
              if (fallback) {
                fallback.style.display = 'block';
                // Hide the Alpine.js version
                const alpineVersion = fallback.parentElement.querySelector('[x-data]');
                if (alpineVersion) {
                  alpineVersion.style.display = 'none';
                }
              }
            }
          }, 1000);
        });
      </script>
    @endpush
  @endonce
  <!-- Fallback for when Alpine.js is not loaded -->
  <div class="alpine-fallback" style="display: none;">
    <div class="flex items-center gap-2">
      <a class="text-sm px-2 py-1 rounded {{ app()->getLocale() === 'en' ? 'bg-primary-600 text-white' : (request()->is('/') ? 'text-white hover:bg-white/20' : 'text-neutral-700 hover:bg-neutral-200') }}" style="color: {{ request()->is('/') ? 'white !important' : '#374151 !important' }};" href="{{ route('locale.get', ['locale' => 'en']) }}">EN</a>
      <a class="text-sm px-2 py-1 rounded {{ app()->getLocale() === 'ur' ? 'bg-primary-600 text-white' : (request()->is('/') ? 'text-white hover:bg-white/20' : 'text-neutral-700 hover:bg-neutral-200') }}" style="color: {{ request()->is('/') ? 'white !important' : '#374151 !important' }};" href="{{ route('locale.get', ['locale' => 'ur']) }}">اردو</a>
    </div>
  </div>

  <noscript>
    <div class="flex items-center gap-2">
      <a class="text-sm px-2 py-1 rounded {{ app()->getLocale() === 'en' ? 'bg-primary-600 text-white' : (request()->is('/') ? 'text-white hover:bg-white/20' : 'text-neutral-700 hover:bg-neutral-200') }}" style="color: {{ request()->is('/') ? 'white !important' : '#374151 !important' }};" href="{{ route('locale.get', ['locale' => 'en']) }}">EN</a>
      <a class="text-sm px-2 py-1 rounded {{ app()->getLocale() === 'ur' ? 'bg-primary-600 text-white' : (request()->is('/') ? 'text-white hover:bg-white/20' : 'text-neutral-700 hover:bg-neutral-200') }}" style="color: {{ request()->is('/') ? 'white !important' : '#374151 !important' }};" href="{{ route('locale.get', ['locale' => 'ur']) }}">اردو</a>
    </div>
  </noscript>
</div>
