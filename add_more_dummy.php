<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$images = [
    'assets/images/IMG-20250826-WA0003.jpg',
    'assets/images/IMG-20250826-WA0007.jpg'
];

foreach ($images as $index => $image) {
    \App\Models\Gallery::create([
        'title' => 'Dummy Gallery Image ' . ($index + 7),
        'image_path' => $image,
        'is_active' => true,
        'sort_order' => 20 + $index,
    ]);
}
echo "Added 2 more dummy images to reach 8 total.\n";
