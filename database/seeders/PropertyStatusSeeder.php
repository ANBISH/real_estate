<?php

namespace Database\Seeders;

use App\Models\PropertyStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyStatus::create([
            'id' => 'draft',
            'name' => 'Draft'
        ]);

        PropertyStatus::create([
            'id' => 'available',
            'name' => 'Available'
        ]);

        PropertyStatus::create([
            'id' => 'under_contract',
            'name' => 'Under Contract'
        ]);

        PropertyStatus::create([
            'id' => 'sold',
            'name' => 'Sold'
        ]);

        PropertyStatus::create([
            'id' => 'off_market',
            'name' => 'Off Market'
        ]);
    }
}
