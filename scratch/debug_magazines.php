<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Event;

foreach (Event::all() as $event) {
    echo "Event ID: " . $event->id . " - Title: " . $event->title . PHP_EOL;
    echo "Related Magazines Count: " . $event->relatedMagazines()->count() . PHP_EOL;
    foreach ($event->relatedMagazines as $mag) {
        echo "  - Magazine: " . $mag->title . " (Active: " . ($mag->is_active ? 'Yes' : 'No') . ")" . PHP_EOL;
    }
    echo "---------------------------" . PHP_EOL;
}
