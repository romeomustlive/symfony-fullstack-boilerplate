<?php


namespace App\Shared\Domain;

use DateTimeInterface;
use ReflectionClass;

final class Utils
{
    public static function dateToString(DateTimeInterface $date): string
    {
        return $date->format(DateTimeInterface::ATOM);
    }

    public static function stringToLower(string $value): string
    {
        return mb_strtolower($value);
    }

    public static function toSnakeCase(string $text): string
    {
        return ctype_lower($text) ? $text : strtolower(preg_replace('/([^A-Z\s])([A-Z])/', "$1_$2", $text));
    }

    public static function toCamelCase(string $text): string
    {
        return lcfirst(str_replace('_', '', ucwords($text, '_')));
    }

    public static function extractClassName(object $object): string
    {
        $reflect = new ReflectionClass($object);

        return $reflect->getShortName();
    }
}