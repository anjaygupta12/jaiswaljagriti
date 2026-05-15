<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Magazine;
use Illuminate\Support\Str;

class MagazineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $magazines = [
            [
                'title' => 'Jaiswal Jagriti Oct To March 2024',
                'slug' => Str::slug('Jaiswal Jagriti Oct To March 2024'),
                'magazine_date' => '2024-03-01',
                'thumbnail' => 'uploads/magazines/thumbnails/mag_thumb_demo.jpeg',
                'pdf_file' => 'uploads/magazines/pdfs/mag_demo.pdf',
                'is_active' => true,
            ],
            [
                'title' => 'Jaiswal Jagriti July To Sept 2023',
                'slug' => Str::slug('Jaiswal Jagriti July To Sept 2023'),
                'magazine_date' => '2023-09-01',
                'thumbnail' => 'uploads/magazines/thumbnails/mag_thumb_demo.jpeg',
                'pdf_file' => 'uploads/magazines/pdfs/mag_demo.pdf',
                'is_active' => true,
            ],
            [
                'title' => 'Jaiswal Jagriti Apr To June 2023',
                'slug' => Str::slug('Jaiswal Jagriti Apr To June 2023'),
                'magazine_date' => '2023-06-01',
                'thumbnail' => 'uploads/magazines/thumbnails/mag_thumb_demo.jpeg',
                'pdf_file' => 'uploads/magazines/pdfs/mag_demo.pdf',
                'is_active' => true,
            ],
            [
                'title' => 'Jaiswal Jagriti Jan To March 2023',
                'slug' => Str::slug('Jaiswal Jagriti Jan To March 2023'),
                'magazine_date' => '2023-03-01',
                'thumbnail' => 'uploads/magazines/thumbnails/mag_thumb_demo.jpeg',
                'pdf_file' => 'uploads/magazines/pdfs/mag_demo.pdf',
                'is_active' => true,
            ],
            [
                'title' => 'Jaiswal Jagriti Oct To Dec 2022',
                'slug' => Str::slug('Jaiswal Jagriti Oct To Dec 2022'),
                'magazine_date' => '2022-12-01',
                'thumbnail' => 'uploads/magazines/thumbnails/mag_thumb_demo.jpeg',
                'pdf_file' => 'uploads/magazines/pdfs/mag_demo.pdf',
                'is_active' => true,
            ],
            [
                'title' => 'Anand Samaroh Special Edition',
                'slug' => Str::slug('Anand Samaroh Special Edition'),
                'magazine_date' => '2024-01-01',
                'thumbnail' => 'uploads/magazines/thumbnails/mag_thumb_demo.jpeg',
                'pdf_file' => 'uploads/magazines/pdfs/mag_demo.pdf',
                'is_active' => true,
            ],
        ];

        foreach ($magazines as $mag) {
            Magazine::create($mag);
        }
    }
}
