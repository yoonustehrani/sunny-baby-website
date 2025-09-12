<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discount;
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
        $this->call(VariableSeeder::class);
        try {
            DB::beginTransaction();
            $categories = Category::whereNull('parent_id')->inRandomOrder()->get()->pluck('id')->toArray();
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
            // $variable = Variable::whereName('رنگ')->first();
            // $colors = $variable->values()->get();
            // $variable_products = Product::factory(random_int(6, 12))->variable()->has(
            //     Product::factory(count($colors))->variation(),
            //     'variations'
            // )->create();
            // $products->push(...$variable_products);
            // foreach ($variable_products as $vp) {
            //     $vp->variations->each(function(Product $p, int $i) use(&$variable, &$colors) {
            //         $p->variables()->attach($variable, ['variable_value_id' => $colors[$i]->id]);
            //     });
            // }
            foreach ($products as $p) {
                $p->categories()->attach(fake()->randomElement($categories));
                ProductImage::factory()->main()->for($p)->create();
                ProductImage::factory()->for($p)->create();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
