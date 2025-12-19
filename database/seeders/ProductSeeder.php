<?php

namespace Database\Seeders;

use App\Enums\ProductType;
use App\Http\Controllers\WordpressImportController;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Variable;
use Database\Factories\ProductImageFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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
