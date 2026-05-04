<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title_fr');
            $table->string('title_en');
            $table->string('slug')->unique();
            $table->text('excerpt_fr')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('content_fr')->nullable();
            $table->longText('content_en')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('reading_time')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title_fr')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->text('meta_description_fr')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->string('og_image')->nullable();
            $table->integer('views')->default(0);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
