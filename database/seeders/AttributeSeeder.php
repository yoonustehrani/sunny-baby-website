<?php

namespace Database\Seeders;

use App\Enums\OptionContentType;
use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'رنگ',
                'type' => OptionContentType::COLOR,
                'options' => [
                    ['label' => 'سیاه', 'value' => '#000000'],
                    ['label' => 'سفید', 'value' => '#ffffff'],
                    ['label' => 'قرمز', 'value' => '#ff0000'],
                    ['label' => 'سبز', 'value' => '#00ff00'],
                    ['label' => 'آبی', 'value' => '#0000ff'],
                    ['label' => 'زرد', 'value' => '#ffff00'],
                    ['label' => 'نارنجی', 'value' => '#ffa500'],
                    ['label' => 'بنفش', 'value' => '#800080'],
                    ['label' => 'صورتی', 'value' => '#ffc0cb'],
                    ['label' => 'خاکستری', 'value' => '#808080'],
                ]
            ],
            [
                'name' => 'سایز',
                'type' => OptionContentType::SIMPLE,
                'options' => [
                    ['value' => '۱-۳ ماه'],
                    ['value' => '۳-۶ ماه'],
                    ['value' => '۶-۱۲ ماه']
                ]
            ],
            [
                'name' => 'جنسیت',
                'type' => OptionContentType::IMAGE,
                'options' => [
                    ['label' => 'پسرانه', 'value' => 'icons/baby-boy.svg'],
                    ['label' => 'دخترانه', 'value' => 'icons/baby-girl.svg'],
                    ['label' => 'اسپرت', 'value' => 'icons/unisex.svg'],
                ]
            ],
        ];

        foreach ($attributes as $attribute) {
            $attr = new Attribute([
                'label' => $attribute['name'],
                'option_content_type' => $attribute['type'],
                'can_be_filtered' => true
            ]);
            $attr->save();
            $attr->options()->createMany(array_map(fn($opt) => [
                'content' => $opt['value'],
                'label' => $opt['label'] ?? null
            ], $attribute['options']));
        }
    }
}
