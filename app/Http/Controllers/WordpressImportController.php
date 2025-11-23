<?php

namespace App\Http\Controllers;

ini_set('max_execution_time', '1200');


use App\CSVReader;
use App\Enums\OptionContentType;
use App\Enums\ProductType;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class WordpressImportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $csv = new CSVReader(database_path('seeders/data/wc-product-export.csv'), [])
            ->read();
        $data = $csv->getData();
        $keys = $this->getKeys();
        $images = [];
        collect($data)->map(fn($x) => trim($x[$keys['images']]))->each(function (string $value) use (&$images) {
            $files = array_filter(explode(', ', $value));
            foreach ($files as $file) {
                if (! in_array($file, $images)) {
                    array_push($images, $file);
                }
            }
        });
        file_put_contents(
            database_path('/seeders/data/images.csv'),
            "url\n".implode("\n", $images)
        );
        
        Artisan::call('app:download-list-of-files');
        Artisan::call('app:make-thumbnails');

        $headers = array_keys($data[0]);
        $last_n = $headers[count($headers) - 1];
        $matches = [];
        preg_match('/[0-9]{1}/', $last_n, $matches);
        $last_n = intval($matches[0]);

        // return collect($data)->where($keys['type'], 'variation');
        $variable_products_data = $this->getPreparedDataset(
            collection: collect($data)->where($keys['type'], 'variation'),
            last_n: $last_n
        );

        $products_data = $this->getPreparedDataset(
            collect($data)->where($keys['type'], '!=', 'variation'),
            $last_n
        );

        try {
            DB::beginTransaction();
            foreach ($products_data as $sp) {
                if ($sp['type'] === ProductType::VARIABLE) {
                    $sp['variants'] = $variable_products_data->where('parent', $sp['id']);
                }
                $this->insertProduct($sp);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    protected function getPreparedDataset(Collection $collection, int $last_n)
    {
        $keys = $this->getKeys();
        return $collection->map(function (array $item) use ($keys, $last_n) {
            // dd($item);
            $images = [];
            $urls = explode(', ', $item[$keys['images']]);
            foreach ($urls as $url) {
                $url = trim($url);
                if ($url) {
                    $path = preg_replace('#^https?://[^/]+#', '', $url);
                    $filename = substr(str_replace('/', '-', $path), 1, strlen($path));
                    array_push($images, $filename);
                }
            }
            $item[$keys['images']] = $images;

            $categories = [];
            $cats = explode(', ', $item[$keys['categories']]);
            foreach ($cats as $cat) {
                $all_cats = array_map('trim', explode('>', $cat));
                array_push($categories, ...$all_cats);
            }
            $item[$keys['categories']] = $categories;
            $english_keys = array_filter(
                array_map(fn($farsiKey) => array_search($farsiKey, $keys), array_keys($item))
            );
            $results = [];
            foreach ($english_keys as $key) {
                $results[$key] = $item[$keys[$key]];
            }

            $results['parent'] = $results['parent'] ? str_replace('id:', '', $results['parent']) : null;

            $results['type'] = match ($results['type']) {
                'simple' => ProductType::SIMPLE,
                'variable' => ProductType::VARIABLE,
                'variation' => ProductType::VARIANT
            };

            $attr_options = [];
            for ($i=1; $i <= $last_n; $i++) { 
                $attr_options[] = [
                    'attribute' => $item[str_replace(':n', $i, $keys['feature_n_name'])],
                    'option_value' => $item[str_replace(':n', $i, $keys['feature_n_values'])],
                    'display' => boolval($item[str_replace(':n', $i, $keys['feature_n_display'])]),
                    'global' => boolval($item[str_replace(':n', $i, $keys['feature_n_global'])])
                ];
            }
            
            $results['attribute_options'] = array_filter($attr_options, fn($attr) => $attr['attribute'] != null);

            return $results;
        });
    }

    protected function getKeys(): array
    {
        return [
            'type' => 'نوع',
            'id' => 'شناسه',
            'title' => 'نام',
            'description' => 'توضیحات',
            'images' => 'تصاویر',
            'parent' => 'مادر',
            'stock' => 'انبار',
            'low_stock_count' => 'کمبود موجودی انبار',
            'discounted_price' => 'قیمت فروش ویژه',
            'price' => 'قیمت عادی',
            'categories' => 'دستهها',
            'tags' => 'برچسبها',
            'weight' => "وزن (گرم)",
            'reviews_allowed' => "آیا به مشتری اجازه نوشتن نقد داده شود؟",
            'feature_n_name'  => 'نام :n صفت',
            'feature_n_values' => 'مقدار(های) :n صفت',
            'feature_n_display'  => 'نمایان بودن :n صفت',
            'feature_n_global' => "صفت :n سراسری"
        ];
    }

    protected function insertProduct(array $sp) {
        /**
         * @var Product $p
         */
        $product = Product::where('imported_id', $sp['id'])->first() ?: new Product();
        $product->fill([
            'title' => $sp['title'],
            'description' => str_replace('\\n', '<br>', $sp['description']),
            'stock' => intval($sp['stock']),
            'low_stock_count' => intval($sp['low_stock_count']),
            'weight' => $sp['weight'] ?: null,
            'type' => $sp['type'],
            'imported_id' => $sp['id'],
            'price' => $sp['price'] ?: null
        ]);
        if ($product->type !== ProductType::VARIANT) {
            $product->slug = str_replace(' ', '-', trim(mb_substr($sp['title'], 0, 60)));
        }
        if ($product->type === ProductType::VARIANT) {
            $parent = Product::where('imported_id', $sp['parent'])->first();
            $product->parent_id = $parent->id;
        }
        $product->save();

        $image_urls = array_map(fn(string $url) => 'storage/imported/' . str_replace('/', '-', $url), $sp['images']);
        $images = Image::whereIn('url', $image_urls)->get();
        $product->images()->detach($images);
        $main = $images->first();
        $images->shift();
        $product->images()->attach($main, ['is_main' => true]);
        $product->images()->attach($images);

        $categories = Category::whereIn('name', $sp['categories'])->get();
        $product->categories()->sync($categories);

        if ($sp['type'] === ProductType::VARIABLE) {
            $variable_attrs = collect($sp['variants'])->map(fn($x) => array_map(fn($z) => $z['attribute'], $x['attribute_options']))->flatten()->unique()->toArray();
            $item_variable_attrs = array_filter($sp['attribute_options'], function ($y) use($variable_attrs) {
                return in_array($y['attribute'], $variable_attrs);
            });
            foreach ($item_variable_attrs as $attribute_option) {
                if (in_array($attribute_option['attribute'], $variable_attrs)) {
                    foreach (explode(', ', $attribute_option['option_value']) as $sub_option) {
                        $sp['attribute_options'][] = [
                            'attribute' => $attribute_option['attribute'],
                            'option_value' => $sub_option,
                            'display' => true,
                            'global' => true
                        ];
                    }
                }
            }
            $sp['attribute_options'] = array_filter($sp['attribute_options'], fn($option) => $option['global']);
        }

        foreach ($sp['attribute_options'] as $option) {
            $attribute = Attribute::firstOrCreate(
                ['label' => $option['attribute']],
                ['option_content_type' => OptionContentType::SIMPLE, 'can_be_filtered' => false]
            );
            if ($option['global'] || $sp['type'] == ProductType::VARIANT) {
                if ($option['option_value'] == 'ابی') {
                    $option['option_value'] = 'آبی';
                }
                if ($option['option_value'] == 'مشکی') {
                    $option['option_value'] = 'سیاه';
                }
                if ($option['option_value'] == 'سورمه ای') {
                    $option['option_value'] = 'سرمه ای';
                }
                $attribute_option = AttributeOption::firstOrCreate(
                    [
                        'attribute_id' => $attribute->id,
                        'label' => $option['option_value']
                    ],
                    [
                        'content' => $option['option_value'],
                        'content_hash' => trim(sha1($option['option_value']))
                    ]
                );
                $product->attribute_options()->attach($attribute_option, ['attribute_id' => $attribute->id]);
            }
        }

        if (isset($sp['variants'])) {
            foreach ($sp['variants'] as $variant_product) {
                $this->insertProduct($variant_product);
            }
        }
    }
}
