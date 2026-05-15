<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobCategory;
use App\Models\JobListing;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Categories
        $categories = [
            'Government Jobs',
            'IT & Software',
            'Banking & Finance'
        ];

        foreach ($categories as $catName) {
            $category = JobCategory::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
                'status' => true
            ]);

            // 2. Create featured jobs for the top cards (only some categories)
            if ($catName === 'Government Jobs') {
                JobListing::create([
                    'job_category_id' => $category->id,
                    'title' => 'UP Police SI Recruitment 2025',
                    'link' => 'https://example.com/up-police',
                    'is_featured' => true,
                    'status' => true
                ]);
                JobListing::create([
                    'job_category_id' => $category->id,
                    'title' => 'BSF HC RO / RM Recruitment 2025',
                    'link' => 'https://example.com/bsf',
                    'is_featured' => true,
                    'status' => true
                ]);
            }

            if ($catName === 'Banking & Finance') {
                JobListing::create([
                    'job_category_id' => $category->id,
                    'title' => 'IBPS Clerk 15th Recruitment 2025',
                    'link' => 'https://example.com/ibps',
                    'is_featured' => true,
                    'status' => true
                ]);
                JobListing::create([
                    'job_category_id' => $category->id,
                    'title' => 'SBI Clerk Recruitment 2025',
                    'link' => 'https://example.com/sbi',
                    'is_featured' => true,
                    'status' => true
                ]);
            }

            // 3. Create regular job listings for each category
            if ($catName === 'Government Jobs') {
                $jobs = [
                    'MP ESB Middle and Primary Teacher Result 2025',
                    'UCO Bank SO Final Result 2025',
                    'AIIMS CRE Group B, C Result 2025',
                    'PFRDA Assistant Manager Phase-I Result 2025',
                    'BPSSC Bihar Police Enforcement SI Result'
                ];
            } elseif ($catName === 'IT & Software') {
                $jobs = [
                    'Laravel Developer Required',
                    'React JS Frontend Developer',
                    'Node JS API Developer',
                    'PHP Full Stack Developer',
                    'Vue JS Developer Hiring'
                ];
            } else {
                $jobs = [
                    'Bank PO Recruitment 2025',
                    'SBI Clerk Online Form',
                    'RBI Assistant Recruitment',
                    'Finance Executive Hiring',
                    'Insurance Advisor Vacancy'
                ];
            }

            foreach ($jobs as $jobTitle) {
                JobListing::create([
                    'job_category_id' => $category->id,
                    'title' => $jobTitle,
                    'link' => '#',
                    'is_featured' => false,
                    'status' => true
                ]);
            }
        }
    }
}
