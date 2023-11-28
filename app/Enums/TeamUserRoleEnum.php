<?php

namespace App\Enums;

use NormanHuth\Helpers\Traits\EnumTrait;

enum TeamUserRoleEnum: int
{
    use EnumTrait;

    case OWNER = 0;
    case ADMIN = 1;
    case MEMBER = 2;

    /**
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::OWNER => __('Owner'),
            self::ADMIN => __('Administrator'),
            self::MEMBER => __('Member'),
        };
    }
}
