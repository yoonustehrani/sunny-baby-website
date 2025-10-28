<?php

namespace Database\Seeders;

use App\Enums\ProductType;
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
        $this->call(BrandSeeder::class);
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

            
            $sizeAttribute = Attribute::whereLabel('سایز')->first();
            $sizes = $sizeAttribute->options()->get();
            $colorAttribute = Attribute::whereLabel('رنگ')->first();
            $colors = $colorAttribute->options()->get();

            $attributes = Attribute::with('options')->where('id', '<>', $sizeAttribute->id)->get();
            foreach ($attributes as $attr) {
                foreach ($products->filter(fn(Product $p) => $p->type == ProductType::SIMPLE) as $p) {
                    $p->attribute_options()->attach(fake()->randomElement($attr->options)->id, ['attribute_id' => $attr->id]);
                }
            }

            // creating variable products
            $variable_products = Product::factory(random_int(6, 12))->variable()->create();
            foreach ($variable_products as $vp) {
                $vp->variants()->saveMany(Product::factory()->count(rand(2, 3))->variation()->make());
                $vp->attribute_options()->attach($sizes->take($vp->variants->count())->pluck('id'), ['attribute_id' => $sizeAttribute->id]);
                $vp->attribute_options()->attach($colors->take($vp->variants->count())->pluck('id'), ['attribute_id' => $colorAttribute->id]);
                $vp->variants->each(function(Product $p, int $i) use(&$sizes, &$colors, &$vp) {
                    $p->attribute_options()->attach($sizes[$i]->id, ['attribute_id' => $sizes[$i]['attribute_id']]);
                    $p->attribute_options()->attach($colors[$i]->id, ['attribute_id' => $colors[$i]['attribute_id']]);
                    $p->sku = $vp->sku . '-' . $p->getKey();
                    $p->save();
                });
                $vp->stock = $vp->variants->sum(fn($x) => $x->stock);
                
                $vp->save();
            }
            $products->push(...$variable_products);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
