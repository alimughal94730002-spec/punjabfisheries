<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;

class Slider extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'button_text',
        'button_url',
        'order',
        'is_active',
        'background_color',
        'text_color',
        'overlay_opacity',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'overlay_opacity' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }


    /**
     * Media collections for slider images
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('slider_image')
            ->useDisk('public')
            ->acceptsMimeTypes(['image/jpeg','image/png','image/webp'])
            ->withResponsiveImages()
            ->singleFile()
            ->useFallbackUrl(url('/assets/images/home-1/banner-1.webp'))
            ->useFallbackPath(public_path('/assets/images/home-1/banner-1.webp'));
    }

    /**
     * Media conversions for slider images
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        // Slider image conversions
        $this
            ->addMediaConversion('slider_thumb')
            ->fit(Fit::Crop, 400, 300)
            ->format('webp')
            ->withResponsiveImages()
            ->performOnCollections('slider_image')
            ->nonQueued();

        $this
            ->addMediaConversion('slider_web')
            ->fit(Fit::Max, 1920, 800)
            ->format('webp')
            ->withResponsiveImages()
            ->performOnCollections('slider_image')
            ->nonQueued();

        $this
            ->addMediaConversion('slider_mobile')
            ->fit(Fit::Max, 768, 400)
            ->format('webp')
            ->withResponsiveImages()
            ->performOnCollections('slider_image')
            ->nonQueued();
    }

    /**
     * Get slider image URL using media library
     */
    public function getSliderImageUrlAttribute()
    {
        $media = $this->getFirstMedia('slider_image');
        return $media ? $media->getUrl() : asset('assets/images/home-1/banner-1.webp');
    }

    /**
     * Get translated title based on current locale
     */
    public function getTranslatedTitle()
    {
        $currentLocale = app()->getLocale();
        
        // If title is already a translation key, translate it
        if (str_starts_with($this->title, 'app.')) {
            return __($this->title);
        }
        
        // Map English titles to translation keys
        $titleMap = [
            'AQUA HARVEST' => 'slider_aqua_title',
            'Aqua Harvest' => 'slider_aqua_title',
            'FRESH FISHERIES' => 'slider_fresh_title',
            'Fresh Fisheries' => 'slider_fresh_title',
            'CLEAR WATERS' => 'slider_water_title',
            'Clear Waters' => 'slider_water_title',
            'CLEAN WATER' => 'slider_water_title',
            'Clean Water' => 'slider_water_title',
            'FISHING MAKES ME CRAZY' => 'slider_title',
            'Fishing Makes Me Crazy' => 'slider_title',
            'تازہ فشریز' => 'slider_title',
        ];
        
        if (isset($titleMap[$this->title])) {
            return __('app.' . $titleMap[$this->title]);
        }
        
        return $this->title;
    }

    /**
     * Get translated subtitle based on current locale
     */
    public function getTranslatedSubtitle()
    {
        $currentLocale = app()->getLocale();
        
        // If subtitle is already a translation key, translate it
        if (str_starts_with($this->subtitle, 'app.')) {
            return __($this->subtitle);
        }
        
        // Map English subtitles to translation keys
        $subtitleMap = [
            'SUSTAINABLE AQUACULTURE' => 'slider_aqua_subtitle',
            'Sustainable Aquaculture' => 'slider_aqua_subtitle',
            'QUALITY ASSURANCE' => 'slider_fresh_subtitle',
            'Quality Assurance' => 'slider_fresh_subtitle',
            'QUALITY ASSURANCE' => 'slider_water_subtitle',
            'Quality Assurance' => 'slider_water_subtitle',
            'پائیدار ایکواکلچر' => 'slider_aqua_subtitle',
            'معیار کی ضمانت' => 'slider_fresh_subtitle',
        ];
        
        if (isset($subtitleMap[$this->subtitle])) {
            return __('app.' . $subtitleMap[$this->subtitle]);
        }
        
        return $this->subtitle;
    }

    /**
     * Get translated description based on current locale
     */
    public function getTranslatedDescription()
    {
        $currentLocale = app()->getLocale();
        
        // If description is already a translation key, translate it
        if (str_starts_with($this->description, 'app.')) {
            return __($this->description);
        }
        
        // Map English descriptions to translation keys
        $descriptionMap = [
            'Guiding you through sustainable aquaculture practices with cutting-edge technology and environmental conservation.' => 'slider_aqua_description',
            'Fresh Fisheries delivers premium, sustainable seafood through innovative aqua farming and expert fishery services.' => 'slider_fresh_description',
            'Maintaining the highest standards in water quality and fish health for superior aquaculture products.' => 'slider_water_description',
            'Maintaining the highest standards of water quality and fish health for premium aquaculture products.' => 'slider_water_description',
            'Leading the way in sustainable aquaculture practices with cutting-edge technology and environmental stewardship.' => 'slider_aqua_description',
            'تازہ فشریز جدید ایکوا فارمنگ اور ماہر فشری سروسز کے ذریعے پریمیم، پائیدار سمندری غذا فراہم کرتی ہے۔' => 'slider_description',
            'اعلیٰ ایکواکلچر مصنوعات کے لیے پانی کے معیار اور مچھلی کی صحت کے اعلیٰ ترین معیارات کو برقرار رکھنا۔' => 'slider_water_description',
        ];
        
        if (isset($descriptionMap[$this->description])) {
            return __('app.' . $descriptionMap[$this->description]);
        }
        
        return $this->description;
    }

    /**
     * Get translated button text based on current locale
     */
    public function getTranslatedButtonText()
    {
        $currentLocale = app()->getLocale();
        
        // If button text is already a translation key, translate it
        if (str_starts_with($this->button_text, 'app.') || str_starts_with($this->button_text, 'App.')) {
            return __($this->button_text);
        }
        
        // Map English button texts to translation keys
        $buttonMap = [
            'Get A Quote' => 'slider_aqua_button',
            'Learn More' => 'slider_fresh_button',
            'Our Services' => 'slider_water_button',
            'Get a Quote' => 'slider_aqua_button',
            'اقتباس حاصل کریں' => 'slider_button',
            'مزید سیکھیں' => 'slider_fresh_button',
            'ہماری خدمات' => 'slider_water_button',
        ];
        
        if (isset($buttonMap[$this->button_text])) {
            return __('app.' . $buttonMap[$this->button_text]);
        }
        
        return $this->button_text;
    }
}
