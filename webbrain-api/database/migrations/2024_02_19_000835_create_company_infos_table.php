<?php

use Database\Seeders\CompanyInfoSeeder;
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
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('street');
            $table->String('district');
            $table->String('zipCode');
            $table->String('city');
            $table->String('state');
            $table->String('OfficeHours');
            $table->String('numberPhone');
            $table->String('whatsapp');
            $table->String('whatsappLink');
            $table->text('mapsLink');
            $table->timestamps();
        });

        CompanyInfoSeeder::run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_infos');
    }
};
