<?php

namespace Database\Seeders;

use App\Http\Controllers\WordpressImportController;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new WordpressImportController)(request());
    }
}
