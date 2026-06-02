<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            // 'external' = link to outside URL, 'internal' = description shown on portal
            $table->enum('link_type', ['external', 'internal'])->default('external')->after('title');
            $table->longText('description')->nullable()->after('link_type');
        });
    }

    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn(['link_type', 'description']);
        });
    }
};
