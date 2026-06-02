<?php

use Illuminate\Support\Str;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$yatras = [
    [
        'title' => 'A Journey Govind Dev Ji, Jaipur',
        'short_description' => 'Experience the divine atmosphere of Govind Dev Ji temple in the pink city of Jaipur.',
        'content' => '<p>Join us on a spiritual journey to the historic Govind Dev Ji Temple in Jaipur. Dedicated to Lord Krishna, this temple is located in the City Palace complex and is one of the most revered shrines for Vaishnavites. We will experience the Mangala Aarti and the beautiful bhajans sung by the devotees.</p>',
        'thumbnail' => 'assets/images/Govind-Dev-Ji-Temple-Jaipur-400x300.jpg'
    ],
    [
        'title' => 'Sawariya Seth Mandir, Chittorgarh',
        'short_description' => 'A spiritual visit to the miraculous Sawariya Seth Mandir known for answering prayers.',
        'content' => '<p>The Sanwaliaji Temple of the Dark Krishna is situated on the Chittorgarh - Udaipur Highway. The deity is known as Sanwalia Seth. This yatra brings our community together for a deep spiritual experience filled with devotion, kirtan, and community service.</p>',
        'thumbnail' => 'assets/images/image-3-1024x768-1-e1755594836425-400x300.jpg'
    ],
    [
        'title' => 'A Journey To Ayodhya Ram Mandir',
        'short_description' => 'A historic spiritual yatra to the birthplace of Lord Rama in Ayodhya.',
        'content' => '<p>Embark on a once-in-a-lifetime journey to the newly consecrated Ram Janmabhoomi Temple in Ayodhya. We will visit the main temple, Hanumangarhi, and take a holy dip in the Saryu river, celebrating our heritage and faith.</p>',
        'thumbnail' => 'assets/images/Untitled-design-33-400x300.png'
    ],
    [
        'title' => 'Shree Khatu Shyam Mandir, Sikar',
        'short_description' => 'Seek the blessings of Khatu Shyam Ji in Sikar, Rajasthan.',
        'content' => '<p>Khatu Shyam Ji is considered to be the God of the Kali Yuga. Millions of devotees flock to this temple to seek his blessings. Our community yatra will include special darshan arrangements and overnight stay with bhajan sandhya.</p>',
        'thumbnail' => 'assets/images/14_11_2022-khatushyam-e1755594120876-400x300.jpg'
    ]
];

foreach ($yatras as $yatra) {
    \App\Models\SpiritualYatra::create([
        'title' => $yatra['title'],
        'slug' => Str::slug($yatra['title']) . '-' . uniqid(),
        'short_description' => $yatra['short_description'],
        'content' => $yatra['content'],
        'thumbnail' => $yatra['thumbnail'],
        'status' => true
    ]);
}

echo "Successfully added 4 dummy Spiritual Yatras.\n";
