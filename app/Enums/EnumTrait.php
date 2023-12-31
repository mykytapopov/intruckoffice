<?php

namespace App\Enums;

trait EnumTrait
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
