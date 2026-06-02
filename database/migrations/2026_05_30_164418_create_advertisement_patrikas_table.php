<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('advertisement_patrikas', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('type');
            $table->string('link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('advertisement_patrikas');
    }
};
