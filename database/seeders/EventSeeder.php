<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Anand Samaroh 2025',
                'slug' => 'anand-samaroh-2025',
                'content' => "Respected dignitaries, esteemed guests, dear brothers and sisters of the Brahma Kumaris family...\n\nIt is with immense joy and profound gratitude that we gather on this auspicious occasion for the grand inauguration ceremony of “Anand Sarovar,” the newly constructed Brahma Kumaris building in Durg.",
                'event_date' => '2025-08-19',
                'location' => 'Durg, Chhattisgarh',
                'thumbnail' => 'uploads/events/thumbnails/thumb_demo.jpg',
                'banner' => 'uploads/events/banners/banner_demo.jpg',
                'author' => 'Ajay Jaiswal',
                'category' => 'Spiritual Event',
                'is_active' => true,
            ],
            [
                'title' => 'Srijan Sarv Samaj Samuhik Vivah',
                'slug' => 'srijan-sarv-samaj-samuhik-vivah',
                'content' => "With the blessings of Shri Balaji Maharaj, we are organizing a mass wedding ceremony for 108 couples...\n\nRegistration is now open for needy couples. All basic household items will be provided as gifts.",
                'event_date' => '2025-11-21',
                'location' => 'Salasar Dham, Rajasthan',
                'thumbnail' => 'uploads/events/thumbnails/thumb_demo.jpg',
                'banner' => 'uploads/events/banners/banner_demo.jpg',
                'author' => 'Admin',
                'category' => 'Upcoming Event',
                'is_active' => true,
            ],
            [
                'title' => 'Dikshant Samaroh 2024',
                'slug' => 'dikshant-samaroh-2024',
                'content' => "The Institute of Health Sciences celebrated the convocation ceremony for BASLP and BPT students...\n\nA proud moment for all graduates and faculty members.",
                'event_date' => '2024-05-15',
                'location' => 'Bhubaneswar, Odisha',
                'thumbnail' => 'uploads/events/thumbnails/thumb_demo.jpg',
                'banner' => 'uploads/events/banners/banner_demo.jpg',
                'author' => 'Admin',
                'category' => 'Upcoming Event',
                'is_active' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(['slug' => $event['slug']], $event);
        }
    }
}
