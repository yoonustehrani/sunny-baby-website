<?php

use App\Enums\ComparingOperatorType;
use App\Facades\Shipping;
use App\Models\Address;
use App\Services\Shipping\Carrier;
use App\Services\SMSService;

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

if (! function_exists('get_carrier')) {
    function get_carrier(string $class, Address $address): Carrier
    {
        return Shipping::carrier($class)->setAddress($address);
    }
}

if (! function_exists('generate_otp_code')) {
    function generate_otp_code($length = 4)
    {
        $code = '';
        for ($i=0; $i < $length; $i++) { 
            $number = random_int(0, 9);
            $code .= $number;
        }
        for ($i=0; $i < $length; $i++) { 
            $code = str_shuffle($code);
        }
        return $code;
    }
}

if (! function_exists('dynamic_compare')) {
    function dynamic_compare(mixed $value1, mixed $value2, ComparingOperatorType $operator): bool
    {
        switch ($operator) {
            case ComparingOperatorType::AND:
                return $value1 && $value2;
            case ComparingOperatorType::OR:
                return $value1 || $value2;
            case ComparingOperatorType::EQUAL:
                return $value1 == $value2;
            case ComparingOperatorType::NOT_EQUAL:
                return $value1 != $value2;
            case ComparingOperatorType::IN:
                return in_array($value1, $value2);
            case ComparingOperatorType::NOT_IN:
                return ! in_array($value1, $value2);
            case ComparingOperatorType::GREATER:
                return $value1 > $value2;
            case ComparingOperatorType::GREATER_OR_EQUAL:
                return $value1 >= $value2;
            case ComparingOperatorType::LESS:
                return $value1 < $value2;
            case ComparingOperatorType::LESS_OR_EQUAL:
                return $value1 <= $value2;
            default:
                throw new Exception('Operator does not exists');
        }
    }
}

if (! function_exists('send_otp')) {
    function send_otp(string $phone_number, string $code)
    {
        return new SMSService()->sendPattern($phone_number, env('FARAZSMS_OTP_PATTERN_CODE'), compact('code'));
    }
}