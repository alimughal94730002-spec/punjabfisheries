<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShrimpSite;
use Illuminate\Support\Str;

class ShrimpSiteSeeder extends Seeder
{
    public function run(): void
    {
        $sites = [
            [
                'name' => 'Chashma',
                'district' => 'Bahawalpur',
                'tehsil' => 'Yazman',
                'area_acres' => 7800,
                'status' => 'Operational',
                'lat' => 29.12046,
                'lng' => 71.74540,
                'images' => [
                    'https://images.unsplash.com/photo-1558980664-10ab3f09f7be?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1544551763-7ef4200b2c34?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1610899232931-fd04dcb16f8a?q=80&w=800&auto=format&fit=crop',
                ],
                'description' => 'Shrimp farming cluster near Yazman.'
            ],
            [
                'name' => 'Kot Addu Ponds',
                'district' => 'Muzaffargarh',
                'tehsil' => 'Kot Addu',
                'area_acres' => 1200,
                'status' => 'Under Development',
                'lat' => 30.4693,
                'lng' => 70.9644,
                'images' => [
                    'https://images.unsplash.com/photo-1524503033411-c9566986fc8f?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1534088568595-a066f410bcda?q=80&w=800&auto=format&fit=crop',
                ],
                'description' => 'New ponds with salinity management and aeration.'
            ],
            [
                'name' => 'Faisalabad Pilot',
                'district' => 'Faisalabad',
                'tehsil' => 'Jaranwala',
                'area_acres' => 450,
                'status' => 'Operational',
                'lat' => 31.3349,
                'lng' => 73.4194,
                'images' => [
                    'https://images.unsplash.com/photo-1545464333-9ffc7f2f92f1?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1502082553048-f009c37129b9?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=800&auto=format&fit=crop',
                ],
                'description' => 'Pilot site with lined ponds and biosecurity.'
            ],
            [
                'name' => 'Kasur Aquaculture',
                'district' => 'Kasur',
                'tehsil' => 'Pattoki',
                'area_acres' => 900,
                'status' => 'Operational',
                'lat' => 31.0248,
                'lng' => 73.8476,
                'images' => [
                    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1518837695005-2083093ee35b?q=80&w=800&auto=format&fit=crop',
                ],
                'description' => 'Grow-out ponds supported by nursery units.'
            ],
            [
                'name' => 'Rahim Yar Khan Site',
                'district' => 'Rahim Yar Khan',
                'tehsil' => 'Sadiqabad',
                'area_acres' => 1500,
                'status' => 'Operational',
                'lat' => 28.3052,
                'lng' => 70.1302,
                'images' => [
                    'https://images.unsplash.com/photo-1496412705862-e0088f16f791?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1496384443184-2573c52f3ad0?q=80&w=800&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=800&auto=format&fit=crop',
                ],
                'description' => 'Large scale ponds with paddlewheel aerators.'
            ],
        ];

        foreach ($sites as $s) {
            ShrimpSite::updateOrCreate(
                ['slug' => Str::slug($s['name'])],
                array_merge($s, [
                    'slug' => Str::slug($s['name']).'-'.Str::random(5),
                    'is_active' => true,
                ])
            );
        }
    }
}
