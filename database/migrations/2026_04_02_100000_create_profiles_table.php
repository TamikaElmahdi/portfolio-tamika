<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title_fr');
            $table->string('title_en');
            $table->text('bio_fr');
            $table->text('bio_en');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cv_path')->nullable();
            $table->string('location')->nullable();
            $table->boolean('available')->default(true);
            $table->integer('years_experience')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
