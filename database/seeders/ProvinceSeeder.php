<?php

namespace Database\Seeders;

use App\CSVReader;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = new CSVReader(database_path('seeders/data/provinces.csv'), [
            'int', 'str', 'str', 'str'
        ])->read()->getData();

        $provinces = collect($data)->map(fn($p) => ['name' => $p['name']]);

        Province::insert($provinces->toArray());
    }
}
