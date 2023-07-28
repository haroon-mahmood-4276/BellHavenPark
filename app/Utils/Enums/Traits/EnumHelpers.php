<?php

namespace App\Utils\Enums\Traits;

use Illuminate\Support\Str;

trait EnumHelpers
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array($withText = false): array
    {
        if (!$withText) {
            return array_combine(self::names(), self::values());
        }

        $enumArray = [];

        foreach (self::cases() as $case) {
            $enumArray[$case->value] = [
                'name' => $case->name,
                'text' => Str::of($case->name)->replace("_", " ")->title()->value()
            ];
        }

        return $enumArray;
    }
}
