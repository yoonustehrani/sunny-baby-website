<?php

namespace Database\Seeders;

use App\Enums\VariableType;
use App\Models\Variable;
use App\Models\VariableValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariableSeeder extends Seeder
{
    protected function insertVariable(Variable $variable, array $values)
    {
        DB::transaction(function() use(&$variable, &$values) {
            $variable->save();
            $variable->values()->saveMany(
                array_map(fn($x) => new VariableValue($x), $values)
            );
        });
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variables = [
            [
                'name' => 'رنگ',
                'type' => VariableType::COLOR
            ],
            [
                'name' => 'سایز',
                'type' => VariableType::SIMPLE
            ],
            [
                'name' => 'جنسیت',
                'type' => VariableType::SIMPLE
            ],
        ];
        $colors = [
            ['value' => 'سیاه', 'type_value' => '#000000'],
            ['value' => 'سفید', 'type_value' => '#ffffff'],
        ];
        $sizes = [
            ['value' => '۱-۳ ماه'],
            ['value' => '۳-۶ ماه'],
            ['value' => '۶-۱۲ ماه']
        ];
        $sex = [
            ['value' => 'پسرانه'],
            ['value' => 'دخترانه'],
            ['value' => 'اسپرت'],
        ];
        $this->insertVariable(new Variable($variables[0]), $colors);
        $this->insertVariable(new Variable($variables[1]), $sizes);
        $this->insertVariable(new Variable($variables[2]), $sex);
    }
}
