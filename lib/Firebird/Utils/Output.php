<?php

namespace FirebdPHP\Firebird\Utils;

use FirebdPHP\Firebird\Utils\TextColors;
use FirebdPHP\Firebird\Utils\BackgroundColors;

class Output
{
    // Reset
    private static $clear = "\033[49m\033[0m";
    private static $defaultOptions = ["color" => "\033[0m", "background" => "\033[49m"];

    /**
     * Warning message colored in yellow
     */
    public static function warn()
    {
        $labelColors = ["color" => TextColors::$Red, "background" => BackgroundColors::$Yellow];
        $separatorColors = ["color" => TextColors::$LightYellow, "background" => BackgroundColors::$LightYellow];
        self::center(self::bold(" WARNING "), $labelColors);
        self::separator(options: $separatorColors);
    }

    /**
     * Danger message colored in red
     */
    public static function danger()
    {
        $labelColors = ["color" => TextColors::$Yellow, "background" => BackgroundColors::$Red];
        $separatorColors = ["color" => TextColors::$Red, "background" => BackgroundColors::$Red];
        self::center(self::bold(" DANGER "), $labelColors);
        self::separator(options: $separatorColors);
    }

    /**
     * Error message colored in bright red
     */
    public static function error(mixed $code = "")
    {
        $separatorColors = ["color" => TextColors::$Red, "background" => BackgroundColors::$Clear];
        $labelColors = ["color" => TextColors::$Red, "background" => BackgroundColors::$Clear];
        self::center(self::bold(" ERROR $code "), $labelColors);
        self::separator("-", $separatorColors);
    }

    /**
     * Success message colored in bright green
     */
    public static function success()
    {
        $labelColors = ["color" => TextColors::$Green, "background" => BackgroundColors::$Clear];
        $separatorColors = ["color" => TextColors::$Green, "background" => BackgroundColors::$Black];
        self::center(self::bold(" SUCCESS "), $labelColors);
        self::separator("-", $separatorColors);
    }

    // >>>>>>>>>>>>> PRIVATE METHODS

    /**
     * Output a message (colored or not)
     */
    private static function output($message, ?array $messageOptions = null)
    {
        // Default options
        self::paint($messageOptions);
        print_r($message);
        echo self::$clear;
    }

    /**
     * Centers the message between a chain of characters
     */
    private static function center($message, ?array $messageOptions = null, $filler = " ", ?array $fillerOptions = null)
    {
        // Compensates for the filler width
        $width = self::getTerminalWidth();
        $repeat = floor($width / strlen($filler));
        $messageSpace = floor(strlen($message) / 2);
        $half = floor(($repeat / 2) - ($messageSpace / 2));
        $printed = false;

        // Color line
        echo "\n";
        self::paint($fillerOptions);
        // Print line
        for ($col = 1; $col <= $half; $col++) {
            echo $filler;
            // After completing the first half of fillers it shows the message. It happens only in the first time
            if ($col == $half && !$printed) {
                // Print message
                self::output($message, $messageOptions);
                $printed = true;
                $col = 0;
                // Color line again
                self::paint($fillerOptions);
            }
        }
        echo self::$clear . "\n";
    }

    /**
     * Creates a line with the specified string
     */
    private static function separator(?string $string = null, ?array $options = null)
    {
        $string = $string ?? " ";
        $width = self::getTerminalWidth();
        $repeat = floor($width / strlen($string));
        // Print separator
        echo "\n";
        self::paint($options);
        for ($col = 0; $col < $repeat; $col++) {
            echo $string;
        }
        echo self::$clear . "\n";
    }

    /**
     * Based on tput output
     */
    private static function getTerminalWidth()
    {
        return exec('tput cols');
    }

    private static function bold($content)
    {
        return "\033[1m" . $content . "\033[0m";
    }

    private static function paint($options)
    {
        $options = $options ?? self::$defaultOptions;;
        echo $options["color"] . $options["background"];
    }
}
