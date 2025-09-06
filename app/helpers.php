<?php

use App\Facades\Shipping;
use App\Models\Address;
use App\Services\Shipping\Carrier;

if (! function_exists('farsi_numbers')) {
    function farsi_numbers(int|string $number) {
        if (is_integer($number)) {
            $number = strval($number);
        }
        $englishNumbers = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $persianNumbers = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        
        return str_replace($englishNumbers, $persianNumbers, $number);
    }
}

if (! function_exists('format_price')) {
    function format_price(int $price) {
        return sprintf("%s تومان", number_format($price));
    }
}

if (! function_exists('random_price')) {
    function random_price() {
        $root = random_int(10, 100);
        return $root * 10 * 1000;
    }
}

if (! function_exists('round_price')) {
    function round_price(int $price)
    {
        return intval(
            round(intval($price) / 1000, 1)
        ) * 1000;
    }
}

if (! function_exists('clean_string')) {
    function clean_string(string $string)
    {
        return preg_replace('/[\x{200E}\x{200F}\x{202A}-\x{202E}]/u', '', $string);
    }
}

if (! function_exists('quote_str')) {
    function quote_str(string $string)
    {
        return str($string)->append('"')->prepend('"')->value();
    }
}

if (! function_exists('unquote_str')) {
    function unquote_str(string $string)
    {
        if (str_starts_with($string, '"') && str_ends_with($string, '"')) {
            return preg_replace(['/^\'/', '/\'$/'], ['', ''], $string);
        }
        return $string;
    }
}

if (! function_exists('slugify')) {
    function slugify(string $string)
    {
        return str_replace(' ', '-', $string);
    }
}

if (! function_exists('buildCategoryTree')) {
    function buildCategoryTree(array $categories, $parentId = null, $parent_key = 'parent_id', $id_key = 'id'): array
    {
        $branch = [];

        foreach ($categories as $category) {
            if ($category[$parent_key] == $parentId) {
                $children = buildCategoryTree($categories, $category[$id_key], $parent_key, $id_key);
                if ($children) {
                    $category['children'] = $children;
                }
                $branch[] = $category;
            }
        }

        return $branch;
    }
}

if (! function_exists('getCarrier')) {
    function get_carrier(string $class, Address $address): Carrier
    {
        return Shipping::carrier($class)->setAddress($address);
    }
}