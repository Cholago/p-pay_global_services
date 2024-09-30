<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eastAfricaCountries = [
            ['name' => 'Kenya', 'iso_code_2' => 'KE', 'iso_code_3' => 'KEN', 'iso_numeric' => 404, 'capital' => 'Nairobi', 'currency' => 'Kenyan Shilling', 'currency_code' => 'KES', 'phone_code' => 254, 'region' => 'Africa'],
            ['name' => 'Uganda', 'iso_code_2' => 'UG', 'iso_code_3' => 'UGA', 'iso_numeric' => 800, 'capital' => 'Kampala', 'currency' => 'Ugandan Shilling', 'currency_code' => 'UGX', 'phone_code' => 256, 'region' => 'Africa'],
            ['name' => 'Tanzania', 'iso_code_2' => 'TZ', 'iso_code_3' => 'TZA', 'iso_numeric' => 834, 'capital' => 'Dodoma', 'currency' => 'Tanzanian Shilling', 'currency_code' => 'TZS', 'phone_code' => 255, 'region' => 'Africa'],
            ['name' => 'Rwanda', 'iso_code_2' => 'RW', 'iso_code_3' => 'RWA', 'iso_numeric' => 646, 'capital' => 'Kigali', 'currency' => 'Rwandan Franc', 'currency_code' => 'RWF', 'phone_code' => 250, 'region' => 'Africa'],
            ['name' => 'Burundi', 'iso_code_2' => 'BI', 'iso_code_3' => 'BDI', 'iso_numeric' => 108, 'capital' => 'Gitega', 'currency' => 'Burundian Franc', 'currency_code' => 'BIF', 'phone_code' => 257, 'region' => 'Africa'],
            ['name' => 'South Sudan', 'iso_code_2' => 'SS', 'iso_code_3' => 'SSD', 'iso_numeric' => 728, 'capital' => 'Juba', 'currency' => 'South Sudanese Pound', 'currency_code' => 'SSP', 'phone_code' => 211, 'region' => 'Africa'],
            ['name' => 'Ethiopia', 'iso_code_2' => 'ET', 'iso_code_3' => 'ETH', 'iso_numeric' => 231, 'capital' => 'Addis Ababa', 'currency' => 'Ethiopian Birr', 'currency_code' => 'ETB', 'phone_code' => 251, 'region' => 'Africa'],
            ['name' => 'Somalia', 'iso_code_2' => 'SO', 'iso_code_3' => 'SOM', 'iso_numeric' => 706, 'capital' => 'Mogadishu', 'currency' => 'Somali Shilling', 'currency_code' => 'SOS', 'phone_code' => 252, 'region' => 'Africa'],
            ['name' => 'Eritrea', 'iso_code_2' => 'ER', 'iso_code_3' => 'ERI', 'iso_numeric' => 232, 'capital' => 'Asmara', 'currency' => 'Nakfa', 'currency_code' => 'ERN', 'phone_code' => 291, 'region' => 'Africa'],
            ['name' => 'Djibouti', 'iso_code_2' => 'DJ', 'iso_code_3' => 'DJI', 'iso_numeric' => 262, 'capital' => 'Djibouti', 'currency' => 'Djiboutian Franc', 'currency_code' => 'DJF', 'phone_code' => 253, 'region' => 'Africa'],
        ];
        // Insert countries into the 'countries' table
        DB::table('countries')->insert($eastAfricaCountries);
    }
}
