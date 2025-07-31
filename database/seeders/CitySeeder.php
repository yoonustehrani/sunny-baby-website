<?php

namespace Database\Seeders;

use App\CSVReader;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = new CSVReader(database_path('seeders/data/cities.csv'), [
            'int', 'str', 'str', 'int', 'str'
        ])->read()->getData();

        $cities = collect($data)->filter(fn($c) => !preg_match('/[0-9]/', $c['name']));
        $cities = $cities->map(fn($p) => ['name' => $p['name'], 'province_id' => $p['province_id'] - 99]);
        City::insert($cities->toArray());
    }
}
