<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WingMember;
use Illuminate\Support\Facades\File;

class WingMemberSeeder extends Seeder
{
    public function run()
    {
        // Delete existing records to avoid duplicates
        WingMember::truncate();

        $members = [
            // Executive Body
            [
                'name' => 'Manoj Kumar Shah',
                'designation' => 'Adhyaksh',
                'phone' => '9891237738',
                'email' => 'mkshah22@gmail.com',
                'source_file' => '1.png',
                'filename' => 'manoj_kumar_shah.png',
                'type' => 'executive-body',
                'sort_order' => 1,
            ],
            [
                'name' => 'Anil Kumar',
                'designation' => 'Jaiswal Mahasachiv',
                'phone' => '9868105658',
                'email' => 'anilkumar.css1962@gmail.com',
                'source_file' => 'WhatsApp-Image-2025-07-02-at-11.26.44_89648e85.jpg',
                'filename' => 'anil_kumar.jpg',
                'type' => 'executive-body',
                'sort_order' => 2,
            ],
            [
                'name' => 'Shankar Chaudhary',
                'designation' => 'Koshadhyaksh',
                'phone' => '9868039033 / 9910987056',
                'email' => 'shanker1230@yahoo.co.in',
                'source_file' => '2.png',
                'filename' => 'shankar_chaudhary.png',
                'type' => 'executive-body',
                'sort_order' => 3,
            ],

            // Youth Wing
            [
                'name' => 'Aditya Vardhanam',
                'designation' => 'Youth Wing Member',
                'phone' => '9818389050',
                'email' => 'aditya.buxar@gmail.com',
                'source_file' => 'J1.jpg',
                'filename' => 'aditya.jpg',
                'type' => 'youth-wing',
                'sort_order' => 1,
            ],
            [
                'name' => 'Ashish Jaiswal',
                'designation' => 'Youth Wing Member',
                'phone' => '9911677600',
                'email' => 'ash.jaiswal@gmail.com',
                'source_file' => 'J2.jpg',
                'filename' => 'ashish.jpg',
                'type' => 'youth-wing',
                'sort_order' => 2,
            ],
            [
                'name' => 'Ajay Jaiswal',
                'designation' => 'Youth Wing Member',
                'phone' => '9990372173',
                'email' => 'ajayjaiswal.india@gmail.com',
                'source_file' => 'JJ.jpg',
                'filename' => 'ajayjaiswal.jpg',
                'type' => 'youth-wing',
                'sort_order' => 3,
            ],

            // Women's Wing
            [
                'name' => 'Punam Choudhary',
                'designation' => 'Mahilla Manch - General Secratary',
                'phone' => '7042848089,9654328719',
                'email' => 'brightacademy01@gmail.com',
                'source_file' => 'poonam-chaudhary.jpg',
                'filename' => 'poonam_chaudhary.jpg',
                'type' => 'womens-wing',
                'sort_order' => 1,
            ],
            [
                'name' => 'MEENU GUPTA JAISWAL',
                'designation' => 'Mahilla Manch - Member',
                'phone' => '9891232016',
                'email' => 'amitkr_012002@yahoo.com',
                'source_file' => 'meenu-gupta.jpg',
                'filename' => 'meenu_gupta.jpg',
                'type' => 'womens-wing',
                'sort_order' => 2,
            ],
            [
                'name' => 'Divya Jaiswal',
                'designation' => 'Mahilla Manch - Member',
                'phone' => null,
                'email' => 'pjaindc@yahoo.co.in',
                'source_file' => 'divya-jaiswal.jpg',
                'filename' => 'divya_jaiswal.jpg',
                'type' => 'womens-wing',
                'sort_order' => 3,
            ],
        ];

        $wingsDir = public_path('wings');
        if (!File::exists($wingsDir)) {
            File::makeDirectory($wingsDir, 0755, true);
        }

        foreach ($members as $data) {
            $imagePath = null;
            $sourcePath = public_path('assets/images/' . $data['source_file']);
            
            if (File::exists($sourcePath)) {
                $destPath = $wingsDir . '/' . $data['filename'];
                File::copy($sourcePath, $destPath);
                $imagePath = 'wings/' . $data['filename'];
            }

            WingMember::create([
                'name' => $data['name'],
                'designation' => $data['designation'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'image' => $imagePath,
                'type' => $data['type'],
                'sort_order' => $data['sort_order'],
                'status' => true,
            ]);
        }
    }
}
