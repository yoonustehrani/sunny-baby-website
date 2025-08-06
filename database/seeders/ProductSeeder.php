<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Variable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Product::factory(5)->create();
        try {
            DB::beginTransaction();
            $variable = Variable::whereName('رنگ')->first();
            $colors = $variable->values()->get();
            $variable_products = Product::factory(5)->variable()->has(
                Product::factory(count($colors))->variation(),
                'variations'
            )->create();
            foreach ($variable_products as $vp) {
                $vp->variations->each(function(Product $p, int $i) use(&$variable, &$colors) {
                    $p->variables()->attach($variable, ['variable_value_id' => $colors[$i]->id]);
                });
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
