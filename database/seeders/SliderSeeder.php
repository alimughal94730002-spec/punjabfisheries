<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing sliders
        Slider::truncate();

        // Create sample sliders
        Slider::create([
            'title' => 'app.slider_title',
            'subtitle' => 'app.slider_subtitle',
            'description' => 'app.slider_description',
            'button_text' => 'app.slider_button',
            'button_url' => '#',
            'image_path' => 'sliders/banner-1.webp',
            'order' => 1,
            'is_active' => true,
            'background_color' => '#000000',
            'text_color' => '#ffffff',
            'overlay_opacity' => 0.5,
        ]);

        Slider::create([
            'title' => 'app.slider_aqua_title',
            'subtitle' => 'app.slider_aqua_subtitle',
            'description' => 'app.slider_aqua_description',
            'button_text' => 'app.slider_aqua_button',
            'button_url' => '/about',
            'image_path' => 'sliders/banner-2.webp',
            'order' => 2,
            'is_active' => true,
            'background_color' => '#1a365d',
            'text_color' => '#ffffff',
            'overlay_opacity' => 0.6,
        ]);

        Slider::create([
            'title' => 'app.slider_water_title',
            'subtitle' => 'app.slider_water_subtitle',
            'description' => 'app.slider_water_description',
            'button_text' => 'app.slider_water_button',
            'button_url' => '/services',
            'image_path' => 'sliders/banner-3.webp',
            'order' => 3,
            'is_active' => true,
            'background_color' => '#2d3748',
            'text_color' => '#ffffff',
            'overlay_opacity' => 0.7,
        ]);

        $this->command->info('Sample sliders created successfully!');
    }
}
