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
                    ['label' => 'کرم', 'value' => '#F8E5C4'],
                    ['label' => 'طوسی', 'value' => '#B4B5B0'],
                    ['label' => 'آجری', 'value' => '#793B31'],
                    ['label' => 'خردلی', 'value' => '#DAA520'],
                    ['label' => 'شکلاتی', 'value' => '#4E2F26'],
                    ['label' => 'قهوه ای', 'value' => '#532E1B'],
                    ['label' => 'سرمه ای', 'value' => '#222F4F'],
                    ['label' => 'کالباسی', 'value' => '#DAB9BC'],
                    ['label' => 'نخودی', 'value' => '#F2CA85'],
                    ['label' => 'زغال سنگی', 'value' => '#323232'],
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
