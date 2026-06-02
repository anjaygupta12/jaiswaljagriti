<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('advertisement_normals', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->unsignedBigInteger('advertisement_type_id');
            $table->string('link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('advertisement_type_id')->references('id')->on('advertisement_types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('advertisement_normals');
    }
};
