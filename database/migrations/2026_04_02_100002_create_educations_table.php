<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('school');
            $table->string('logo')->nullable();
            $table->string('degree_fr');
            $table->string('degree_en');
            $table->string('field_fr');
            $table->string('field_en');
            $table->text('description_fr')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('start_year');
            $table->integer('end_year')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
