<?php

namespace App\Http\Controllers;

use App\CSVReader;
use App\Enums\ProductType;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
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
        $keys = [
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
            'feature_x_name ', 'نام :n صفت',
            'feature_x_values ', 'مقدار(های) :n صفت',
            'feature_x_name ', 'نمایان بودن :n صفت',
            'feature_x_universal ', "صفت :n سراسری"
        ];
        $headers = array_keys($data[0]);
        $last_n = $headers[count($headers) - 1];
        $matches = [];
        preg_match('/[0-9]{1}/', $last_n, $matches);
        $last_n = intval($matches[0]);
        // return collect($data)->map(fn($item) => str_replace('id:', '', $item[$keys['parent']]))->filter()->unique();
        $simple_products_data = collect($data)->where($keys['type'], 'simple')->map(function (array $item) use ($keys) {
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
            $english_keys = array_map(fn($farsiKey) => array_search($farsiKey, $keys) ?: $farsiKey, array_keys($item));
            return array_combine($english_keys, array_values($item));
        });

        try {
            DB::beginTransaction();
            foreach ($simple_products_data as $sp) {
                /**
                 * @var Product $p
                 */
                $p = Product::where('imported_id', $sp['id'])->first() ?: new Product();
                $p->fill([
                    'title' => $sp['title'],
                    'slug' => str_replace(' ', '-', trim(mb_substr($sp['title'], 0, 60))),
                    'description' => str_replace('\\n', '<br>', $sp['description']),
                    'stock' => intval($sp['stock']),
                    'low_stock_count' => intval($sp['low_stock_count']),
                    'weight' => $sp['weight'],
                    'type' => ProductType::SIMPLE,
                    'imported_id' => $sp['id'],
                    'price' => $sp['price']
                ]);
                $p->save();
                $image_urls = array_map(fn(string $url) => 'storage/imported/' . str_replace('/', '-', $url), $sp['images']);
                $images = Image::whereIn('url', $image_urls)->get();
                $p->images()->detach($images);
                $main = $images->first();
                $images->shift();
                $p->images()->attach($main, ['is_main' => true]);
                $p->images()->attach($images);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        // $images = [];
        // collect($csv->getData())->map(fn($x) => trim($x['تصاویر']))->each(function (string $value) use (&$images) {
        //     $files = array_filter(explode(', ', $value));
        //     foreach ($files as $file) {
        //         if (! in_array($file, $images)) {
        //             array_push($images, $file);
        //         }
        //     }
        // });
        // file_put_contents(
        //     database_path('/seeders/data/images.csv'),
        //     "url\n".implode("\n", $images)
        // );
    }
}
