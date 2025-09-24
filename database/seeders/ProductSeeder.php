<?php

namespace Database\Seeders;

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
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        $this->call(AttributeSeeder::class);
        try {
            DB::beginTransaction();
            $products = collect();
             // discounted product
            $products->push(
                ...Product::factory(random_int(5, 7))->withDiscount()->create()
            );
            // normal product
            $products->push(
                ...Product::factory(random_int(6, 12))->create()
            );
            // creating variable products
            $sizeAttribute = Attribute::whereLabel('سایز')->first();
            $sizes = $sizeAttribute->options()->get();
            $variable_products = Product::factory(random_int(6, 12))->variable()->has(
                Product::factory(count($sizes))->variation(),
                'variants'
            )->create();
            foreach ($variable_products as $vp) {
                $vp->attribute_options()->attach($sizes->pluck('id'), ['attribute_id' => $sizeAttribute->id]);
                $vp->variants->each(function(Product $p, int $i) use(&$sizes) {
                    $p->attribute_options()->attach($sizes[$i]->id, ['attribute_id' => $sizes[$i]['attribute_id']]);
                });
            }
            $products->push(...$variable_products);

            $attributes = Attribute::with('options')->where('id', '<>', $sizeAttribute->id)->get();
            foreach ($attributes as $attr) {
                foreach ($products as $p) {
                    $p->attribute_options()->attach(fake()->randomElement($attr->options)->id, ['attribute_id' => $attr->id]);
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
