<?php

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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('iso_code_2', 2); // ISO Alpha-2 code
            $table->char('iso_code_3', 3); // ISO Alpha-3 code
            $table->integer('iso_numeric'); // ISO Numeric code
            $table->string('capital')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_code', 3)->nullable(); // ISO 4217 code
            $table->integer('phone_code')->nullable(); // International dialing code
            $table->string('region')->nullable(); // Continent or region
            $table->string('language')->nullable(); // Official language
            $table->string('timezone')->nullable();
            $table->string('flag_url')->nullable(); // URL for flag image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
