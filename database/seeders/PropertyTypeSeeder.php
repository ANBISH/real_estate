<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyType::create([
            'id' => 'residential',
            'name' => 'Residential Properties'
        ]);

        PropertyType::create([
            'id' => 'commercial',
            'name' => 'Commercial Properties'
        ]);

        PropertyType::create([
            'id' => 'land',
            'name' => 'Land Properties'
        ]);
    }
}
