<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $category = \App\Models\EventCategory::first() ?: \App\Models\EventCategory::create(['name' => 'General', 'slug' => 'general', 'status' => true]);

        $events = [
            [
                'title' => 'Anand Samaroh 2025',
                'slug' => 'anand-samaroh-2025',
                'content' => "It is with immense joy and profound gratitude that we gather on this auspicious occasion for the grand inauguration ceremony of “Anand Sarovar,” the newly constructed Brahma Kumaris building in Durg.",
                'event_date' => '2025-08-19',
                'location' => 'Durg, Chhattisgarh',
                'event_category_id' => $category->id,
                'author' => 'Ajay Jaiswal',
                'is_active' => true,
            ],
            [
                'title' => 'Srijan Sarv Samaj Samuhik Vivah',
                'slug' => 'srijan-sarv-samaj-samuhik-vivah',
                'content' => "With the blessings of Shri Balaji Maharaj, we are organizing a mass wedding ceremony for 108 couples. Registration is now open for needy couples.",
                'event_date' => '2025-11-21',
                'location' => 'Salasar Dham, Rajasthan',
                'event_category_id' => $category->id,
                'author' => 'Admin',
                'is_active' => true,
            ],
        ];

        // Ensure directories exist
        if (!file_exists(public_path('events/thumbnails'))) mkdir(public_path('events/thumbnails'), 0777, true);
        if (!file_exists(public_path('events/banners'))) mkdir(public_path('events/banners'), 0777, true);
        if (!file_exists(public_path('events/gallery'))) mkdir(public_path('events/gallery'), 0777, true);

        foreach ($events as $index => $eventData) {
            $event = Event::updateOrCreate(['slug' => $eventData['slug']], $eventData);

            // Download thumb and banner
            $thumbPath = 'events/thumbnails/thumb_' . $event->id . '.jpg';
            $bannerPath = 'events/banners/banner_' . $event->id . '.jpg';

            @file_put_contents(public_path($thumbPath), file_get_contents("https://picsum.photos/400/300?random=" . ($index * 10)));
            @file_put_contents(public_path($bannerPath), file_get_contents("https://picsum.photos/1600/600?random=" . ($index * 20)));

            $event->update([
                'thumbnail' => $thumbPath,
                'banner' => $bannerPath
            ]);

            // Add gallery images
            $event->images()->delete(); // Clear old ones if any
            for ($i = 1; $i <= 5; $i++) {
                $galleryPath = 'events/gallery/gallery_' . $event->id . '_' . $i . '.jpg';
                @file_put_contents(public_path($galleryPath), file_get_contents("https://picsum.photos/800/600?random=" . ($index * 100 + $i)));
                $event->images()->create(['image_path' => $galleryPath]);
            }
        }
    }
}
