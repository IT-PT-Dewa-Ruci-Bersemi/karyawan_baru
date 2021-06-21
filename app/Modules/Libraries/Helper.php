<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 12/17/2015
 * Time: 11:56 AM
 */
namespace App\Modules\Libraries;

class Helper {
    public static function replaceSpecialChar($string, $replaceWith = '-') {
        return preg_replace('/[^A-Za-z0-9\-]/', $replaceWith, $string);
    }

    public static function replaceCertainString($string, $target, $replaceWith = '') {
        return str_replace($target, $replaceWith, $string);
    }

    public static function replaceHtmlTag($string, $replaceWith = '') {
        return preg_replace('#<[^>]+>#', $replaceWith, $string);
    }

    public static function fileUploadRename($filename, $ext) {
        return str_random(5).'-'.self::replaceSpecialChar(self::replaceCertainString(self::replaceCertainString($filename, ' ', '-'), '.'.$ext)).'.'.$ext;
    }

    public static function truncate_chars($text, $limit, $ending = '...') {
        $text   = self::replaceHtmlTag($text);
        if( strlen($text) > $limit )
            $text = trim(substr($text, 0, $limit)) . $ending;
        return $text;
    }

    public static function truncate_words($text, $limit, $ending = '...') {
        $text   = self::replaceHtmlTag($text);
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public static function currency_format($value, $thousand_separator = '.', $default_currency = 'Rp') {
        return $default_currency.' '.number_format($value, 0, ',', $thousand_separator);
    }

    public static function number_format($value, $thousand_separator = '.') {
        return number_format($value, 0, ',', $thousand_separator);
    }
}