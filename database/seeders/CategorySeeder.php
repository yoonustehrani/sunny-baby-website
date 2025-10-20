<?php

namespace Database\Seeders;

use App\CSVReader;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function insertCategories(array $categories, ?int $parent_id = null)
    {
        foreach ($categories as $category) {
            if (! is_null($category['icon'])) {
                $i = new Image(['url' => $category['icon'], 'thumbnail_url' => $category['icon']]);
                $i->save();
                $category['icon'] = $i->getKey();
            }
            $c = new Category([
                'name' => $category['name'],
                'slug' => slugify($category['name']),
                'parent_id' => $parent_id,
                'image_id' => $category['icon']
            ]);

            $c->save();
            if (isset($category['children']) && count($category['children'])) {
                $this->insertCategories($category['children'], $c->id);
            }
        }
    }
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = new CSVReader(database_path('seeders/data/categories.csv'), [
            'int', 'q', 'q', 'str', 'int', 'q'
        ])->read()->getData();

        $categories = buildCategoryTree($data, parent_key: 'parent', id_key: 'term_id');
        
        return $this->insertCategories($categories);
    }
}
