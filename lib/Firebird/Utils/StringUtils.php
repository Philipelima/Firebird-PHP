<?php

namespace FirebdPHP\Firebird\Utils;

class StringUtils
{
    public static function removeInlineSpaces(string $string)
    {
        return rtrim(ltrim($string));
    }

    public static function removeExtraSpaces(string $string)
    {
        return preg_replace("/\s\s+/", " ", $string);
    }
}
