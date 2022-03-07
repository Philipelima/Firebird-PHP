<?php

namespace FirebdPHP\Firebird\Utils;

// ! PHP ENUMS ARE ONLY AVAILABLE ON PHP 8.1 
// enum TextColors: string
// {
//         // Normal text colors
//     case Clear = "\033[0m";
//     case Black = "\033[39m";
//     case White = "\033[97m";
//     case Red = "\033[31m";
//     case Green = "\033[32m";
//     case Yellow = "\033[33m";
//     case Blue = "\033[34m";
//     case Magenta = "\033[35m";
//     case Cyan = "\033[36m";

//         // Light  colors
//     case LightRed = "\033[91m";
//     case LightGreen = "\033[92m";
//     case LightYellow = "\033[93m";
//     case LightBlue = "\033[94m";
//     case LightMagenta = "\033[95m";
//     case LightCyan = "\033[96m";
// }

// ! For now we're using PHP 7.x so we don't have enums...
class TextColors
{
    // Normal text colors
    public static $Clear = "\033[0m";
    public static $Black = "\033[39m";
    public static $White = "\033[97m";
    public static $Red = "\033[31m";
    public static $Green = "\033[32m";
    public static $Yellow = "\033[33m";
    public static $Blue = "\033[34m";
    public static $Magenta = "\033[35m";
    public static $Cyan = "\033[36m";

    // Light  colors
    public static $LightRed = "\033[91m";
    public static $LightGreen = "\033[92m";
    public static $LightYellow = "\033[93m";
    public static $LightBlue = "\033[94m";
    public static $LightMagenta = "\033[95m";
    public static $LightCyan = "\033[96m";
}
