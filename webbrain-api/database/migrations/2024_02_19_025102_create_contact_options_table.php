<?php

use Database\Seeders\ContactOptionsSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contact_options', function (Blueprint $table) {
            $table->id();
            $table->String('description');
            $table->timestamps();
        });

        ContactOptionsSeeder::run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_options');
    }
};