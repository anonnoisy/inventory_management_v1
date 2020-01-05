<?php

namespace App\Generators;

class RandomNameGenerator
{

    /**
     * This function for create generate random string
     */
    protected static function generateRandomString(int $length = null)
    {
        return substr(
            str_shuffle(
                str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x))
            )
        ), 1, $length);
    }

    /**
     * This function for genreate random code name of brand
     */
    public static function generateRandomCodeName(string $unique_name, string $name, int $length)
    {
        $get_first_word = explode(' ', trim($name));
        $get_first_word = strtoupper($get_first_word[0]);
        return $unique_name . "_" . $get_first_word . date_format(now(), 'dmy') . "_" . self::generateRandomString($length);
    }

}