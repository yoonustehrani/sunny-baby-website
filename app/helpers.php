<?php

if (! function_exists('price')) {
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