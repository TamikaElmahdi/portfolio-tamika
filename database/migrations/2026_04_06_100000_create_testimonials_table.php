<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('author_name');
            $table->string('author_position')->nullable();
            $table->string('author_company')->nullable();
            $table->string('author_avatar')->nullable();
            $table->text('content_fr');
            $table->text('content_en')->nullable();
            $table->tinyInteger('rating')->default(5);
            $table->string('relation')->nullable(); // colleague, client, supervisor
            $table->string('linkedin_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
