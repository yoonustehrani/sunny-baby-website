<?php

namespace Database\Seeders;

use App\CSVReader;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reader = new CSVReader(database_path('seeders/data/brands.csv'), ['q', 's', 'q']);
        $reader->read();
        $records = $reader->getData();
        foreach ($records as $r) {
            new Brand(['name' => $r['name'], 'slug' => $r['slug']])->save();
        }
    }
}
