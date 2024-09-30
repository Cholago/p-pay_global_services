<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    /*
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
    */

    protected $table ='countries';

    protected $fillable = [
        'name',
        'iso_code_2',
        'iso_code_3',
        'iso_numeric',
        'capital',
        'currency',
        'currency_code',
        'phone_code',
        'region',
        'language',
        'timezone',
        'flag_url',
        
    ];

}
