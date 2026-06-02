<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$galleries = \App\Models\Gallery::where('image_path', 'assets/images/placeholder.jpg')->get();
$images = [
    'assets/images/IMG-20250826-WA0008.jpg',
    'assets/images/IMG-20250826-WA0005.jpg',
    'assets/images/IMG-20250826-WA0004.jpg'
];

foreach ($galleries as $index => $gallery) {
    if (isset($images[$index])) {
        $gallery->image_path = $images[$index];
        $gallery->save();
    }
}
echo "Fixed dummy image paths.\n";
