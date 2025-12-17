<?php

use App\Enums\ComparingOperatorType;
use App\Facades\Shipping;
use App\Models\Address;
use App\Models\Transaction;
use App\Services\CartService;
use App\Services\PaymentService;
use App\Services\Shipping\Carrier;
use App\Services\SMSService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
    function buildCategoryTree(array|Collection $categories, $parentId = null, $parent_key = 'parent_id', $id_key = 'id'): array
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

if (! function_exists('get_payment_gateway')) {
    function get_payment_gateway(string $gatewayClass, Transaction $transaction)
    {
        return app($gatewayClass, compact('transaction'));
    }
}

if (!function_exists('get_initials')) {
    function get_initials(string $string): string
    {
        $words = preg_split('/\s+/u', trim($string), -1, PREG_SPLIT_NO_EMPTY);

        return Str::substr($words[0], 0, 1);
    }
}

if (! function_exists('jalali')) {
    function jalali(Carbon $date, string $format = '%Y/%m/%d') {
        return \Morilog\Jalali\Jalalian::forge($date)->format($format);
    }
}

function adjustBrightness($hex, $percent) {
    // Remove '#' if present
    $hex = str_replace('#', '', $hex);

    // Convert to RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    // Adjust brightness
    $r = max(0, min(255, $r + ($r * $percent / 100)));
    $g = max(0, min(255, $g + ($g * $percent / 100)));
    $b = max(0, min(255, $b + ($b * $percent / 100)));

    // Convert back to hex
    return sprintf("#%02x%02x%02x", $r, $g, $b);
}

function makeGradient($baseColor) {
    $color1 = adjustBrightness($baseColor, 0); // lighten by 50%
    $color2 = adjustBrightness($baseColor, -20); // darken by 30%

    return "linear-gradient(135deg, $color1 0%, $color2 100%)";
}

if (! function_exists('routeIs')) {
    function routeIs(string $name)
    {
        \Log::alert(Route::currentRouteName() == $name);
        return Route::currentRouteName() == $name;
    }
}

if (! function_exists('affiliate_cart')) {
    function affiliate_cart(): CartService
    {
        return CartService::getInstance(is_affiliate: true);
    }
}

if (! function_exists('get_url_path')) {
    function get_url_path(string $url): string
    {
        return preg_replace('#^https?://[^/]+#', '', $url);
    }
}