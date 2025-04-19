<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'id' => 'uah',
            'name' => 'UAH',
            'rate_to_uah' => 1.0000
        ]);

        Currency::create([
            'id' => 'usd',
            'name' => 'USD',
            'rate_to_uah' => 41.68
        ]);

        Currency::create([
            'id' => 'eur',
            'name' => 'EUR',
            'rate_to_uah' => 45.18
        ]);
    }
}
